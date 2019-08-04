<?php

namespace App;

use App\Post;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['user_id', 'post_id', 'status'];

    /**
     * Adds upvote record
     * 
     * @param Post post
     * @return create new vote with upvote status 
     */
    static function upvote(Post $post) {
        return Vote::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'status' => 1
        ]);
    }

    /**
     * Adds downvote record
     * 
     * @param Post post
     * @return create new vote with downvote status 
     */
    static function downvote(Post $post) {
        return Vote::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'status' => 0
        ]);
    }

    /**
     * Deletes all upvotes/downvotes for a user on the current post
     * this method is mainly to prevent errors
     * 
     * @param Post post
     * @return delete all votes with user id/post id 
     */
    static function cleanPostVote(Post $post) {
        return Vote::where('user_id', auth()->id())->where('post_id', $post->id)->delete();
    }
}
