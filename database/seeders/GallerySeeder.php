<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::create([
            'title' => 'Momen Sederhana Jadi Lebih Berarti',
            'content' => 'GalleryCarousel_12.jpeg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Mudahnya Membawa Pulang Rasa Lisahwan',
            'content' => 'LisahwanWeb_PromotionalVideo.mp4',
            'type' => 'video'
        ]);

        Gallery::create([
            'title' => 'Cita Rasa yang Layak Dibagikan',
            'content' => 'CTDLocalHeroes_PromotionVideo.mp4',
            'type' => 'video'
        ]);

        Gallery::create([
            'title' => 'Cerita Rasa dari Pelanggan Kami',
            'content' => 'PromotionVideo_MamaRia.mp4',
            'type' => 'video'
        ]);

        // Gallery::create([
        //     'title' => 'Kering Kentang Thinwall',
        //     'content' => 'KeringKentangThinwall.jpg',
        //     'type' => 'image'
        // ]);

        Gallery::create([
            'title' => 'Kelembutan Klasik, Resep Keluarga Lisahwan',
            'content' => 'GalleryCarousel_15.jpg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Sajian Praktis, Cita Rasa Nusantara',
            'content' => 'GalleryCarousel_1.jpg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Kenali Lebih Dekat Kisah Lisahwan',
            'content' => 'LisahwanPromotionVideo.mp4',
            'type' => 'video'
        ]);

        Gallery::create([
            'title' => 'Kualitas & Konsistensi Sejak 2007',
            'content' => 'GalleryCarousel_8.jpg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Rasa yang Ingin Anda Bawa Pulang',
            'content' => 'GalleryCarousel_10.jpg',
            'type' => 'image'
        ]);
    }
}
