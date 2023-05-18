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
          'text' => 'Vitajte na našom matematickom solveri, pre pridanie nového LaTeX súboru chodťe do sekcie učiteľ a pridajte nový LaTeX súbor. Ak ste študent, v sekcii študent si viete vygenerovať príklady, ktoré následne potom aj viete vyriešiť.',
        ],

      ];

      DB::table('tutorials')->insert($tutorials);
    }
}
