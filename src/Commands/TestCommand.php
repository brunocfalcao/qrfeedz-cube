<?php

namespace QRFeedz\Cube\Commands;

use Illuminate\Console\Command;
use QRFeedz\Cube\Models\Client;
use QRFeedz\Cube\Models\User;

class TestCommand extends Command
{
    protected $signature = 'qrfeedz:test';

    protected $description = 'A test command to test whatever needed';

    public function handle()
    {
        $user = User::firstWhere('id', 3);

        $client = Client::firstWhere('id', 1);

        $this->info($user->exists());

        $this->info($client->exists());

        dd($user->isAuthorizedAs($client, 'location-admin'));
    }
}
