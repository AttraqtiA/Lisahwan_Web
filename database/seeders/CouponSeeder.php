<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'title' => 'JULYCERIA',
            'starting_time' => '2024-07-10 16:00:00',
            'ending_time' => '2024-07-15 09:00:00',
            'discount' => '10',
            'initial_quantity' => 5
        ]);
        Coupon::create([
            'title' => 'AGUSTUSMERDEKA',
            'starting_time' => '2024-08-01 00:00:00',
            'ending_time' => '2024-08-31 00:00:00',
            'discount' => '17',
            'initial_quantity' => 100
        ]);
        Coupon::create([
            'title' => 'SEPTEMBERCERIA',
            'starting_time' => '2024-08-03 16:00:00',
            'ending_time' => '2024-09-15 16:00:00',
            'discount' => '3',
            'initial_quantity' => 5
        ]);
        Coupon::create([
            'title' => 'OKTOBERCERIA',
            'starting_time' => '2024-10-04 16:00:00',
            'ending_time' => '2024-10-15 16:00:00',
            'discount' => '2',
            'initial_quantity' => 5
        ]);
    }
}
