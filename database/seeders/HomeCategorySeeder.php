<?php

namespace Database\Seeders;

use App\Models\HomeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryrecords = [
            ['id'=>1 , 'sel_categories' => 1 ,'no_of_products' => 10 ]
        ];
        HomeCategory::insert($categoryrecords);
    }
}
