<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_user_cannot_add_replies_to_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(route('replies.store', 1), []);
    }

    /** @test */
    public function an_authenticated_user_can_add_replies_to_threads()
    {
        // Given we have an auth user
        $this->signIn();

        // And an existing thread
        $thread = create('App\Thread');

        // When the user adds a reply to the thread
        $reply = make('App\Reply');
        $this->post(
            route('replies.store', $thread->id),
            $reply->toArray()
        );

        // Then their reply should be visible on the page
        $this->get(route('threads.show', $thread->id))
            ->assertSee($reply->body);
    }
}
