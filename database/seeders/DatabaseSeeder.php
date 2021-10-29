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
        User::create([
            'username' => 'user',
            'firstname' => 'user',
            'lastname' => 'user',
            'email' => 'user@test.com',
            'password' => Hash::make('user'),
            'phone_number' => '06282223',
            'companyID' => '1',
            'companyRole' => 'employee'
        ]);

        // create user that is a manager
        User::create([
            'username' => 'manager',
            'firstname' => 'manager',
            'lastname' => 'manager',
            'email' => 'manager@test.com',
            'password' => Hash::make('manager'),
            'phone_number' => '0623423',
            'companyID' => '1',
            'companyRole' => 'manager'
        ]);

        // create admin
        User::create([
            'username' => 'mo',
            'firstname' => 'moemm',
            'lastname' => 'hus',
            'email' => 'hus@test.com',
            'password' => Hash::make('hussein'),
            'phone_number' => '06283',
            'role' => 'admin',
            'companyID' => '0',
            'companyRole' => 'admin'
        ]);
    }
}
