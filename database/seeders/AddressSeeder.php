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
        // Address::create([
        //     'user_id' => 1,
        //     'address' => 'Jl. Jemur Andayani XIII No. 6',
        //     'city' => 'Surabaya',
        //     'province' => 'Jawa Timur',
        //     'postal_code' => '60237',
        //     // 'is_main_address' => '1', // if address is empty for the user, set to 1 automatically by default
        // ]);

        // Address::create([
        //     'user_id' => 1,
        //     'address' => 'ALAMAT KEGOCEK',
        //     'city' => 'Semarang',
        //     'province' => 'Sacred Timeline',
        //     'postal_code' => '60237',
        //     // 'is_main_address' => '1', // if address is empty for the user, set to 1 automatically by default
        // ]);
    }
}
