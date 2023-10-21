<?php

namespace QRFeedz\Cube\Commands;

use Illuminate\Console\Command;
use QRFeedz\Cube\Models\Authorization;

class TestCommand extends Command
{
    protected $signature = 'qrfeedz:test';

    protected $description = 'A test command to test whatever needed';

    public function handle()
    {
        dd(Authorization::where('canonical', 'like', 'questionnaire-%')->get()->pluck('id'));
    }
}
