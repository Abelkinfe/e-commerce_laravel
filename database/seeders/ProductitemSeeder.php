<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ProductitemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { $products = DB::table('products')->pluck('id');

        foreach ($products as $productId) {
            for ($i = 0; $i < 3; $i++) {
                DB::table('product_items')->insert([
                    'price' => rand(1000, 10000) / 100,
                    'qty_instock' => rand(1, 100),
                    'product_id' => $productId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
