<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportTest extends TestCase
{

    public function test_report_create_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $program = Program::orderBy('created_at', 'desc')->first();

        $response = $this->actingAs($user)->get("/program/{$program->id}/report/create");

        $response->assertStatus(200);
    }

    public function test_report_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->create());

        $program = Program::orderBy('created_at', 'desc')->first();

        $result = $this
            ->actingAs($user)
            ->post('/report', [
                'title'       => 'Test Title',
                'severity'    => 'None',
                'status'      => 'New',
                'description' => 'PLACEHOLDER',
                'program_id'  => $program->id
            ]);

        $this->assertSame('Test Title', Report::orderBy('created_at', 'desc')->first()->title);
        $this->assertSame('None', Report::orderBy('created_at', 'desc')->first()->severity);
        $this->assertSame('New', Report::orderBy('created_at', 'desc')->first()->status);
        $this->assertSame('PLACEHOLDER', Report::orderBy('created_at', 'desc')->first()->description);
        $this->assertSame($program->id, Report::orderBy('created_at', 'desc')->first()->program_id);
    }
}
