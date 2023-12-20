<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'user_id' => 1,
            'address' => 'Jalan Jemur Andayani XIII No. 6',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => 60237
        ]);
        // Address::create([
        //     'user_id' => 1,
        //     'address' => 'Jalan Jemur Andayani XIII No. 6',
        //     'city' => 'Surabaya',
        //     'province' => 'Jawa Timur',
        //     'postal_code' => 60237
        // ]);
        // Address::create([
        //     'user_id' => 1,
        //     'address' => 'Jalan Jemur Andayani XIII No. 6',
        //     'city' => 'Surabaya',
        //     'province' => 'Jawa Timur',
        //     'postal_code' => 60237
        // ]);
    }
}
