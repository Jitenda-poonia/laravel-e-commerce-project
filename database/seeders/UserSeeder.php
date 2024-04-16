<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'jitendra choudhary',
            'email' =>'jitendrakumar00632@gmail.com',
            'password' => bcrypt(123),
            'is_admin' =>1

        ];
        user::create($data);
    }
}
