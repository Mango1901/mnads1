<?php

namespace App\Console;

use App\Console\Commands\ActiveExpired;
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
        ActiveExpired::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:clean --disable-notifications')->dailyAt("01:52");
        $schedule->command('backup:run --only-db --disable-notifications')->dailyAt("01:53");
        $schedule->command('ActiveExpired:call')->dailyAt("11:10");
        $schedule->command('CheckTokenExpired:check')->dailyAt("11:12");
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
