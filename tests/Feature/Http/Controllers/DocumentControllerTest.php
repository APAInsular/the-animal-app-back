<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Animal;
use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DocumentController
 */
final class DocumentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $documents = Document::factory()->count(3)->create();

        $response = $this->get(route('documents.index'));

        $response->assertOk();
        $response->assertViewIs('document.index');
        $response->assertViewHas('documents');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('documents.create'));

        $response->assertOk();
        $response->assertViewIs('document.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DocumentController::class,
            'store',
            \App\Http\Requests\DocumentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Document = $this->faker->word();
        $idDocument = $this->faker->word();
        $Title = $this->faker->word();
        $animal = Animal::factory()->create();

        $response = $this->post(route('documents.store'), [
            'Document' => $Document,
            'idDocument' => $idDocument,
            'Title' => $Title,
            'animal_id' => $animal->id,
        ]);

        $documents = Document::query()
            ->where('Document', $Document)
            ->where('idDocument', $idDocument)
            ->where('Title', $Title)
            ->where('animal_id', $animal->id)
            ->get();
        $this->assertCount(1, $documents);
        $document = $documents->first();

        $response->assertRedirect(route('document.index'));
    }
}
