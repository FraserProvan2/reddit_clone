<?php

/*------------------------------------------------------------------------
| Auth Routes
|-------------------------------------------------------------------------*/

Auth::routes();

/*------------------------------------------------------------------------
| Feed Routes
|-------------------------------------------------------------------------*/

Route::get('/', 'FeedController@home');
Route::get('/home', 'FeedController@home');
Route::get('/all', 'FeedController@all');

// voting
Route::post('/vote', 'VoteController@updateVote');