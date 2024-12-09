<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Race;
use App\Models\Species;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RaceController
 */
final class RaceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $races = Race::factory()->count(3)->create();

        $response = $this->get(route('races.index'));

        $response->assertOk();
        $response->assertViewIs('race.index');
        $response->assertViewHas('races');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('races.create'));

        $response->assertOk();
        $response->assertViewIs('race.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RaceController::class,
            'store',
            \App\Http\Requests\RaceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Name = $this->faker->word();
        $idRace = $this->faker->word();
        $species = Species::factory()->create();

        $response = $this->post(route('races.store'), [
            'Name' => $Name,
            'idRace' => $idRace,
            'species_id' => $species->id,
        ]);

        $races = Race::query()
            ->where('Name', $Name)
            ->where('idRace', $idRace)
            ->where('species_id', $species->id)
            ->get();
        $this->assertCount(1, $races);
        $race = $races->first();

        $response->assertRedirect(route('race.index'));
    }
}
