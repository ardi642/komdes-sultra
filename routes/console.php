<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

\Illuminate\Support\Facades\Schedule::command('clean:editor-images --hours=24')->dailyAt('02:00');
\Illuminate\Support\Facades\Schedule::command('clean:gallery-images --hours=24')->dailyAt('02:30');
