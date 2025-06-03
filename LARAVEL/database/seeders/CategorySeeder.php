<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan Utama',
                'description' => 'Menu makanan utama yang mengenyangkan',
            ],
            [
                'name' => 'Minuman',
                'description' => 'Berbagai pilihan minuman segar',
            ],
            [
                'name' => 'Dessert',
                'description' => 'Hidangan penutup yang manis dan lezat',
            ],
            [
                'name' => 'Appetizer',
                'description' => 'Hidangan pembuka yang menggugah selera',
            ],
            [
                'name' => 'Paket Hemat',
                'description' => 'Kombinasi menu dengan harga terjangkau',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}