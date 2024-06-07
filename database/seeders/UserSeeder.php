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
            'email' => 'jitendrakumar0063@gmail.com',
            'password' => bcrypt(1234),
            'designation' => 'admin',
            'role' => 'Admin',
            'is_admin' => 1

        ];
        user::create($data);
    }
}
