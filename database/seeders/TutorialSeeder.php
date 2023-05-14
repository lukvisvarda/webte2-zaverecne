<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $tutorials = [
        [
          'text' => 'Hello World!', //TODO: CREATE default tutorial text here
        ],

      ];

      DB::table('tutorials')->insert($tutorials);
    }
}
