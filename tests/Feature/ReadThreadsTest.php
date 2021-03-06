<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        // When all threads are viewed, then we can see the thread titles
        $this->get(route('threads.index'))
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        // When a thread is viewed, then we can see the thread content
        $this->get( route( 'threads.show', [$this->thread->channel->slug, $this->thread->id] ) )
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // When a user replies to a thread
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        // Then we can see the reply
        $this->get( route( 'threads.show', [$this->thread->channel->slug, $this->thread->id] ) )
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get( route('threads.channel.show',$channel->slug) )
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
}
