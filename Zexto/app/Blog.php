<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'blog_title', 'blog_data_1', 'blog_data_2', 'blog_quote', 'blog_quote_author', 'blog_main_image', 'blog_sub_image_1', 'blog_sub_image_2', 'blog_sub_image_3', 'category_tag', 'products_tag', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function blogs_comments()
    {
        return $this->hasMany('App\BlogsComment');
    }
}
