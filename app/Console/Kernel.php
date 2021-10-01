<?php

namespace App\Console;

use App\Jobs\ParseUpdatesJob;
use App\Models\AdItem;
use App\Settings\GeneralSettings;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $system_is_active = app(GeneralSettings::class)->is_active;

        if ($system_is_active) {
            $periods = config('parsers.periods');
            foreach ($periods as $period) {
                $items = AdItem::every($period)->active()->get();
                foreach ($items as $item) {
                    switch ($period) {
                        case 1:
                            $schedule->job(new ParseUpdatesJob($item))->everyMinute();
                            break;
                        case 5:
                            $schedule->job(new ParseUpdatesJob($item))->everyFiveMinutes();
                            break;
                        case 15:
                            $schedule->job(new ParseUpdatesJob($item))->everyFifteenMinutes();
                            break;
                        case 30:
                            $schedule->job(new ParseUpdatesJob($item))->everyThirtyMinutes();
                            break;
                        case 60:
                            $schedule->job(new ParseUpdatesJob($item))->hourly();
                            break;
                        case 120:
                            $schedule->job(new ParseUpdatesJob($item))->everyTwoHours();
                            break;
                    }
                }
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
