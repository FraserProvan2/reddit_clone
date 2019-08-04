<?php

namespace App;

use App\Vote;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $appends = ['votes'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subReddit()
    {
        return $this->belongsTo('App\SubReddit');
    }

    /**
     * Appends number of votes a post has onto Post object
     *
     * @return int vote count
     */
    public function getVotesAttribute()
    {
        return $this->postsVoteCount();
    }

    /**
     * Gets the total amount of votes a post has
     *
     * @param Post post
     * @return int number of votes
     */
    public function postsVoteCount()
    {
        $upvotes = Vote::where('post_id', $this->id)
            ->where('status', 1)
            ->count();
        $downvotes = Vote::where('post_id', $this->id)
            ->where('status', 0)
            ->count();

        return $upvotes - $downvotes;
    }

    /**
     * Checks if user has votes on a specific post
     *
     * @param int posts id
     * @return view feed (home)
     */
    public function getUsersVote(Post $post)
    {
        $vote_checked = Vote::where('user_id', Auth()->id())
            ->where('post_id', $post->id)
            ->first();

        if ($vote_checked) {
            if ($vote_checked->status) {
                return true;
            } else if (!$vote_checked->status) {
                return false;
            }
        }

        return null;
    }
}
