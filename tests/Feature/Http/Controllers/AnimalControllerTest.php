<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Animal;
use App\Models\Race;
use App\Models\Zone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AnimalController
 */
final class AnimalControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $animals = Animal::factory()->count(3)->create();

        $response = $this->get(route('animals.index'));

        $response->assertOk();
        $response->assertViewIs('animal.index');
        $response->assertViewHas('animals');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('animals.create'));

        $response->assertOk();
        $response->assertViewIs('animal.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AnimalController::class,
            'store',
            \App\Http\Requests\AnimalStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Description = $this->faker->word();
        $Superpower = $this->faker->word();
        $idAnimal = $this->faker->word();
        $race = Race::factory()->create();
        $zone = Zone::factory()->create();

        $response = $this->post(route('animals.store'), [
            'Description' => $Description,
            'Superpower' => $Superpower,
            'idAnimal' => $idAnimal,
            'race_id' => $race->id,
            'zone_id' => $zone->id,
        ]);

        $animals = Animal::query()
            ->where('Description', $Description)
            ->where('Superpower', $Superpower)
            ->where('idAnimal', $idAnimal)
            ->where('race_id', $race->id)
            ->where('zone_id', $zone->id)
            ->get();
        $this->assertCount(1, $animals);
        $animal = $animals->first();

        $response->assertRedirect(route('animal.index'));
    }
}
