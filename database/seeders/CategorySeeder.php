<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories=["FACE","EYE","LIP","MAKEUP TOOL","MAKEUP REMOVER"];
        foreach($categories as $category){
            DB::table('categories')->insert([
                'category_name' => $category,
                'parent_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }





        $faceparent = Category::where('category_name', 'FACE')->first();
        $Faces=["face primer","foundation","cc cream","concealer","blush",
        "setting spray","powder","high lighter","bronzer","moisturizer",
        "colour corectors"];
        foreach($Faces as $face){
            DB::table('categories')->insert([
                'category_name' => $face,
                'parent_category_id' => $faceparent->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }      
        
        $eyeparent = Category::where('category_name', 'EYE')->first();
        $eyes=["eye primer","eye shadow","mascara","eye liner","eyebrow"];
        foreach($eyes as $eye){
            DB::table('categories')->insert([
                'category_name' => $eye,
                'parent_category_id' => $eyeparent->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }     
        
        


        $lipparent = Category::where('category_name', 'LIP')->first();
        $lips=["lip glass","lips stick","lip liner","lip balm"];
        foreach($lips as $lip){
            DB::table('categories')->insert([
                'category_name' => $lip,
                'parent_category_id' => $lipparent->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }      


        
        $makeuptoolparent = Category::where('category_name', 'MAKEUP TOOL')->first();
        $makeuptools=["makeup sponges","makeup organizer","makeup brushes","makeup varity","makeup bag",
        "makeup mirror","makeup palette","makeup erases"];
        foreach( $makeuptools as  $makeuptool){
            DB::table('categories')->insert([
                'category_name' => $makeuptool,
                'parent_category_id' =>  $makeuptoolparent->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }      

  
        $makeupremoverparent = Category::where('category_name', 'MAKEUP REMOVER')->first();
        $makeupremovers=["makeup sponges","makeup organizer","makeup brushes","makeup varity","makeup bag",
        "makeup mirror","makeup palette","makeup erases"];
        foreach(  $makeupremovers as   $makeupremover){
            DB::table('categories')->insert([
                'category_name' => $makeupremover,
                'parent_category_id' =>   $makeupremoverparent->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }      

    }
}
