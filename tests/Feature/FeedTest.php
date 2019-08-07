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
            ->assertSee('/all');
    }

    /** @test */
    public function home_feed_loads()
    {
        $this->signIn();

        $this->get('/')
            ->assertOk()
            ->assertSee('/home');
    }

    /** @test */
    public function guest_cant_access_home()
    {
        $this->get('/')
            ->assertRedirect('/all');
    }

    /** @test */
    public function topic_feed_loads()
    {
        $this->seedDb();

        $this->get('/topic/science')
            ->assertOk()
            ->assertSee('science');
    }

    /** @test */
    public function redirect_when_topic_doesnt_exist()
    {
        $this->get('/topic/helllllo')
            ->assertRedirect('/');
    }

    /** @test */
    public function feed_default_order_by_is_votes()
    {
        $this->seedDb();

        $response = $this->get('/all');
        $posts = $this->getViewData($response, 'posts');

        // 1 - 5 are lower then one another, proving correct ordering
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
