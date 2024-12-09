<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Animal;
use App\Models\Microchip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MicrochipController
 */
final class MicrochipControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $microchips = Microchip::factory()->count(3)->create();

        $response = $this->get(route('microchips.index'));

        $response->assertOk();
        $response->assertViewIs('microchip.index');
        $response->assertViewHas('microchips');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('microchips.create'));

        $response->assertOk();
        $response->assertViewIs('microchip.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MicrochipController::class,
            'store',
            \App\Http\Requests\MicrochipStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $idMicrochip = $this->faker->word();
        $NumChip = $this->faker->word();
        $animal = Animal::factory()->create();

        $response = $this->post(route('microchips.store'), [
            'idMicrochip' => $idMicrochip,
            'NumChip' => $NumChip,
            'animal_id' => $animal->id,
        ]);

        $microchips = Microchip::query()
            ->where('idMicrochip', $idMicrochip)
            ->where('NumChip', $NumChip)
            ->where('animal_id', $animal->id)
            ->get();
        $this->assertCount(1, $microchips);
        $microchip = $microchips->first();

        $response->assertRedirect(route('microchip.index'));
    }
}
