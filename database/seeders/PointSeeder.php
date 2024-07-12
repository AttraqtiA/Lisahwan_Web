<?php

namespace Database\Seeders;

use App\Models\Point;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Point::create([
            'percentage_from_totalprice' => 5,
            'money_per_poin' => 50
        ]);
    }
}
