<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SyncUserRegisterMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-user-register-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $users = User::all();
       foreach ($users as $key => $user) {
        $user_data = [
'name' => $user->name,
'mobile' => $user->mobile,

        ];
       }
    }
}
