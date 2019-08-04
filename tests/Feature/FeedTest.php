<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_page_loads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
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
