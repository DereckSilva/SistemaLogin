<?php

namespace App\Console\Commands;

use App\Jobs\SendMail;
use App\Models\User;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::get();

        foreach ($users as $user) {
            SendMail::dispatch($user->name, $user->email)->onQueue('cadUser');
        }
    }
}
