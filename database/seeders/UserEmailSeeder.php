<?php

namespace Database\Seeders;

use App\Mail\UserEmail;
use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class UserEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailTemplate::create([
            'title' => 'User Emial',
            'key' => UserEmail::class,
            'subect' => 'User Emial Notification'
        ]);
    }
}
