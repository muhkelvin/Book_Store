<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Fiksi']);
        Category::create(['name' => 'Non-Fiksi']);
        Category::create(['name' => 'Anak-anak']);
        Category::create(['name' => 'Komik']);
    }
}
