<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            AlimentacionSeeder::class,
            CuidadosSeeder::class,
            EspecieSeeder::class,
            FormacionSeeder::class,
            NecesidadesSeeder::class,
            PermisoSeeder::class,
            UserSeeder::class,
            VoluntarioSeeder::class,
            DireccionUsuarioSeeder::class,
            AnimalSeeder::class,
            PadrinoSeeder::class,
            RolSeeder::class,
            TareasSeeder::class,

        ]);
    }
}
