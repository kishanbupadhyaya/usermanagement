<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class CreateAdminSeeder extends Seeder
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
               'first_name'=>'Admin',
               'last_name'=>'User 1',
               'email'=>'admin1_devnl@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'first_name'=>'Admin',
               'last_name'=>'User 2',
               'email'=>'admin1_devn2@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'first_name'=>'Admin',
               'last_name'=>'User 3',
               'email'=>'admin1_devn3@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'first_name'=>'Admin',
               'last_name'=>'User 4',
               'email'=>'admin1_devn4@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'first_name'=>'Admin',
               'last_name'=>'User 5',
               'email'=>'admin1_devn5@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
            [
               'first_name'=>'Admin',
               'last_name'=>'User 6',
               'email'=>'admin1_devn6@yopmail.com',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            Admin::create($value);
        }
    }
}
