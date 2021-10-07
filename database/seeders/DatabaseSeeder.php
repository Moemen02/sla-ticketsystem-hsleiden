<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'username' => 'User',
        //     'firstname' => 'user',
        //     'lastname' => 'user',
        //     'email' => 'user@test.com',
        //     'password' => Hash::make('secret'),
        // ]);
    }
}
