<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

// made by Lucas

class AlimentacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        try {
            \App\Models\Alimentacion::factory(10)->create();
        } catch (\Throwable $e) {
            Log::error('Failed to seed Alimentacion: ' . $e->getMessage());
        }
    }
}
