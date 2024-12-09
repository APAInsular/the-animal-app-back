<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Animal;
use App\Models\Task;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TaskController
 */
final class TaskControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $tasks = Task::factory()->count(3)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertOk();
        $response->assertViewIs('task.index');
        $response->assertViewHas('tasks');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertOk();
        $response->assertViewIs('task.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TaskController::class,
            'store',
            \App\Http\Requests\TaskStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Title = $this->faker->word();
        $Description = $this->faker->text();
        $idTask = $this->faker->word();
        $zone = Zone::factory()->create();
        $animal = Animal::factory()->create();
        $user = User::factory()->create();

        $response = $this->post(route('tasks.store'), [
            'Title' => $Title,
            'Description' => $Description,
            'idTask' => $idTask,
            'zone_id' => $zone->id,
            'animal_id' => $animal->id,
            'user_id' => $user->id,
        ]);

        $tasks = Task::query()
            ->where('Title', $Title)
            ->where('Description', $Description)
            ->where('idTask', $idTask)
            ->where('zone_id', $zone->id)
            ->where('animal_id', $animal->id)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $tasks);
        $task = $tasks->first();

        $response->assertRedirect(route('task.index'));
    }
}
