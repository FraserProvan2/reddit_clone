<?php

use App\Post;
use App\Topic;

class FeedBuilder
{
    /**
     *  builds feed for All
     *
     * @return Paginator feed
     */
    public static function getFeedAll()
    {
        return Post::orderBy('votes', 'desc')->simplePaginate(7);
    }

    /**
     *  builds feed for Home
     *
     * @return Paginator feed
     */
    public static function getFeedHome()
    {
        return Post::orderBy('votes', 'desc')->simplePaginate(7);
    }

    /**
     *  builds feed for Topic
     *
     * @return Paginator feed
     */
    public static function getFeedTopic(Topic $topic)
    {
        return Post::where('topic_id', $topic->id)
            ->orderBy('votes', 'desc')
            ->simplePaginate(7);
    }
}
