<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// made by Lucas

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Especie::factory(10)->create();
    }
}
