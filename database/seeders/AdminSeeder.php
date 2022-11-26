<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [  [
              'user_id'=>'1',
              'title' => 'CTO / Co-Founder',
              'first_name' => 'hamza',
              'last_name' => 'shehabu',
              'phone_number'=> '+251900612194',
              'is_super' => '1',
              'created_at' => Carbon::now()
          ],
          [
              'user_id'=>'2',
              'title' => 'CEO / Founder',
              'first_name' => 'Abdulaziz',
              'last_name' => 'Shewabu',
              'phone_number'=> '+251 91 952 7873',
              'is_super' => '1',
              'created_at' => Carbon::now()
          ]]
      );
    }
}
