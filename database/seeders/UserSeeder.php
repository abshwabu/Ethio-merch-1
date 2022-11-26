<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRecords=[
            [
            'id' => 1,
            'name' => 'hamza',
            'email' => 'admin@example.com',
            'role'=> 'admin',
            'status' => 1,
            'profile_picture'=> 'public\assets\imgs\admin_imgs\avatar.jpg',
            'password' => Hash::make('12345678')
         ],
            [
                    'id' => 2,
                    'name' => 'abdulaziz',
                    'email' => 'abdu@example.com',
                    'role'=> 'admin',
                    'status' => 1,
                    'profile_picture'=> 'public\assets\imgs\admin_imgs\avatar.jpg',
                    'password' => Hash::make('12345678')
            ],
            [
                    'id' => 3,
                    'name' => 'abdulaziz',
                    'email' => 'abdu@user.com',
                    'role'=> 'user',
                    'status' => 1,
                    'profile_picture'=> 'public\assets\imgs\admin_imgs\avatar.jpg',
                    'password' => Hash::make('12345678')
            ]
            ];
            User::insert($userRecords);
    }
}
