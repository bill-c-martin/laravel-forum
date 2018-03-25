<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sign in a user
     *
     * @param \App\User $user
     */
    protected function signIn(User $user)
    {
        $this->be($user);
    }
}
