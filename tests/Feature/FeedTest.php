<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_feed_loads()
    {
        $this->get('/all')
            ->assertOk()
            ->assertSee('/All');
    }

    /** @test */
    public function home_feed_loads()
    {
        $this->signIn();

        $this->get('/')
            ->assertOk()
            ->assertSee('/Home');
    }

    /** @test */
    public function guest_cant_access_home()
    {
        $this->get('/')
            ->assertRedirect('/all');
    }

    /** @test */
    public function feed_default_order_by_is_votes()
    {
        $this->seedDb();

        $response = $this->get('/all');

        $posts = $this->getViewsData($response, 'posts');

        $this->assertTrue($posts[0]->votes > $posts[1]->votes);
        $this->assertTrue($posts[1]->votes > $posts[2]->votes);
        $this->assertTrue($posts[2]->votes > $posts[3]->votes);
        $this->assertTrue($posts[3]->votes > $posts[4]->votes);
        $this->assertTrue($posts[4]->votes > $posts[5]->votes);
    }

    /** @test */
    public function pagination_works_as_expected()
    {
        $this->seedDb();
        $this->signIn();

        $this->get('/')
            ->assertSeeTextInOrder(['Previous', 'Next']);

        $this->get('/all?page=2')
            ->assertViewHas('posts')
            ->assertSee('post-bg');
    }
}
