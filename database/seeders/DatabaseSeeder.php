<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * You need to add all seeders here, just like the example below.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            TutorialSeeder::class
        ]);
    }
}
