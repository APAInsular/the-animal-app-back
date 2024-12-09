<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Feed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FeedController
 */
final class FeedControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $feeds = Feed::factory()->count(3)->create();

        $response = $this->get(route('feeds.index'));

        $response->assertOk();
        $response->assertViewIs('feed.index');
        $response->assertViewHas('feeds');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('feeds.create'));

        $response->assertOk();
        $response->assertViewIs('feed.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FeedController::class,
            'store',
            \App\Http\Requests\FeedStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('feeds.store'));

        $response->assertRedirect(route('feed.index'));

        $this->assertDatabaseHas(feeds, [ /* ... */ ]);
    }
}
