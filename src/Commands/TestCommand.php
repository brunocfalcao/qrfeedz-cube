<?php

namespace QRFeedz\Cube\Commands;

use Illuminate\Console\Command;
use QRFeedz\Cube\Models\QuestionInstance;

class TestCommand extends Command
{
    protected $signature = 'qrfeedz:test';

    protected $description = 'A test command to test whatever needed';

    public function handle()
    {
        $questionInstance = QuestionInstance::firstWhere('id', 1);

        dd($questionInstance->captions()->where('locale_id', 1)->first()->pivot->caption);
    }
}
