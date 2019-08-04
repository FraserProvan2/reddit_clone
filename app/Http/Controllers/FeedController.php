<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    /**
     * Loads Homepage (All)
     * 
     * @return view feed (home) 
     */
    public function index()
    {        
        // RAW SQL TO order by number of votes
        //     SELECT posts.*, SUM(votes.status) as number_of_votes
        //     FROM posts
        //     LEFT JOIN votes ON posts.id = votes.post_id
        //     GROUP BY posts.id
        
        $posts = Post::limit(50)->paginate(3);

        return view('feed.index', [
            'posts' => $posts
        ]);
    }

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
            if (!$current_vote_status) Vote::upvote($post);
        } else if ($request->vote_type == 'downvote') {
            if ($current_vote_status !== false) Vote::downvote($post);
        }
    }
}
