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
        $this->expectException('Illuminate\Auth\AuthenticationException');

        // Given we have a guest

        // When they create a thread
        $thread = create('App\Thread');
        $this->post(route('threads.store'), $thread->toArray());

        // Then an exception occurs preventing guests from creating threads
    }

    /** @test */
    public function guests_cannot_see_the_create_thread_page()
    {
        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have an authenticated user
        $this->signIn();

        // When the user creates a thread
        $thread = create('App\Thread');
        $response = $this->post(route('threads.store'), $thread->toArray());

        // Then their thread is visible on the page
        $this->get( $response->headers->get('Location') )
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThreadAsUser(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThreadAsUser(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThreadAsUser(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $nonexistent_id = 999;

        $this->publishThreadAsUser(['channel_id' => $nonexistent_id])
            ->assertSessionHasErrors('channel_id');
    }

    /**
     * Signs user in, creates a thread via factory, allows attributes to be overridden, then posts it
     *
     * @param array $overrides array of [title => value] to override the default Thread factory
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function publishThreadAsUser($overrides)
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post( route('threads.store', $thread->toArray() ) );
    }
}
