<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\User::create(
//            [
//                'name' => 'Mai Anh Nam',
//                'email' => 'maianhnamdev@gmail.com',
//                'password' => Hash::make('123456789')
//            ],
            [
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('123456789')
            ]
        );
    }
}
