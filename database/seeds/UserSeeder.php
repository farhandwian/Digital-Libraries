<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::insert([
        //     [
        //         'name' => 'admin',
        //         'email' => 'admin@gmail.com',
        //         'password' => Hash::make('admin123'),
        //         'level' => 'admin'
        //     ],
        //     [
        //         'name' => 'user',
        //         'email' => 'user@gmail.com',
        //         'password' => Hash::make('user123'),
        //         'level' => 'user'
        //     ]
        // ]);


                
        // DB::table('users')->insert([[
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin123'),
        //     'level' => 'admin'
        // ],[
        //     'name' => 'user',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('user123'),
        //     'level' => 'user'
        // ]]);

        DB::table('users')->insert([[
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'level' => 'admin'
        ],[
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'level' => 'user'
        ]]);
    }
}