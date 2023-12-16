<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'user_id' => '1',
            'address_id' => '1',
            'order_date' => '2023-04-04',
            'shipment_date' => '2023-04-11',
            'total_price' => 100000,
            'total_weight' => 400,
            'payment' => 'bukti_tfbca.jpeg',
            'note' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est et voluptate magni similique quasi!'
        ]);
        Order::create([
            'user_id' => '1',
            'address_id' => '1',
            'order_date' => '2023-05-05',
            'shipment_date' => '2023-05-12',
            'total_price' => 100000,
            'total_weight' => 400,
            'payment' => 'bukti_tfbca.jpeg',
            'note' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est et voluptate magni similique quasi!'
        ]);
    }
}
