<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Добавляем несколько товаров
        Product::create([
            'name' => 'Товар 1',
            'price' => 100.00
        ]);

        Product::create([
            'name' => 'Товар 2',
            'price' => 200.00
        ]);

        Product::create([
            'name' => 'Товар 3',
            'price' => 300.00
        ]);
    }
}
