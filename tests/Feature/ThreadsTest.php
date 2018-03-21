<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected function createThread()
    {
        return factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $thread = $this->createThread();

        $response = $this->get('/threads');
        $response->assertSee($thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_therad()
    {
        $thread = $this->createThread();

        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
