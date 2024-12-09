<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClinicalHistory;
use App\Models\Treatment;

class TreatmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Treatment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idTreatment' => $this->faker->word(),
            'Name' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'Frequency' => $this->faker->word(),
            'Dose' => $this->faker->word(),
            'Comments' => $this->faker->text(),
            'clinical_history_id' => ClinicalHistory::factory(),
        ];
    }
}
