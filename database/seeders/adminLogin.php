<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\MOdels\user;

class adminLogin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            'name'      => 'admin',
            'email'     => 'admin@amin.com',
            'password'  => bcrypt('123456'),
            'role'      => 0
        ];
        User::create($users);

    }
}