<?php

namespace App\Console\Commands;

use App\Models\Result;
use Illuminate\Console\Command;

class ParseUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:parse {keyword} {--provider=} {--min=?} {--max=?} {--blacklisted=?}';

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
        $price_min = $this->hasOption('min') ? $this->option('min') : null;
        $price_max = $this->hasOption('max') ? $this->option('max') : null;
        $blacklisted = $this->hasOption('blacklisted') ? explode(",", $this->option('blacklisted')) : [];

        $provider = $this->option('provider');

        $providerClass = $this->config['strategy'][$provider];
        $siteConfig = $this->config['sites'][$provider];

        $parser = new $providerClass(['keyword' => $keyword]);
        print_r($blacklisted);
        print_r($parser->parse());

        $results = $parser->parse();
        foreach ($results as $result) {
            // Result::create([
            //     'result_link' => $result->link,
            // ]);
        }
        return 0;
    }
}
