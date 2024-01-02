<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'title'=>'นาย',
               'firstname'=>'Admin',
               'lastname'=>'User',
               'tel'=>'0000000000',
               'email'=>'admin@tsu.ac.th',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
                'title'=>'นาย',
               'firstname'=>'Manager',
               'lastname'=>'User',
               'tel'=>'0000000000',
               'email'=>'manager@tsu.ac.th',
               'type'=> 2,
               'password'=> bcrypt('123456'),
            ],
            [
               'title'=>'นาย',
               'firstname'=>'User',
               'lastname'=>'User',
               'tel'=>'0000000000',
               'email'=>'user@tsu.ac.th',
               'type'=>0,
               'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
