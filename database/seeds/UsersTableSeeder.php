<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        User::create([
            'email' => 'jernej@example.si',
            'password' => bcrypt('password')
        ]);
    }

}