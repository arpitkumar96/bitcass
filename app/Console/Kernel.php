<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('app:result-one-min-game')->everySecond();
        // $schedule->command('app:one-min-game-start')->everyMinute();
        // $schedule->command('app:result-three-min-game')->cron('*/2 * * * *');
        // $schedule->command('app:three-min-game-start')->everyThreeMinutes();
        // $schedule->command('app:five-min-game-start')->everyFiveMinutes();
        // $schedule->command('app:result-five-min-game')->cron('*/4 * * * *');
        // $schedule->command('app:ten-min-game-start')->everyTenMinutes();
        // $schedule->command('app:result-ten-min-game')->cron('*/9 * * * *');
        $schedule->command('app:win-go1-min-game')->everyMinute();
        $schedule->command('app:win-go3-min-game')->everyThreeMinutes();
        $schedule->command('app:win-go5-min-game')->everyFiveMinutes();
        $schedule->command('app:win-go10-min-game')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
