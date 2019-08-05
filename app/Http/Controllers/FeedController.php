<?php

namespace App\Http\Controllers;

use FeedBuilder;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     *  returns feed homepage, or guest to r/all
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
            'title' => 'Home',
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
            'title' => 'All',
        ]);
    }

}
