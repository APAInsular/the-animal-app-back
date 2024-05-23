<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// made by Lucas

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
    }
}
