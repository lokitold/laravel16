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
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\Catalogo::class,
        \App\Console\Commands\Catalogo2::class,
        \App\Console\Commands\Catalogo3::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$filePath = '/var/www/laravel/laravel16/storage/logs/catalogo.log';

        //$schedule->command('inspire')
        //         ->cron('* * * * * *')->sendOutputTo(storage_path('logs/catalogo.log'));

        $schedule->command('catalogo')
            ->everyFiveMinutes()->sendOutputTo(storage_path('logs/catalogo.log'));

        //$schedule->call(function () {
        //    dump('hola');
        //})->everyMinute()->sendOutputTo($filePath);
    }
}
