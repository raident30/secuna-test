<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ProgramTest extends TestCase
{

    // use RefreshDatabase;

    public function test_program_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/programs');

        $response->assertStatus(200);
    }

    public function test_program_edit_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $program = Program::first();

        $response = $this->actingAs($user)->get("/programs/edit/". $program->id);

        $response->assertStatus(200);
    }

    public function test_program_create_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/programs/create");

        $response->assertStatus(200);
    }

    public function test_program_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->create());

        $result = $this->post('/programs', [
            'name'             => 'Test Name',
            'pentesting_start' => '2023-03-28 16:03:24',
            'pentesting_end'   => '2023-03-29 16:03:24',
            'user_id'          => $user->id
        ]);

        $result->assertRedirect('/programs');

        $this->assertCount(1, $user->fresh()->programs);
    }

    public function test_program_can_be_updated(): void
    {
        $user = User::factory()->create();

        $program = Program::first();

        $response = $this
            ->actingAs($user)
            ->patch('/programs/'.$program->id,[
                'name'             => 'Test Name',
                'pentesting_start' => '2023-03-28 16:03:24',
                'pentesting_end'   => '2023-03-29 16:03:24',
            ]);

        $response->assertRedirect('/programs/edit/' . $program->id);

        $this->assertSame('Test Name', $program->name);
        $this->assertSame('2023-03-28 16:03:24', $program->pentesting_start);
        $this->assertSame('2023-03-29 16:03:24', $program->pentesting_end);
    }

    public function test_program_can_be_deleted(): void
    {
        $user = User::factory()->create();

        $program = Program::orderBy('created_at', 'desc')->first();
        
        $response = $this
                ->actingAs($user)
                ->delete('/programs/'.$program->id);

        $response->assertRedirect('/programs');

        $this->assertNull($program->fresh());
    }
}
