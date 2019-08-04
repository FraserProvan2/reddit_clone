<?php

namespace App\Http\Controllers;

use App\Post;
use App\Vote;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class FeedController extends Controller
{
    /**
     * Loads Homepage (All)
     *
     * @return view feed (home)
     */
    public function index()
    {
        return view('feed.index', [
            'posts' => $this->createFeed(Post::get()->sortByDesc('votes')),
        ]);
    }

    /**
     * Creates pagination new pagination collection
     * we use this because we cant use custom attribute (votes)
     * in the pagniate() method.
     *
     * @param object object of posts
     * @param int items to display per page
     * @return LengthAwarePaginator feed
     */
    public function createFeed($posts, $perPage = 7)
    {
        $collection = collect($posts);
        $page = Input::get('page');

        return new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(), $perPage,
            $page,
            ['path' => url('/')]
        );
    }
}
