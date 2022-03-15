<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ProjectTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->be(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

        $attribubte = [
            'title' => $this->faker()->sentence,
            'body' => $this->faker()->paragraph,
        ];

        $this->followingRedirects()
            ->post('/projects', $attribubte)
            ->assertSee($attribubte['title'])
            ->assertSee($attribubte['body']);
    }
}

