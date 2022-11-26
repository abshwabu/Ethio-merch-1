<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Catagory;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords=[
            ['id'=>1,'section_id'=>1,
            'cate_name'=>'T-shirt','cate_image'=>'','cate_discount'=>0,'description'=>'',
            'slug'=>'t-shirt','meta_title'=>'','meta_desc'=>'','meta_keyword'=>'','added_by'=>'1',
            'status'=>1,'created_at'=>Carbon::now()
        ],
        ['id'=>2,'section_id'=>1,
        'cate_name'=>'casual T-shirt','cate_image'=>'','cate_discount'=>0,'description'=>'',
        'slug'=>'casual-t-shirt','meta_title'=>'','meta_desc'=>'','meta_keyword'=>'','added_by'=>'1',
        'status'=>0,'created_at'=>Carbon::now()
        ]
        ];
            Catagory::insert($categoryRecords);
    }
}
