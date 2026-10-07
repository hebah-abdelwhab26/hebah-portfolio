<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('education:send-lesson-reminders')
    ->everyMinute()
    ->withoutOverlapping();

