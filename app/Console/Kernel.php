<?php

declare(strict_types=1);

namespace App\Console;

use App\Jobs\ProcessDailyCharges;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->job(new ProcessDailyCharges())->dailyAt('9:00');
        $schedule->job(new ProcessDailyCharges())->everyMinute(); // Para testes
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
