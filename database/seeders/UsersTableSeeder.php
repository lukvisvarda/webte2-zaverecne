<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'teacher@example.com',
            'password' => Hash::make('pass123'),
            'aisId' => '1',
            'role' => 'teacher'
        ]);

        DB::table('users')->insert([
            'name' => 'Jane Doe',
            'email' => 'student@example.com',
            'password' => Hash::make('pass123'),
            'aisId' => '2',
            'role' => 'student'
        ]);
    }
}
