<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;
use App\BlogsComment;
use File;

use Illuminate\Http\Request;
use App\Http\Requests\AddBlogRequest;


class BlogController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(Blog $blog)
    {
        //Getting all the Blogs
        $data = $blog->where('blog_status', 'Approved')->orderBy('created_at', 'DESC')->get();

        //To get each user who create blog
        for($i = 0; $i < sizeof($data); $i++)
        {
            //Setting new Key in each blog object as username of the user created.
            $data[$i]['username'] = $data[$i]->user->username;
        }
        return response()->json($data, 200);
    }


    public function adminIndex(Blog $blog)
    {
        //Getting all the Blogs
        $data = $blog->orderBy('created_at', 'DESC')->get();

        //To get each user who create blog
        for($i = 0; $i < sizeof($data); $i++)
        {
            //Setting new Key in each blog object as username and comment count of the user created it and the comment count.
            $data[$i]['username'] = $data[$i]->user->username;
            $data[$i]['comment_count'] = count($data[$i]->blogs_comments);
        }
        return response()->json($data, 200);
    }



    public function store(AddBlogRequest $request)
    {
        //Taking all values from request except all images to avoid name differentiation.
        $value = array_except($request->all(), ['blog_main_image', 'blog_sub_image_1', 'blog_sub_image_2', 'blog_sub_image_3']);

        //Create a new blog
        $blog = Blog::create($value);

        //Uploading images to server
        $main_image_name = static::imageFileUpload($request->blog_main_image, "images/blogs/main", "blog_main_image", null);
        $blog['blog_main_image'] = $main_image_name;

        $sub_image_name_1 = static::imageFileUpload($request->blog_sub_image_1, "images/blogs/sub/1", "blog_sub_image_1_", null);
        $blog['blog_sub_image_1'] = $sub_image_name_1;

        $sub_image_name_2 = static::imageFileUpload($request->blog_sub_image_2, "images/blogs/sub/2", "blog_sub_image_2_", null);
        $blog['blog_sub_image_2'] = $sub_image_name_2;

        $sub_image_name_3 = static::imageFileUpload($request->blog_sub_image_3, "images/blogs/sub/3", "blog_sub_image_3_", null);
        $blog['blog_sub_image_3'] = $sub_image_name_3;

        //Saving with images name details.
        $blog->save();

        return response()->json($blog, 201);
    }


    public function show(Blog $blog)
    {
        return response()->json($blog, 200);
    }

    public function edit(Blog $blog)
    {
        return response()->json($blog, 200);
    }


    public function update(AddBlogRequest $request, Blog $blog)
    {
        $value = array_except($request->all(), ['blog_main_image', 'blog_sub_image_1', 'blog_sub_image_2', 'blog_sub_image_3']);

        
        //Getting previous image
        $previous_main_image_name = $blog->blog_main_image;
        $previous_sub_image_1_name = $blog->blog_sub_image_1;
        $previous_sub_image_2_name = $blog->blog_sub_image_2;
        $previous_sub_image_3_name = $blog->blog_sub_image_3;
        //Updating a blog
        $blog->update($value);

        //Updating Images Details.
        $new_main_image_name = static::imageFileUpload($request->blog_main_image, 'images/blogs/main', 'blog_main_image', $previous_main_image_name);
        $blog['blog_main_image'] = $new_main_image_name;

        $new_sub_image_1_name = static::imageFileUpload($request->blog_sub_image_1, 'images/blogs/sub/1', 'blog_sub_image_1_', $previous_sub_image_1_name);
        $blog['blog_sub_image_1'] = $new_sub_image_1_name;

        $new_sub_image_2_name = static::imageFileUpload($request->blog_sub_image_2, 'images/blogs/sub/2', 'blog_sub_image_2_', $previous_sub_image_2_name);
        $blog['blog_sub_image_2'] = $new_sub_image_2_name;

        $new_sub_image_3_name = static::imageFileUpload($request->blog_sub_image_3, 'images/blogs/sub/3', 'blog_sub_image_3_', $previous_sub_image_3_name);
        $blog['blog_sub_image_3'] = $new_sub_image_3_name;

        //Saving with images name details.
        $blog->save();

        return response()->json($blog, 201);
    }

    public function userBlogs($id)
    {
        //Getting all the Blogs
        $data = Blog::where('user_id', $id)->orderBy('created_at', 'DESC')->get();

        //To get each user who create blog
        for($i = 0; $i < sizeof($data); $i++)
        {
            //Setting new Key in each blog object as comment count of the comment count.
            $data[$i]['comment_count'] = count($data[$i]->blogs_comments);
        }
        return response()->json($data, 200);
    }

    public function destroy($id)
    {   
        $blog_data = Blog::find($id);
        $blog = Blog::destroy($id);

        return response()->json($blog, 204);   
    }

    public function changeStatus($id)
    {
        $blog = Blog::find($id);
        if($blog->blog_status == 'Approved')
        {
            $blog->blog_status = 'Disapproved';
        } elseif($blog->blog_status == 'Disapproved')
        {
            $blog->blog_status = 'Approved';
        }
        $blog->save();
        return response()->json($blog, 200);
    }
}
