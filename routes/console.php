<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\SendPendingMails;

//Artisan::command('inspire', function () {
    //$this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote');

Schedule::command('send:pending-mails')->everyTwoMinutes();
