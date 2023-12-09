<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'fanani',
                'email' => 'fanani@gmail.com',
                'password' => Hash::make('fanani'),
                'name' => 'fanani',
                'address' => 'Sidoarjo Juanda',
                'level' => 1
            ]
        ]);
    }
}
