<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $users = app(\App\Authentication\Repositories\UserRepository::class)->findAll();
            $producer = new \App\Kafka\TaskNotificationProducer();

            foreach ($users as $user) {
                $producer->send($user->id);
            }
        })->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
