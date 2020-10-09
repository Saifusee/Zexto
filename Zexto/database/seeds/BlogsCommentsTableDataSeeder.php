<?php

use Illuminate\Database\Seeder;
use App\BlogsComment;

class BlogsCommentsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogsComment::create([
            'comment_data' => 'NIce blog truly inspiring, hope you like to add more of this.',
            'blog_id' => 2,
            'user_id' => 6,
            'comment_status' => 'Approved',
        ]);
        BlogsComment::create([
            'comment_data' => 'Its show how beautiful fashion is and can go beyond your expectations.',
            'blog_id' => 4,
            'user_id' => 2,
            'comment_status' => 'Disapproved',
        ]);
        BlogsComment::create([
            'comment_data' => 'Lovely words and great thinking make it a master piece.',
            'blog_id' => 2,
            'user_id' => 6,
            'comment_status' => 'Disapproved',
        ]);
        BlogsComment::create([
            'comment_data' => 'I don\'t like the way all this is expressed and still thinks the earlier collect of all this products are better.',
            'blog_id' => 6,
            'user_id' => 5,
            'comment_status' => 'Approved',
        ]);
        BlogsComment::create([
            'comment_data' => 'Well, its a wonderful site even though blog like this makes it amazing.',
            'blog_id' => 1,
            'user_id' => 1,
            'comment_status' => 'Approved',
        ]);
        BlogsComment::create([
            'comment_data' => 'Not good at all, maybe you need to work more on that before posting.',
            'blog_id' => 1,
            'user_id' => 1,
            'comment_status' => 'Disapproved',
        ]);
        BlogsComment::create([
            'comment_data' => 'When we expect too much from new collection, they kinda hit us hard but still good.',
            'blog_id' => 3,
            'user_id' => 5,
            'comment_status' => 'Disapproved',
        ]);
        BlogsComment::create([
            'comment_data' => 'Female collection is way better than man hope they kinda think better for men collections this year.',
            'blog_id' => 5,
            'user_id' => 3,
            'comment_status' => 'Approved',
        ]);
        BlogsComment::create([
            'comment_data' => 'This blog truly show what we missing, thank for that.',
            'blog_id' => 2,
            'user_id' => 2,
            'comment_status' => 'Disapproved',
        ]);
        BlogsComment::create([
            'comment_data' => 'Its a wonderful post, nice one.',
            'blog_id' => 2,
            'user_id' => 4,
            'comment_status' => 'Approved',
        ]);
    }
}
