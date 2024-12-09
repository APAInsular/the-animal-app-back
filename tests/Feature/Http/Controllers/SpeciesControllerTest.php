<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Species;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SpeciesController
 */
final class SpeciesControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $species = Species::factory()->count(3)->create();

        $response = $this->get(route('species.index'));

        $response->assertOk();
        $response->assertViewIs('species.index');
        $response->assertViewHas('species');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('species.create'));

        $response->assertOk();
        $response->assertViewIs('species.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpeciesController::class,
            'store',
            \App\Http\Requests\SpeciesStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Name = $this->faker->word();

        $response = $this->post(route('species.store'), [
            'Name' => $Name,
        ]);

        $species = Species::query()
            ->where('Name', $Name)
            ->get();
        $this->assertCount(1, $species);
        $species = $species->first();

        $response->assertRedirect(route('species.index'));
    }
}
