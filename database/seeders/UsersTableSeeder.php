<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'developer@gmail.com',
            'username' => 'developer',
            'password' => Hash::make('Test@Password123#'),
        ]);
    }
}

