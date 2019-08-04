<?php

namespace App\Http\Controllers;

use App\Post;
use App\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Loads Homepage (All)
     *
     * @return view feed (home)
     */
    public function updateVote(Request $request)
    {
        $post = Post::where('id', $request->post_id)->first();
        $current_vote_status = $post->getUsersVote($post);

        // clean vote table before adding new vote record
        Vote::cleanPostVote($post);

        // update votes table accordingly
        if ($request->vote_type == 'upvote') {
            if (!$current_vote_status) {
                Vote::upvote($post);
            }

        } else if ($request->vote_type == 'downvote') {
            if ($current_vote_status !== false) {
                Vote::downvote($post);
            }
        }
    }
}
