<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'user_id' => 1,
            'address_id' => 1,
            'midtrans_order_id' => 12345,
            'order_date' =>  '2021-01-01 7:00:00',
            'shipment_date' => '2021-01-02 9:00:00',
            'arrived_date' =>  '2021-01-03 12:00:00',
            'total_price' => 100000,
            'total_weight' => 1000,
            'payment' => 'upload_images/rAhKZFIsKaSLzM8WdYXd1VeALNvQavPxhKxGYH4h.jpg',
            'waybill' => 'SOCAG00183235715',
            'note' => 'askhdlaskuasdas',
            'shipment_service' => 'JNE (OKE)',
            'shipment_estimation' => '3-4',
            'is_print' => 'pending',
            'shipment_status' => 'pending',
            'acceptbyAdmin_status' => 'pending',
            'acceptbyCustomer_status' => 'pending',
        ]);

        Order::create([
            'user_id' => 1,
            'address_id' => 1,
            'midtrans_order_id' => 12345,
            'order_date' =>  '2023-12-21 7:00:00',
            'shipment_date' => '2021-01-02 9:00:00',
            'arrived_date' =>  '2021-01-03 12:00:00',
            'total_price' => 100000,
            'total_weight' => 1000,
            'payment' => '',
            'waybill' => 'SOCAG00183235715',
            'note' => 'askhdlaskuasdas',
            'shipment_service' => 'JNE (OKE)',
            'shipment_estimation' => '3-4',
            'is_print' => 'pending',
            'shipment_status' => 'pending',
            'acceptbyAdmin_status' => 'pending',
            'acceptbyCustomer_status' => 'pending',
        ]);

        Order::create([
            'user_id' => 1,
            'address_id' => 1,
            'midtrans_order_id' => 12345,
            'order_date' =>  '2023-12-20 7:00:00',
            'shipment_date' => '2021-01-02 9:00:00',
            'arrived_date' =>  '2021-01-03 12:00:00',
            'total_price' => 100000,
            'total_weight' => 1000,
            'payment' => 'IMAGE',
            'waybill' => 'SOCAG00183235715',
            'note' => 'askhdlaskuasdas',
            'shipment_service' => 'JNE (OKE)',
            'shipment_estimation' => '3-4',
            'is_print' => 'pending',
            'shipment_status' => 'pending',
            'acceptbyAdmin_status' => 'pending',
            'acceptbyCustomer_status' => 'pending',
        ]);
    }
}
