<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\Medicalhistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MedicalHistoryController
 */
final class MedicalHistoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $medicalHistories = MedicalHistory::factory()->count(3)->create();

        $response = $this->get(route('medical-histories.index'));

        $response->assertOk();
        $response->assertViewIs('medicalhistory.index');
        $response->assertViewHas('medicalhistories');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('medical-histories.create'));

        $response->assertOk();
        $response->assertViewIs('medicalhistory.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicalHistoryController::class,
            'store',
            \App\Http\Requests\MedicalHistoryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('medical-histories.store'));

        $response->assertRedirect(route('medicalhistory.index'));

        $this->assertDatabaseHas(medicalhistories, [ /* ... */ ]);
    }
}
