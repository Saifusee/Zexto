<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogsComment extends Model
{
    protected $fillable = [
        'comment_data', 'user_id', 'blog_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }
}
