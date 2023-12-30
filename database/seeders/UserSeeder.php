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
            'role_id' => 1, // DI USER FACTORY ROLENYA 3, member
            'is_login' => '0',
            'is_active' => '1',
            'email' => 'owner_lisahwan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('lisahwanSnack88'),
            'phone_number' => '082230308030',
            'profile_picture' => 'lisahwan_logo.crdownload',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Oppy',
            'role_id' => 2,
            'is_login' => '0',
            'is_active' => '1',
            'email' => 'admin_lisahwan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adminLisahwan88'),
            'phone_number' => '082230308030',
            'profile_picture' => 'lisahwan_logo.crdownload',
            'remember_token' => Str::random(10),
        ]);

        // User::factory(3)->create();
    }
}
