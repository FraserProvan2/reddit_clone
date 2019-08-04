<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subReddit()
    {
        return $this->belongsTo('App\SubReddit');
    }
}
