<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Acts as a user for rests
     *
     * @return InteractsWithAuthentication user
     */
    public function signIn($user = null)
    {
        // If user, else create
        return $this->actingAs($user ?: factory('App\User')->create())
            ->assertAuthenticated();
    }

    /**
     * Creates mock data when called
     *
     * @return InteractsWithDatabase seeds DB
     */
    public function seedDb()
    {
        return $this->seed('SubRedditSeeder');
    }

    /**
     * Gets data as its passed into a view, specify
     * by the variable ($key)
     *
     * @return InteractsWithDatabase seeds DB
     */
    protected function getViewData($test_response, $key)
    {
        $content = $test_response->getOriginalContent();

        $content = $content->getData();

        return $content[$key]->all();
    }
}
