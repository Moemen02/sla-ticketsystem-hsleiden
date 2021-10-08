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
        // Create a user
        // User::create([
        //     'username' => 'mo',
        //     'firstname' => 'moemm',
        //     'lastname' => 'hus',
        //     'email' => 'hus@test.com',
        //     'password' => Hash::make('hussein'),
        // ]);
    }
}
