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
            'description' => 'Kress, gurih, cocok jadi pelengkap nasi atau camilan. Direkomendasikan! Terbuat dari ikan teri nasi tanpa tepung.',
            'price' => 65000,
            'stock' => 50,
            'weight' => 350,
            'discount' => 0,
            'image' => 'TeriOven.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Kentang Abon',
            'description' => 'Dibuat dari kentang pilihan, proses handmade dengan resep bumbu khas Lisahwan, dilapis Abon Sapi terbaik.',
            'price' => 43000,
            'stock' => 50,
            'weight' => 350,
            'discount' => 0,
            'image' => 'KentangAbon.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Kering Kentang',
            'description' => 'Enak, renyah, bumbu pas, asem manis yang sempurna. Terbuat dari kentang dan kacang pilihan, bikin nagih!',
            'price' => 47000,
            'stock' => 50,
            'weight' => 600,
            'discount' => 0,
            'image' => 'KeringKentang.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Teri Jumbo Pedas',
            'description' => 'Cari lauk praktis yang enak? Cobain Teri Jumbo Pedas Lisahwan: gurih, kriuk renyah, manis, pedas pas!',
            'price' => 48000,
            'stock' => 50,
            'weight' => 350,
            'discount' => 0,
            'image' => 'TeriJumboPedas.jpeg',
            'special_status' => 'tidak'
        ]);

        // Product::create([
        //     'name' => 'Kentang Chili',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
        //     'price' => 43000,
        //     'stock' => 50,
        //     'weight' => 200,
        //     'discount' => 0,
        //     'favorite_status' => '0',
        //     'image' => 'KentangChili.jpg',
        //     'special_status' => 'tidak'
        // ]);

        Product::create([
            'name' => 'Teri Honje',
            'description' => 'Teri Honje Lisahwan: Gurih, kecil, kriuk! Aroma honje/kecombrang bikin spesial. Cocok sebagai pelengkap nasi atau cemilan manis gurih.',
            'price' => 44000,
            'stock' => 50,
            'weight' => 250,
            'discount' => 0,
            'image' => 'TeriHonje.jpg',
            'special_status' => 'tidak'

        ]);

        Product::create([
            'name' => 'Dendeng Balado',
            'description' => 'Siap saji! Aromanya wangi, empuk, dan bumbu baladonya meresap sempurna ke dalam dendengnya. Dibuat dari daging sapi asli. Pasti nikmat!',
            'price' => 57000,
            'stock' => 50,
            'weight' => 250,
            'discount' => 0,
            'image' => 'DendengBalado.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Kering Tempe',
            'description' => 'Kering Tempe Lisahwan dibuat dengan 100% bahan alami dan berkualitas. Pas banget buat lauk makan, pasti enak dan praktis.',
            'price' => 55000,
            'stock' => 50,
            'weight' => 600,
            'discount' => 0,
            'image' => 'KeringTempe.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Teri Kacang Balado',
            'description' => 'Musti coba nih! Enak dimakan dengan nasi atau jadi cemilan. Rasa pedas balado yang menyatu dengan teri dan kacang. Perpaduan sempurna antara manis, pedas, asam, dan gurih. Pasti mantap!',
            'price' => 52000,
            'stock' => 50,
            'weight' => 350,
            'discount' => 0,
            'image' => 'TeriKacangBalado.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Kering Kentang Teri',
            'description' => 'Kering Kentang Teri Lisahwan ini luar biasa! Kentang renyah dengan kacang, disertai Teri Jumbo yang gurih. Bumbu mantap, perpaduan asem manis dan pedas bikin nagih. Cocok untuk lauk atau cemilan!',
            'price' => 47000,
            'stock' => 50,
            'weight' => 600,
            'discount' => 0,
            'image' => 'KentangTeri.jpeg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Emping Udang',
            'description' => 'Emping Udang Lisahwan: Renyah, gurih, dan lezat. Camilan eksklusif yang memikat selera Anda dengan setiap gigitan.',
            'price' => 35000,
            'stock' => 50,
            'weight' => 500,
            'discount' => 0,
            'image' => 'EmpingUdang.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Emping Udang (Mentah)',
            'description' => 'Emping Udang Lisahwan: Renyah, gurih, dan lezat. Camilan eksklusif yang memikat selera Anda dengan setiap gigitan.',
            'price' => 65000,
            'stock' => 50,
            'weight' => 500,
            'discount' => 0,
            'image' => 'EmpingUdangMentah.jpg',
            'special_status' => 'tidak'
        ]);

        // Product::create([
        //     'name' => 'Kentang Teri Ori',
        //     'description' => 'Kentang Teri Ori Lisahwan: Potongan kentang renyah, disempurnakan dengan sentuhan gurih dan krispi teri asli. Sejukkan lidah Anda dengan kelezatan yang otentik.',
        //     'price' => 40000,
        //     'stock' => 50,
        //     'weight' => 200,
        //     'discount' => 0,
        //     'image' => 'KentangTeriori.jpg',
        //     'special_status' => 'tidak'
        // ]);

        // Product::create([
        //     'name' => 'Kering Kentang Thinwall',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi commodi illo ea iure quo officiis eveniet dignissimos ab itaque laudantium?',
        //     'price' => 47000,
        //     'stock' => 0,
        //     'weight' => 100,
        //     'discount' => 0,
        //     'favorite_status' => '0',
        //     'image' => 'KeringKentangThinwall.jpg',
        //     'special_status' => 'tidak'
        // ]);

        Product::create([
            'name' => 'Kentang Dendeng',
            'description' => 'Kentang Dendeng Lisahwan: Gurih, renyah, dan lezat. Paduan sempurna antara kentang berkualitas tinggi dan cita rasa dendeng yang memikat. Nikmati sensasi unik dalam setiap suapannya.',
            'price' => 65000,
            'stock' => 50,
            'weight' => 500,
            'discount' => 0,
            'image' => 'KentangDendeng.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Wader Crispy',
            'description' => 'Dibuat dari ikan wader hitam dengan baluran tepung spesial, cocok sebagai pelengkap lauk. Kriuk dan gurih! Yuk dicoba!',
            'price' => 47000,
            'stock' => 50,
            'weight' => 400,
            'discount' => 0,
            'image' => 'WaderCrispy.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Kuku Macan',
            'description' => 'Krupuk Kuku Macan Lisahwan: Ikan tenggiri, gurih, dan renyah. Kriuk-kriukk enaknya jelas terasa!',
            'price' => 37000,
            'stock' => 50,
            'weight' => 350,
            'discount' => 0,
            'image' => 'KukuMacan.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Teri Ijo',
            'description' => 'Teri Ijo Lisahwan: Gurih, segar, dan lezat. Pilihan camilan yang memikat dengan kelezatan ikan teri hijau dalam setiap sajian.',
            'price' => 40000,
            'stock' => 50,
            'weight' => 250,
            'discount' => 0,
            'image' => 'TeriIjo.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Teri Balado',
            'description' => 'Nikmati Teri Balado kami yang lezat! Gabungan sempurna antara pedas dan manis dalam setiap gigitan. Dengan bumbu balado khas Lisahwan, tekstur renyah, dan aroma menggoda, Teri Balado ini cocok untuk menemani momen santai Anda.',
            'price' => 40000,
            'stock' => 50,
            'weight' => 250,
            'discount' => 0,
            'image' => 'TeriBalado.jpg',
            'special_status' => 'tidak'
        ]);

        // Product::create([
        //     'name' => 'Ikan Seriding',
        //     'description' => 'Ikan Seriding Lisahwan: gurih, krispi, sempurna untuk camilan atau hidangan istimewa. Menggoyang lidah Anda dalam setiap gigitan!',
        //     'price' => 40000,
        //     'stock' => 50,
        //     'weight' => 150,
        //     'discount' => 0,
        //     'image' => 'IkanSeriding.jpg',
        //     'special_status' => 'tidak'
        // ]);

        Product::create([
            'name' => 'Kentang Balado',
            'description' => 'Kentang Balado Lisahwan: Potongan kentang garing yang dipadu dengan balado pedas dan sedap. Sensasi lezat yang memanjakan lidah Anda.',
            'price' => 45000,
            'stock' => 50,
            'weight' => 400,
            'discount' => 0,
            'image' => 'KentangBalado.jpg',
            'special_status' => 'tidak'
        ]);

        // Product::create([
        //     'name' => 'Kering Kentang (Jar)',
        //     'description' => 'Enak, renyah, bumbu pas, asem manis yang sempurna. Terbuat dari kentang dan kacang pilihan, bikin nagih!',
        //     'price' => 38000,
        //     'stock' => 50,
        //     'weight' => 200,
        //     'discount' => 0,
        //     'image' => 'KeringKentangJar.jpg',
        //     'special_status' => 'tidak'
        // ]);

        Product::create([
            'name' => 'Sambal Cumi',
            'description' => 'Belum ada deskripsi!',
            'price' => 30000,
            'stock' => 50,
            'weight' => 250,
            'discount' => 0,
            'image' => 'SambalCumi.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Kentang Ebi',
            'description' => 'Belum ada deskripsi!',
            'price' => 98000,
            'stock' => 50,
            'weight' => 500,
            'discount' => 0,
            'image' => 'KentangEbi.jpg',
            'special_status' => 'tidak'
        ]);

        Product::create([
            'name' => 'Spikoe Lisahwan',
            'description' => 'Belum ada deskripsi!',
            'price' => 105000,
            'stock' => 50,
            'weight' => 800,
            'discount' => 0,
            'image' => 'SpikoeLisahwan.jpg',
            'special_status' => 'tidak'
        ]);
    }
}
