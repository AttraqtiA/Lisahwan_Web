<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'user_id' => 1,
            'address' => 'Jln. Jemur Andayani XIII No. 6',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => '60237',
        ]);

        Address::create([
            'user_id' => 2,
            'address' => 'Jln. Jemur Andayani XIII No. 6',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => '60237',
        ]);
    }
}
