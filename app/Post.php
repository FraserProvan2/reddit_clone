<?php

namespace App;

use App\Vote;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['votes'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subReddit()
    {
        return $this->belongsTo('App\SubReddit');
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

    public static function increaseVote(Post $post)
    {
        return $post->update(['votes' => ($post->votes + 1)]);
    }

    public static function decreaseVote(Post $post)
    {
        return $post->update(['votes' => ($post->votes - 1)]);
    }
}
