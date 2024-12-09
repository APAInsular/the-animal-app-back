<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Zone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ZoneController
 */
final class ZoneControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $zones = Zone::factory()->count(3)->create();

        $response = $this->get(route('zones.index'));

        $response->assertOk();
        $response->assertViewIs('zone.index');
        $response->assertViewHas('zones');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('zones.create'));

        $response->assertOk();
        $response->assertViewIs('zone.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZoneController::class,
            'store',
            \App\Http\Requests\ZoneStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Title = $this->faker->word();
        $Description = $this->faker->text();

        $response = $this->post(route('zones.store'), [
            'Title' => $Title,
            'Description' => $Description,
        ]);

        $zones = Zone::query()
            ->where('Title', $Title)
            ->where('Description', $Description)
            ->get();
        $this->assertCount(1, $zones);
        $zone = $zones->first();

        $response->assertRedirect(route('zone.index'));
    }
}
