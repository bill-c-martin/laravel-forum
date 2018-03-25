<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_may_particpate_in_forum_threads()
    {
        // Given we have an auth user
        $user = factory('App\User')->create();
        $this->signIn($user);

        // And an existing thread
        $thread = factory('App\Thread')->create();

        // When the user adds a reply to the thread
        $reply = factory('App\Reply')->create();
        $this->post('/threads/'.$thread->id.'/replies', $reply->toArray());

        // Then their reply should be visible on the page
        $this->get('/threads/' . $thread->id)
            ->assertSee($reply->body);
    }
}
