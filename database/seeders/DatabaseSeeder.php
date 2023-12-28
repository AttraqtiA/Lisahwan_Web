<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Model::unguard();

        $this->call([
            ProductSeeder::class,
            GallerySeeder::class,

            RoleSeeder::class, // Role seeder sebelum user ajaa
            UserSeeder::class,

            AddressSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,

            // ProductionSeeder::class,
        ]);

        Model::reguard();
    }
}
