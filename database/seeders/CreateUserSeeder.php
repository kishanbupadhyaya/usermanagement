<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'User 1',
               'email'=>'user1_devnl@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User 2',
               'email'=>'user2_devnl@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User 3',
               'email'=>'user3_devnl@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User 4',
               'email'=>'user4_devnl@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User 5',
               'email'=>'user5_devnl@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
