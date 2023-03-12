<?php

namespace QRFeedz\Cube\Commands;

use Illuminate\Console\Command;
use QRFeedz\Cube\Models\User;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qrfeedz:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test command for multiple purposes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::find(3);

        foreach ($user->client->authorizationsForUser($user)->get() as $item) {
            $this->info($item->name);
        }

        /**
         * User has a client authorization as admin.
         * User has a <model> authorization
         */

        return 0;
    }
}
