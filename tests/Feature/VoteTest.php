<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_upvote()
    {
        // setup
        $this->seedDb();
        $this->signIn();
        $postOneBeforeUpvote = Post::first();

        // upvoting
        $this->post('/vote', ['post_id' => 1, 'vote_type' => 'upvote']);

        // reflects as votes record
        $this->assertDatabaseHas('votes', [
            'user_id' => 6,
            'post_id' => 1,
            'status' => 1,
        ]);

        // reflects change in votes col in posts
        $this->assertDatabaseHas('posts', [
            'id' => 1,
            'votes' => ($postOneBeforeUpvote->votes + 1),
        ]);
    }

    /** @test */
    public function user_can_undo_upvote()
    {
        // setup
        $this->seedDb();
        $this->signIn();
        $postOneBeforeUpvote = Post::first();

        // upvote, then undo upvote
        $this->post('/vote', ['post_id' => 1, 'vote_type' => 'upvote']);
        $this->post('/vote', ['post_id' => 1, 'vote_type' => 'upvote']);

        // votes Row has been deleted, post 1 vote count has reduced
        $this->assertDatabaseMissing('votes', [
            'user_id' => 6,
            'status' => 1,
        ]);
        $this->assertDatabaseHas('posts', [
            'id' => 1,
            'votes' => $postOneBeforeUpvote->votes,
        ]);
    }

    /** @test */
    public function user_can_downvote()
    {
        // setup
        $this->seedDb();
        $this->signIn();
        $postOneBeforeDownvote = Post::first();

        // upvoting
        $this->post('/vote', ['post_id' => 1, 'vote_type' => 'downvote']);

        // reflects as votes record
        $this->assertDatabaseHas('votes', [
            'user_id' => 6,
            'post_id' => 1,
            'status' => 0,
        ]);

        // reflects change in votes col in posts
        $this->assertDatabaseHas('posts', [
            'id' => 1,
            'votes' => ($postOneBeforeDownvote->votes - 1),
        ]);
    }

    /** @test */
    public function user_can_undo_downvote()
    {
        // setup
        $this->seedDb();
        $this->signIn();
        $postOneBeforeDownvote = Post::first();

        // upvote, then undo upvote
        $this->post('/vote', ['post_id' => 1, 'vote_type' => 'downvote']);
        $this->post('/vote', ['post_id' => 1, 'vote_type' => 'downvote']);

        // votes Row has been deleted, post 1 vote count has reduced
        $this->assertDatabaseMissing('votes', [
            'user_id' => 6,
            'status' => 0,
        ]);
        $this->assertDatabaseHas('posts', [
            'id' => 1,
            'votes' => $postOneBeforeDownvote->votes,
        ]);
    }

    /** @test */
    public function guest_cannot_upvote()
    {
        $this->post('/vote')
            ->assertStatus(500);
    }
}
