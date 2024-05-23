<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// made by Lucas

class VoluntarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Voluntario::factory(10)->create();
    }
}
