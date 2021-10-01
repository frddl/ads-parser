<?php

namespace App\Console\Commands;

use App\Models\AdItem;
use App\Models\Result;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use LogicException;

class ParseUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:parse {keyword} {--provider=} {--min=0} {--max=' . PHP_INT_MAX . '} {--blacklisted=[]}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse the updates using the CLI interface. Usage: php artisan ads:parse \'keyword\' --provider=tap_az --min=10 --max=50 --blacklisted="word1,word2"';

    public $config;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->config = config('parsers');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $keyword = $this->argument('keyword');
        $price_min = $this->option('min');
        $price_max = $this->option('max');

        if ($price_min > $price_max) throw new LogicException('price_min should be equal or greater than price_max');

        $blacklisted = explode(",", $this->option('blacklisted'));

        $provider = $this->option('provider');

        $providerClass = $this->config['strategy'][$provider];
        $siteConfig = $this->config['sites'][$provider];

        $parser = new $providerClass(null);

        $results = $parser->parse();
        foreach ($results as $result) {
            $result = $result;

            if (
                numeric($result['price']) >= $price_min &&
                numeric($result['price']) <= $price_max &&
                (empty($keyword) || Str::contains(strtolower($result['name']), $keyword))
            ) {
                $blacklisted_flag = true;
                foreach ($blacklisted as $word) {
                    $blacklisted_flag = $blacklisted_flag && !Str::contains(strtolower($result['name']), $word);
                }

                if ($blacklisted_flag) {
                    print_r($result);
                }
            }
        }
        return 0;
    }
}
