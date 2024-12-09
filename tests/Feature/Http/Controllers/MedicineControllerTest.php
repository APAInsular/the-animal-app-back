<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Medicine;
use App\Models\Treatment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MedicineController
 */
final class MedicineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $medicines = Medicine::factory()->count(3)->create();

        $response = $this->get(route('medicines.index'));

        $response->assertOk();
        $response->assertViewIs('medicine.index');
        $response->assertViewHas('medicines');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('medicines.create'));

        $response->assertOk();
        $response->assertViewIs('medicine.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicineController::class,
            'store',
            \App\Http\Requests\MedicineStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Name = $this->faker->word();
        $idMedicine = $this->faker->word();
        $Description = $this->faker->text();
        $treatment = Treatment::factory()->create();

        $response = $this->post(route('medicines.store'), [
            'Name' => $Name,
            'idMedicine' => $idMedicine,
            'Description' => $Description,
            'treatment_id' => $treatment->id,
        ]);

        $medicines = Medicine::query()
            ->where('Name', $Name)
            ->where('idMedicine', $idMedicine)
            ->where('Description', $Description)
            ->where('treatment_id', $treatment->id)
            ->get();
        $this->assertCount(1, $medicines);
        $medicine = $medicines->first();

        $response->assertRedirect(route('medicine.index'));
    }
}
