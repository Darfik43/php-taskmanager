<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call(function () {
    $users = app(\App\Authentication\Repositories\UserRepository::class)->findById(1);
    $producer = new \App\Email\Producers\TaskNotificationProducer();

    foreach ($users as $user) {
        $producer->send(1);
    }
})->everyThirtySeconds();
