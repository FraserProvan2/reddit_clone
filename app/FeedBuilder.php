<?php

use App\Post;
use App\Topic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FeedBuilder
{
    /**
     *  builds feed for All
     *
     * @return Paginator feed
     */
    public static function getFeedAll()
    {
        $filter = FeedBuilder::getFilter();

        return Post::orderBy($filter->key, $filter->direction)
            ->simplePaginate(7);
    }

    /**
     *  builds feed for Home
     *
     * @return Paginator feed
     */
    public static function getFeedHome()
    {
        $filter = FeedBuilder::getFilter();

        return Post::orderBy($filter->key, $filter->direction)
            ->simplePaginate(7);
    }

    /**
     *  builds feed for Topic
     * 
     * @param Request w/ Session for filters
     * @param Topic topic for feed
     * @return Paginator feed
     */
    public static function getFeedTopic(Topic $topic)
    {
        $filter = FeedBuilder::getFilter();

        return Post::where('topic_id', $topic->id)
            ->orderBy($filter->key, $filter->direction)
            ->simplePaginate(7);
    }

    /**
     *  Gets filter from the session
     *
     * @return Object current filters
     */
    public static function getFilter()
    {   
        // get session
        // session('key');
        // session('direction');

        // default
        return (object) [
            'key' => 'votes',
            'direction' => 'desc'
        ];
    }

    /**
     *  Sets filters in session
     *
     * @return Void
     */
    public static function setFilter($key, $direction)
    {
        session()->put('key', $key);
        session()->put('direction', $direction);
    }
}
