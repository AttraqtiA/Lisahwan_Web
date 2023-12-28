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
            'title' => 'Waktu Ngemil jadi Memorable',
            'content' => 'GalleryCarousel_12.jpeg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Kualitas Premium & Terjamin',
            'content' => 'GalleryCarousel_11.jpg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Testimoni MamaRia',
            'content' => 'PromotionVideo_MamaRia.mp4',
            'type' => 'video'
        ]);

        Gallery::create([
            'title' => 'Kering Kentang Thinwall',
            'content' => 'KeringKentangThinwall.jpg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Spesialis Teri Oven',
            'content' => 'GalleryCarousel_13.jpeg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Kentang Teri Ori',
            'content' => 'GalleryCarousel_1.jpg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Lisahwan Promotion Video',
            'content' => 'LisahwanPromotionVideo.mp4',
            'type' => 'video'
        ]);

        Gallery::create([
            'title' => 'Kualitas adalah Prioritas Kami',
            'content' => 'GalleryCarousel_8.jpg',
            'type' => 'image'
        ]);

        Gallery::create([
            'title' => 'Rasa yang Tak Terlupakan dan Dijamin Nagih!',
            'content' => 'GalleryCarousel_10.jpg',
            'type' => 'image'
        ]);
    }
}
