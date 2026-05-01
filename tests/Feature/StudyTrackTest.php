<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudyTrackTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_user_can_create_a_module(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/modules', [
            'code' => 'CS101',
            'title' => 'Introduction to Programming',
            'description' => 'A beginner programming module',
        ]);

        $response->assertRedirect('/modules');
        $this->assertDatabaseHas('modules', [
            'code' => 'CS101',
            'title' => 'Introduction to Programming',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_create_an_assignment(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/assignments', [
            'title' => 'Final Project',
            'module_id' => $module->id,
            'due_at' => '2026-06-01 12:00:00',
            'description' => 'End of year project',
        ]);

        $response->assertRedirect('/assignments');
        $this->assertDatabaseHas('assignments', [
            'title' => 'Final Project',
            'module_id' => $module->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_record_attendance(): void
    {
        $user = User::factory()->create();
        $module = Module::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/attendances', [
            'module_id' => $module->id,
            'date' => '2026-05-01',
            'status' => 'present',
        ]);

        $response->assertRedirect('/attendances');
        $this->assertDatabaseHas('attendances', [
            'module_id' => $module->id,
            'user_id' => $user->id,
            'status' => 'present',
        ]);
    }

    public function test_user_cannot_see_another_users_modules(): void
    {
        $userOne = User::factory()->create();
        $userTwo = User::factory()->create();

        Module::factory()->create([
            'user_id' => $userOne->id,
            'title' => 'User One Module',
        ]);

        $response = $this->actingAs($userTwo)->get('/modules');

        $response->assertStatus(200);
        $response->assertDontSee('User One Module');
    }
}
