<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ClinicalHistory;
use App\Models\Treatment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TreatmentController
 */
final class TreatmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $treatments = Treatment::factory()->count(3)->create();

        $response = $this->get(route('treatments.index'));

        $response->assertOk();
        $response->assertViewIs('treatment.index');
        $response->assertViewHas('treatments');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('treatments.create'));

        $response->assertOk();
        $response->assertViewIs('treatment.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TreatmentController::class,
            'store',
            \App\Http\Requests\TreatmentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Name = $this->faker->word();
        $idTreatment = $this->faker->word();
        $Frequency = $this->faker->word();
        $Dosis = $this->faker->word();
        $Comments = $this->faker->text();
        $clinical_history = ClinicalHistory::factory()->create();

        $response = $this->post(route('treatments.store'), [
            'Name' => $Name,
            'idTreatment' => $idTreatment,
            'Frequency' => $Frequency,
            'Dosis' => $Dosis,
            'Comments' => $Comments,
            'clinical_history_id' => $clinical_history->id,
        ]);

        $treatments = Treatment::query()
            ->where('Name', $Name)
            ->where('idTreatment', $idTreatment)
            ->where('Frequency', $Frequency)
            ->where('Dosis', $Dosis)
            ->where('Comments', $Comments)
            ->where('clinical_history_id', $clinical_history->id)
            ->get();
        $this->assertCount(1, $treatments);
        $treatment = $treatments->first();

        $response->assertRedirect(route('treatment.index'));
    }
}
