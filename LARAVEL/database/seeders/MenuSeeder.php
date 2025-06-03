<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Mendapatkan ID kategori
        $mainCourseId = Category::where('name', 'Makanan Utama')->first()->id;
        $beverageId = Category::where('name', 'Minuman')->first()->id;
        $dessertId = Category::where('name', 'Dessert')->first()->id;
        $appetizerId = Category::where('name', 'Appetizer')->first()->id;
        $packageId = Category::where('name', 'Paket Hemat')->first()->id;

        $menus = [
            // Makanan Utama
            [
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam, dan sayuran',
                'price' => 35000,
                'is_available' => true,
                'category_id' => $mainCourseId,
            ],
            [
                'name' => 'Mie Goreng',
                'description' => 'Mie goreng dengan telur dan sayuran',
                'price' => 30000,
                'is_available' => true,
                'category_id' => $mainCourseId,
            ],
            
            // Minuman
            [
                'name' => 'Es Teh Manis',
                'description' => 'Teh manis dingin yang menyegarkan',
                'price' => 8000,
                'is_available' => true,
                'category_id' => $beverageId,
            ],
            [
                'name' => 'Jus Alpukat',
                'description' => 'Jus alpukat segar dengan susu',
                'price' => 15000,
                'is_available' => true,
                'category_id' => $beverageId,
            ],
            
            // Dessert
            [
                'name' => 'Es Krim Vanilla',
                'description' => 'Es krim vanilla dengan topping coklat',
                'price' => 12000,
                'is_available' => true,
                'category_id' => $dessertId,
            ],
            [
                'name' => 'Pudding Coklat',
                'description' => 'Pudding coklat lembut dengan saus vanilla',
                'price' => 10000,
                'is_available' => true,
                'category_id' => $dessertId,
            ],
            
            // Appetizer
            [
                'name' => 'Lumpia Goreng',
                'description' => 'Lumpia goreng isi sayuran',
                'price' => 15000,
                'is_available' => true,
                'category_id' => $appetizerId,
            ],
            [
                'name' => 'Sup Ayam',
                'description' => 'Sup ayam dengan sayuran segar',
                'price' => 20000,
                'is_available' => true,
                'category_id' => $appetizerId,
            ],
            
            // Paket Hemat
            [
                'name' => 'Paket Nasi Ayam',
                'description' => 'Nasi dengan ayam goreng dan sayuran',
                'price' => 25000,
                'is_available' => true,
                'category_id' => $packageId,
            ],
            [
                'name' => 'Paket Mie Komplit',
                'description' => 'Mie goreng dengan telur dan minuman',
                'price' => 28000,
                'is_available' => true,
                'category_id' => $packageId,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}