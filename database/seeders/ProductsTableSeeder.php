<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Buku Fiksi A',
            'description' => 'Deskripsi buku fiksi A',
            'price' => 50000,
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Buku Non-Fiksi B',
            'description' => 'Deskripsi buku non-fiksi B',
            'price' => 60000,
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Buku Anak-anak C',
            'description' => 'Deskripsi buku anak-anak C',
            'price' => 30000,
            'category_id' => 3
        ]);

        Product::create([
            'name' => 'Komik D',
            'description' => 'Deskripsi komik D',
            'price' => 40000,
            'category_id' => 4
        ]);
    }

}
