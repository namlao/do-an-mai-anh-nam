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
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('123456789'),
                'avatar' => 'images/users\admin.jpg',
                'email_verified_at' => '2021-12-15 14:41:22'
            ],
            [
                'name' => 'Mai Anh Nam',
                'email' => 'maianhnam@email.com',
                'avatar' => 'images/users\nguyen-ha-viet.jpg',
                'password' => Hash::make('123456789'),
                'email_verified_at' => '2021-12-15 14:41:22'
            ],
            [
                'name' => 'Nguyễn Hà Việt',
                'email' => 'nguyenhaviet@email.com',
                'avatar' => 'images/users\nguyen-ha-viet.jpg',
                'password' => Hash::make('123456789'),
                'email_verified_at' => '2021-12-15 14:41:22'
            ],
        ];
        foreach ($data as $value){
            \App\Models\User::create($value);
        }
    }
}
