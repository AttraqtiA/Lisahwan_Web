<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Louis Fernando',
            'role_id' => 1,
            'email' => 'fernandolouis55@gmail.com',
            'password' => '12345',
            'phone_number' => '08123456789',
            'profile_picture' => 'customer.jpg'
        ]);
    }
}
