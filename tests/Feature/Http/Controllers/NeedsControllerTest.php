<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Need;
use App\Models\Needs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NeedsController
 */
final class NeedsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $needs = Needs::factory()->count(3)->create();

        $response = $this->get(route('needs.index'));

        $response->assertOk();
        $response->assertViewIs('needs.index');
        $response->assertViewHas('needs');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('needs.create'));

        $response->assertOk();
        $response->assertViewIs('needs.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NeedsController::class,
            'store',
            \App\Http\Requests\NeedsStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Title = $this->faker->word();
        $Description = $this->faker->text();

        $response = $this->post(route('needs.store'), [
            'Title' => $Title,
            'Description' => $Description,
        ]);

        $needs = Needs::query()
            ->where('Title', $Title)
            ->where('Description', $Description)
            ->get();
        $this->assertCount(1, $needs);
        $need = $needs->first();

        $response->assertRedirect(route('needs.index'));
    }
}
