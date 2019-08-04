<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_upvote()
    {
        //
    }

    /** @test */
    public function user_can_undo_upvote()
    {
        //
    }

    /** @test */
    public function user_can_downvote()
    {
        //
    }

    /** @test */
    public function user_can_undo_downvote()
    {
        //
    }

    /** @test */
    public function guest_cannot_upvote()
    {
        //
    }
}
