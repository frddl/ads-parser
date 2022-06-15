<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $users = [
            [
                'name' => 'Farid',
                'email' => 'faridmmmdv@gmail.com',
                'password' => Hash::make('#farid13'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@parser.ads',
                'password' => Hash::make('AdsP@rs3r'),
            ]
        ];

        collect($users)->each(function ($user) {
            User::create($user);
        });
    }
}
