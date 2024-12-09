<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Care;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CareController
 */
final class CareControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $cares = Care::factory()->count(3)->create();

        $response = $this->get(route('cares.index'));

        $response->assertOk();
        $response->assertViewIs('care.index');
        $response->assertViewHas('cares');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('cares.create'));

        $response->assertOk();
        $response->assertViewIs('care.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CareController::class,
            'store',
            \App\Http\Requests\CareStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Title = $this->faker->word();
        $Description = $this->faker->text();

        $response = $this->post(route('cares.store'), [
            'Title' => $Title,
            'Description' => $Description,
        ]);

        $cares = Care::query()
            ->where('Title', $Title)
            ->where('Description', $Description)
            ->get();
        $this->assertCount(1, $cares);
        $care = $cares->first();

        $response->assertRedirect(route('care.index'));
    }
}
