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
    public static function upvote(Post $post)
    {
        Post::increaseVote($post);
        return Vote::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'status' => 1,
        ]);
    }

    /**
     * Adds downvote record
     *
     * @param Post post
     * @return create new vote with downvote status
     */
    public static function downvote(Post $post)
    {
        Post::decreaseVote($post);
        return Vote::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'status' => 0,
        ]);
    }

    /**
     * Deletes all upvotes/downvotes for a user on the current post
     * this method is mainly to prevent errors, if post exists it 
     * increases/decrease votes on post table 
     *
     * @param Post post
     * @return delete all votes with user id/post id
     */
    public static function cleanPostVote(Post $post)
    {
        $vote = Vote::where('user_id', auth()->id())
            ->where('post_id', $post->id)
            ->first();

        if ($vote) {
            if ($vote->status == 0) {
                Post::increaseVote($post);
            } else if ($vote->status == 1) {
                Post::decreaseVote($post);
            }

            $vote->delete();
        }

        return;
    }
}
