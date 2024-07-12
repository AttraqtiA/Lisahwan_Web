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
            'title' => 'AGUSTUSCERIA',
            'starting_time' => '2024-07-01 16:00:00',
            'ending_time' => '2024-07-15 16:00:00',
            'discount' => '5',
            'initial_quantity' => 5
        ]);
        Coupon::create([
            'title' => 'SEPTEMBERCERIA',
            'starting_time' => '2024-07-03 16:00:00',
            'ending_time' => '2024-07-15 16:00:00',
            'discount' => '3',
            'initial_quantity' => 5
        ]);
        Coupon::create([
            'title' => 'OKTOBERCERIA',
            'starting_time' => '2024-07-04 16:00:00',
            'ending_time' => '2024-07-15 16:00:00',
            'discount' => '2',
            'initial_quantity' => 5
        ]);
    }
}
