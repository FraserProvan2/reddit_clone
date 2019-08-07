<?php

namespace App\Http\Controllers;

use FeedBuilder;
use Illuminate\Support\Facades\Auth;
use App\Topic;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     *  Returns feed homepage, or guest to r/all
     *
     * @return view feed (home or all)
     */
    public function home()
    {
        if (!Auth::check()) {
            return redirect('/all');
        }

        return view('feed', [
            'posts' => FeedBuilder::getFeedHome(),
            'title' => 'home',
        ]);
    }

    /**
     *  Views user homepage, or guest to r/all
     *
     * @return view feed all
     */
    public function all()
    {
        return view('feed', [
            'posts' => FeedBuilder::getFeedAll(),
            'title' => 'all',
        ]);
    }

    /**
     *  Returns topic feed, all posts related to the topic
     *
     * @return view feed (topic)
     */
    public function topic($topic_name)
    {
        $topic = Topic::where('name', $topic_name)->first();
    
        if(!isset($topic)) {
            return redirect('/');
        }

        return view('feed', [
            'posts' => FeedBuilder::getFeedTopic($topic),
            'title' => $topic->name,
        ]);
    }

}
