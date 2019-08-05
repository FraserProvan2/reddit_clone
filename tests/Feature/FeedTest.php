<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_feed_loads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function all_feed_loads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function get_can_access_home()
    {

    }

    /** @test */
    public function feed_orders_by_votes()
    {
        //
    }

    public function creating_feed_is_as_expected()
    {
        //
    }

}
