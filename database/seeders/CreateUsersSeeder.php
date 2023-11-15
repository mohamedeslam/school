<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[[
            'name'      => '7amody',
            'email'     => '7amody@7amody.com',
            'password'  => bcrypt('123456'),
            'role'      => 0
        ],[
            'name'      => '7amody11',
            'email'     => '7amody11@7amody.com',
            'password'  => bcrypt('123456'),
            'role'      => 1
        ]];
        foreach($users as $user){
            User::create($user);
        }
    }
}
