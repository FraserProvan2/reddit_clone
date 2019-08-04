<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class FeedController extends Controller
{
    /**
     * 
     * @return view feed (home) 
     */
    public function index()
    {   
        return view('feed.index', [
            'posts' => Post::paginate(3)
        ]);
    }
}
