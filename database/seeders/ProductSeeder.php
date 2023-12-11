<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Teri Oven',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 61000,
            'stock' => 50,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'TeriOven.jpg'
        ]);

        Product::create([
            'name' => 'Kentang Abon',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 40000,
            'stock' => 50,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KentangAbon.jpg'
        ]);

        Product::create([
            'name' => 'Kering Kentang',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 44000,
            'stock' => 50,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KeringKentang.jpg',
        ]);

        Product::create([
            'name' => 'Teri Jumbo Pedas',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 45000,
            'stock' => 50,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'TeriJumboPedas.jpeg',
        ]);

        Product::create([
            'name' => 'Kentang Chili',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 43000,
            'stock' => 50,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KentangChili.jpg',
        ]);

        Product::create([
            'name' => 'Teri Honje',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 42000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'TeriHonje.jpg',
        ]);

        Product::create([
            'name' => 'Dendeng Balado',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 55000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'DendengBalado.jpg',
        ]);

        Product::create([
            'name' => 'Kering Tempe',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 47000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KeringTempe.jpg',
        ]);

        Product::create([
            'name' => 'Teri Kacang Balado',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 49000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'TeriKacangBalado.jpg',
        ]);

        Product::create([
            'name' => 'Kentang Teri',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 44000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KentangTeri.jpeg',
        ]);

        Product::create([
            'name' => 'Emping Udang',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 35000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'EmpingUdang.jpg',
        ]);

        Product::create([
            'name' => 'Emping Udang (Mentah)',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 55000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'EmpingUdangMentah.jpg',
        ]);

        Product::create([
            'name' => 'Kentang Teri Ori',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 40000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KentangTeriori.jpg',
        ]);

        Product::create([
            'name' => 'Kering Kentang Thinwall',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 47000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KeringKentangThinwall.jpg',
        ]);

        Product::create([
            'name' => 'Kentang Dendeng',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 65000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KentangDendeng.jpg',
        ]);

        Product::create([
            'name' => 'Wader Crispy',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 47000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'WaderCrispy.jpg',
        ]);

        Product::create([
            'name' => 'Kuku Macan',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 37000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KukuMacan.jpg',
        ]);

        Product::create([
            'name' => 'Teri Ijo',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 38000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'TeriIjo.jpg',
        ]);

        Product::create([
            'name' => 'Teri Balado',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 38000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'TeriBalado.jpg',
        ]);

        Product::create([
            'name' => 'Ikan Seriding',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 40000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'IkanSeriding.jpg',
        ]);

        Product::create([
            'name' => 'Kentang Balado',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 39000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KentangBalado.jpg',
        ]);

        Product::create([
            'name' => 'Kering Kentang (Jar)',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
            'price' => 38000,
            'stock' => 0,
            'weight' => 100,
            'discount' => 0,
            'favorite_status' => '0',
            'image' => 'KeringKentangJar.jpg',
        ]);
    }
}
