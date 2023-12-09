<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // KALAU WEIGHT 0 BERARTI TIDAK ADA DI TOKPED, weightnya aku ambil dari tokped soalnya

        DB::table("products")->insert([
            'name' => 'Teri Oven',
            'price' => 61000,
            'stock' => 0,
            'weight' => 150,
            'discount' => 0,
            'best_seller' => true,
            'image' => '/images/fotoproduk/TeriOven.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kentang Abon',
            'price' => 40000,
            'stock' => 0,
            'weight' => 150,
            'discount' => 0,
            'best_seller' => true,
            'image' => '/images/fotoproduk/KentangAbon.jpg',
        ]);


        DB::table("products")->insert([
            'name' => 'Kering Kentang',
            'price' => 44000,
            'stock' => 0,
            'weight' => 380,
            'discount' => 0,
            'best_seller' => true,
            'image' => '/images/fotoproduk/KeringKentang.jpg',
        ]);


        DB::table("products")->insert([
            'name' => 'Teri Jumbo Pedas',
            'price' => 45000,
            'stock' => 0,
            'weight' => 220,
            'discount' => 0,
            'best_seller' => true,
            'image' => '/images/fotoproduk/TeriJumboPedas.jpeg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kentang Chili',
            'price' => 43000,
            'stock' => 0,
            'weight' => 0,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KentangChili.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Teri Honje',
            'price' => 42000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/TeriHonje.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Dendeng Balado',
            'price' => 55000,
            'stock' => 0,
            'weight' => 110,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/DendengBalado.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kering Kentang (Jar)',
            'price' => 38000,
            'stock' => 0,
            'weight' => 250,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KeringKentangJar.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kering Tempe',
            'price' => 47000,
            'stock' => 0,
            'weight' => 420,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KeringTempe.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Teri Kacang Balado',
            'price' => 49000,
            'stock' => 0,
            'weight' => 190,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/TeriKacangBalado.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kentang Teri',
            'price' => 44000,
            'stock' => 0,
            'weight' => 320,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KentangTeri.jpeg',
        ]);

        DB::table("products")->insert([
            'name' => 'Emping Udang',
            'price' => 35000,
            'stock' => 0,
            'weight' => 0,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/EmpingUdang.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Emping Udang (Mentah)',
            'price' => 55000,
            'stock' => 0,
            'weight' => 500,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/EmpingUdangMentah.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kentang Teri Ori',
            'price' => 40000,
            'stock' => 0,
            'weight' => 0,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KentangTeriori.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kering Kentang Thinwall',
            'price' => 47000,
            'stock' => 0,
            'weight' => 0,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KeringKentangThinwall.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kentang Dendeng',
            'price' => 65000,
            'stock' => 0,
            'weight' => 0,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KentangDendeng.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Wader Crispy',
            'price' => 47000,
            'stock' => 0,
            'weight' => 160,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/WaderCrispy.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kuku Macan',
            'price' => 37000,
            'stock' => 0,
            'weight' => 150,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KukuMacan.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Teri Ijo',
            'price' => 38000,
            'stock' => 0,
            'weight' => 0,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/TeriIjo.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Teri Balado',
            'price' => 38000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/TeriBalado.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Ikan Seriding',
            'price' => 40000,
            'stock' => 0,
            'weight' => 350,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/IkanSeriding.jpg',
        ]);

        DB::table("products")->insert([
            'name' => 'Kentang Balado',
            'price' => 39000,
            'stock' => 0,
            'weight' => 225,
            'discount' => 0,
            'best_seller' => false,
            'image' => '/images/fotoproduk/KentangBalado.jpg',
        ]);


    }
}
