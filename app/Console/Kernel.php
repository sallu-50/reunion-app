<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        // also include routes/console.php for closure commands
        require base_path('routes/console.php');
    }

    protected function schedule(Schedule $schedule): void
    {
        //
    }
}
