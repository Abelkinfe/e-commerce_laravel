<?php


namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->pluck('id');

        foreach ($categories as $categoryId) {
            for ($i = 0; $i < 5; $i++) {
                DB::table('products')->insert([
                    'name' => Str::random(10),
                    'description' => Str::random(50),
                    'product_img' => null, 
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
