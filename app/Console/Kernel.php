<?php

namespace App\Console;

use App\Alarm;
use App\Mail\BattleAlarm;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $schedule->call(function () {
            $alarms = Alarm::where('status','0')->where('time','<',date('Y-m-d h:i:s'))->with('user')->with('battle')->get();
            $alarms = Alarm::where('status','0')->where('time','<',date('Y-m-d h:i:s'))->update([
                'status' => '1'
            ]);
            foreach ($alarms as $alarm){
                Mail::to($alarm->user->email)->send(new BattleAlarm(['title' => $alarm->battle->title, 'id' => $alarm->battle->title,'type' => 'invitation']));
            }
        })->everyMinute();
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
