<?php

namespace App\Console;

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
        Commands\CurrencyUpdate::Class,
        Commands\CommunicationCron::Class,
        Commands\BookingRemainder12hours::Class,
        Commands\BookingRemainder1hours::Class,
        Commands\PayinRemainder::Class,
        Commands\scheduleRremainder::Class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('Currency:Update')->cron('0 0 */14 * *');
        // $schedule->command('Sent:Communication')->cron('* * * * *');
        // $schedule->command('BookingReminder:12hour')->cron('* * * * *');
        // $schedule->command('BookingReminder:1hour')->cron('* * * * *');
        // $schedule->command('PayinRemainder:EveryDay')->cron('* * * * *');
        // $schedule->command('Schedule:OneDay')->cron('* * * * *');
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
