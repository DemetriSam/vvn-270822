<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('get_euro_rub_rate')->twiceDaily(9, 15);
        // $schedule->command('inspire')->hourly();
        if (config('app.env') === 'production') {
            // Backups pgsql
            $schedule->command('backup:run', ['--only-db'])->everyFourHours();
            $schedule->command('backup:clean')->daily()->at('08:00');
            $schedule->command('backup:monitor')->daily()->at('10:00');

            $schedule->command('check-ssl')->daily()->at('12:00');
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
