<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Medicine;
use App\Models\Treatment;

class MedicineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medicine::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idMedicine' => $this->faker->word(),
            'Name' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'Description' => $this->faker->text(),
            'treatment_id' => Treatment::factory(),
        ];
    }
}
