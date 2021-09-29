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
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use LogicException;

class ParseUpdatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $adItem;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($adItem)
    {
        $this->adItem = $adItem;
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

        $provider = $this->adItem->provider;

        $providerClass = $this->config['strategy'][$provider];
        $siteConfig = $this->config['sites'][$provider];

        $parser = new $providerClass($this->adItem);

        $results = $parser->parse();
        foreach ($results as $result) {
            $result = $result;

            if (
                $this->numeric($result['price']) >= $this->adItem->price_min &&
                $this->numeric($result['price']) <= $this->adItem->price_max &&
                Str::contains(strtolower($result['name']), $keyword)
            ) {
                $blacklisted_flag = true;
                foreach ($blacklisted as $word) {
                    $blacklisted_flag = $blacklisted_flag && !Str::contains(strtolower($result['name']), $word);
                }

                if ($blacklisted_flag) {
                    $instance = Result::create([
                        'ad_item_id' => $this->adItem->id,
                        'result_link' => $result->link,
                    ]);

                    $instance->property()->create(Arr::except($result, 'link'));
                    $instance->save();
                }
            }
        }
        return 0;
    }

    public function numeric($input): int
    {
        return intval(preg_replace('/[^0-9]/', '', $input));
    }
}
