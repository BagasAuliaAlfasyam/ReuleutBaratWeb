<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        \App\Models\User::create([
            'username' => 'admin',
            'fullname' => 'ADMIN',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'phone' => '085155353793',
            'address' => 'Desa Reuleut Barat, Kecamatan Muara Batu Kabupaten Aceh Utara',
            'user_images' => 'profile-img.jpg',
            'role' => true
        ]);
        \App\Models\User::create([
            'username' => 'Sekretaris Desa',
            'fullname' => 'Sekretaris Desa',
            'email' => 'sekdes@reuleutbarat.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'phone' => '085155353793',
            'address' => 'Desa Reuleut Barat, Kecamatan Muara Batu Kabupaten Aceh Utara',
            'user_images' => 'profile-img.jpg',
            'role' => false
        ]);
        // \App\Models\Post::factory(100)->create();

        \App\Models\Category::create([
            'slug' => 'aparatur-desa',
            'name' => 'Aparatur Desa'
        ]);
        \App\Models\Category::create([
            'slug' => 'umkm',
            'name' => 'UMKM'
        ]);
        \App\Models\Tag::create([
            'slug_tag' => 'reuleut-barat-sejahtera',
            'name_tag' => 'Reuleut Barat sejahtera'
        ]);
        \App\Models\Tag::create([
            'slug_tag' => 'KKN TEMATIK',
            'name_tag' => 'KKN TEMATIK'
        ]);
    }
}