<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * 
     */



    public function run(): void
    {
        $categories = array("Tech", "Gaming", "Productivity", "Lifestyle", "How-to");

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category' => $category
            ]);
        }
    }
}
