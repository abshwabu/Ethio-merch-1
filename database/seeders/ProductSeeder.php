<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords=[
            ['id'=>1,'category_id'=>2,'section_id'=>1,
            'product_name'=>'new casual T-shirt','description'=>'',
            'slug'=>'t-shirt','regular_price'=>'12','sale_price'=>'60','product_code'=>'EM1234','product_color'=>'Red','added_by'=>'1','created_at'=>Carbon::now()
            ]
        ];
        
        Product::insert($productRecords);
    }
}
