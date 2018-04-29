<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_may_not_create_threads()
    {
        // Given we have a guest
        $this->expectException('Illuminate\Auth\AuthenticationException');

        // When they create a thread
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());

        // Then an exception occurs preventing guests from creating threads
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have an auth user
        $this->actingAs(create('App\User'));

        // When the user creates a thread
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());

        // Then their thread is visible on the page
        $this->get('/threads/'.$thread->id)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
