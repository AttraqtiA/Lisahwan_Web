<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Hendra',
            'role_id' => 1,
            'is_login' => '1',
            'is_active' => '1',
            'email' => 'owner_lisahwan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('lisahwanSnack88'),
            'phone_number' => '082230308030',
            'profile_picture' => 'lisahwan_logo.png',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Oppy',
            'role_id' => 2,
            'is_login' => '1',
            'is_active' => '1',
            'email' => 'admin_lisahwan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adminLisahwan88'),
            'phone_number' => '082230308030',
            'profile_picture' => 'lisahwan_logo.png',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Louis Fernando',
            'role_id' => 3,
            'is_login' => '1',
            'is_active' => '1',
            'email' => 'louis@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('customerLisahwan88'),
            'phone_number' => '081292898969',
            'profile_picture' => 'lisahwan_logo.png',
            'remember_token' => Str::random(10),
        ]);

        // User::factory(3)->create();
    }
}
