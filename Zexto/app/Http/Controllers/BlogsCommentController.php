<?php

namespace App\Http\Controllers;

use App\BlogsComment;
use App\User;

use Illuminate\Http\Request;

class BlogsCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    //Show all the Comments in Admin Panel
    public function index(BlogsComment $blogsComment)
    {
        $commentsAll = $blogsComment->orderBy('created_at', 'DESC')->get();
        for($i = 0; $i < sizeof($commentsAll); $i++)
        {
            //Setting a new Key of User and Blog object which have all the deatils of comment User and Blog it was commented.
            $commentsAll[$i]['user'] = $commentsAll[$i]->user;//With Eloquent one-to-many relationship.
            $commentsAll[$i]['blog'] = $commentsAll[$i]->blog;//With Eloquent one-to-many relationship.
        }
        return response()->json($commentsAll, 200);
    }

    //Show all the Comments of Particular Blog in Admin Panel
    public function blogCommentAdminIndex($id)
    {
        $commentsAll = BlogsComment::where('blog_id', $id)->orderBy('created_at', 'DESC')->get();
        for($i = 0; $i < sizeof($commentsAll); $i++)
        {
            //Setting a new Key of User and Blog object which have all the deatils of comment User and Blog it was commented.
            $commentsAll[$i]['user'] = $commentsAll[$i]->user;//With Eloquent one-to-many relationship.
            $commentsAll[$i]['blog'] = $commentsAll[$i]->blog;//With Eloquent one-to-many relationship.
        }
        return response()->json($commentsAll, 200);
    }

    //Show all the Comments of Particular User in Admin Panel
    public function userCommentAdminIndex($id)
    {
        $commentsAll = BlogsComment::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        for($i = 0; $i < sizeof($commentsAll); $i++)
        {
            //Setting a new Key of User and Blog object which have all the deatils of comment User and Blog it was commented.
            $commentsAll[$i]['user'] = $commentsAll[$i]->user;//With Eloquent one-to-many relationship.
            $commentsAll[$i]['blog'] = $commentsAll[$i]->blog;//With Eloquent one-to-many relationship.
        }
        return response()->json($commentsAll, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = BlogsComment::create($request->all());
        return response()->json($comment, 201);
    }

    //To show all comments of particular blog.
    public function show($id)
    {
        //Getting all admin approved comments which are related to particular blog.
        $comments = BlogsComment::where([ ['blog_id', '=', $id], ['comment_status', '=', 'Approved'], ['comment_admin_status', '=', 'Admin-Approved'] ])->orderBy('created_at', 'DESC')->get();

        for($i = 0; $i < sizeof($comments); $i++)
        {
            //Setting a new Key of User object which have all the deatils of comment User.
            $comments[$i]['user'] = $comments[$i]->user;//With Eloquent one-to-many relationship.
        }
        return response()->json($comments, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogsComment  $blogsComment
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogsComment $blogsComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogsComment  $blogsComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogsComment $blogsComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogsComment  $blogsComment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_comment = BlogsComment::destroy($id);
        return response()->json($blog_comment, 204); 
    }

    public function changeStatus($id)
    {
        $blog_comment = BlogsComment::find($id);
        if($blog_comment->comment_status == 'Approved')
        {
            $blog_comment->comment_status = 'Disapproved';
        } elseif 
        ($blog_comment->comment_status == 'Disapproved')
        {
            $blog_comment->comment_status = 'Approved';
        }
        $blog_comment->save();
        return response()->json($blog_comment, 200);
    }

    public function changeAdminStatus($id)
    {
        $blog_comment = BlogsComment::find($id);
        if($blog_comment->comment_admin_status == 'Admin-Approved')
        {
            $blog_comment->comment_admin_status = 'Admin-Disapproved';
        } elseif 
        ($blog_comment->comment_admin_status == 'Admin-Disapproved')
        {
            $blog_comment->comment_admin_status = 'Admin-Approved';
        }
        $blog_comment->save();
        return response()->json($blog_comment, 200);
    }
}
