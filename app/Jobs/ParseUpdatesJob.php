<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\AdItem;
use App\Models\Result;
use App\Models\ResultProperty;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use LogicException;
use PhpParser\Builder\Property;

class ParseUpdatesJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $adItem;
    private $providerClass;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($adItem)
    {
        $this->adItem = $adItem;
        $this->providerClass = config('parsers.strategy.' . $adItem->provider);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $keyword = $this->adItem->keyword;
        $blacklisted = explode(",", $this->adItem->blacklisted);
        $parser = (new $this->providerClass($this->adItem));

        $results = $parser->parse();
        foreach ($results as $result) {
            $result = $result;

            if (
                numeric($result['price']) >= $this->adItem->price_min &&
                numeric($result['price']) <= $this->adItem->price_max &&
                (empty($keyword) || Str::contains(strtolower($result['name']), $keyword))
            ) {
                $blacklisted_flag = true;
                foreach ($blacklisted as $word) {
                    $blacklisted_flag = $blacklisted_flag && !Str::contains(strtolower($result['name']), $word);
                }

                if ($blacklisted_flag) {
                    $resultExists = Result::where('result_link', $result['link'])->count();

                    if (!$resultExists) {
                        $instance = Result::create(
                            [
                                'result_link' => $result['link'],
                                'ad_item_id' => $this->adItem->id,
                            ]
                        );

                        $instance->save();

                        ResultProperty::create(
                            [
                                'result_id' => $instance->id,
                                'data' => Arr::except($result, 'link'),
                            ]
                        );
                    }
                }
            }
        }
    }

    public function numeric($input): int
    {
        return intval(preg_replace('/[^0-9]/', '', $input));
    }
}
