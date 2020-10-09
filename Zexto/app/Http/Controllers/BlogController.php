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

        //Checking if images exist in the request recieved and then do functionality.
        if($request->blog_main_image !== 'undefined' && $request->blog_main_image !== null)
        {
            //Renaming images file 
            $main_image_name = 'blog_main_image'.time().'.'.$request->blog_main_image->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->blog_main_image->move(public_path('images/blogs/main'), $main_image_name);
            //Copy image to thumb folder to convert it later in low size image
            File::copy('images/blogs/main/'.$main_image_name, 'images/blogs/main/thumb/'.$main_image_name);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/blogs/main/thumb/'.$main_image_name, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            //Updating the images name to database with its location
            $blog->blog_main_image = $main_image_name;
        } else
        {
            $blog->blog_main_image = 'default.jpg';
        }

        if($request->blog_sub_image_1 !== 'undefined' && $request->blog_sub_image_1 !== null)
        {
            //Renaming images file 
            $sub_image_name_1 = 'blog_sub_image_1'.time().'.'.$request->blog_sub_image_1->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->blog_sub_image_1->move(public_path('images/blogs/sub/1'), $sub_image_name_1);
            //Copy image to thumb folder to convert it later in low size image
            File::copy('images/blogs/sub/1/'.$sub_image_name_1, 'images/blogs/sub/1/thumb/'.$sub_image_name_1);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/blogs/sub/1/thumb/'.$sub_image_name_1, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            //Updating the images name to database with its location
            $blog->blog_sub_image_1 =  $sub_image_name_1;
        } else
        {
            $blog->blog_sub_image_1 = '0_default.jpg';
        }

        if($request->blog_sub_image_2 !== 'undefined' && $request->blog_sub_image_2 !== null)
        {
            //Renaming images file 
            $sub_image_name_2 = 'blog_sub_image_2'.time().'.'.$request->blog_sub_image_2->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->blog_sub_image_2->move(public_path('images/blogs/sub/2'), $sub_image_name_2);
            //Copy image to thumb folder to convert it later in low size image
            File::copy('images/blogs/sub/2/'.$sub_image_name_2, 'images/blogs/sub/2/thumb/'.$sub_image_name_2);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/blogs/sub/2/thumb/'.$sub_image_name_2, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            //Updating the images name to database with its location
             $blog->blog_sub_image_2 = $sub_image_name_2;
        } else
        {
            $blog->blog_sub_image_2 = '0_default';
        }

        if($request->blog_sub_image_3 !== 'undefined' && $request->blog_sub_image_3 !== null)
        {
            //Renaming images file 
            $sub_image_name_3 = 'blog_sub_image_3'.time().'.'.$request->blog_sub_image_3->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->blog_sub_image_3->move(public_path('images/blogs/sub/3'), $sub_image_name_3);
            //Copy image to thumb folder to convert it later in low size image
            File::copy('images/blogs/sub/3/'.$sub_image_name_3, 'images/blogs/sub/3/thumb/'.$sub_image_name_3);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/blogs/sub/3/thumb/'.$sub_image_name_3, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            //Updating the images name to database with its location
            $blog->blog_sub_image_3 = $sub_image_name_3;
        } else
        {
            $blog->blog_sub_image_3 = '0_default.jpg';
        }

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

        //Create a new blog
        $blog->update($value);

        //Getting previous image
        $previous_main_image_name = $blog->blog_main_image;
        $previous_sub_image_1_name = $blog->blog_sub_image_1;
        $previous_sub_image_2_name = $blog->blog_sub_image_2;
        $previous_sub_image_3_name = $blog->blog_sub_image_3;

        //Checking if images exist in the request recieved and then do functionality.
        if($request->blog_main_image !== 'undefined' && $request->blog_main_image !== null)
        {
            //Renaming images file 
            $main_image_name = 'blog_main_image'.time().'.'.$request->blog_main_image->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->blog_main_image->move(public_path('images/blogs/main'), $main_image_name);
            //Copy image to thumb folder to convert it later in low size image
            File::copy('images/blogs/main/'.$main_image_name, 'images/blogs/main/thumb/'.$main_image_name);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/blogs/main/thumb/'.$main_image_name, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            //Deleting previous file
            File::delete($previous_main_image_name);
            //Updating the images name to database with its location
            $blog->blog_main_image = $main_image_name;
        } else
        {
            $blog->blog_main_image = $previous_main_image_name;
        }

        if($request->blog_sub_image_1 !== 'undefined' && $request->blog_sub_image_1 !== null)
        {
            //Renaming images file 
            $sub_image_name_1 = 'blog_sub_image_1'.time().'.'.$request->blog_sub_image_1->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->blog_sub_image_1->move(public_path('images/blogs/sub/1'), $sub_image_name_1);
            //Copy image to thumb folder to convert it later in low size image
            File::copy('images/blogs/sub/1/'.$sub_image_name_1, 'images/blogs/sub/1/thumb/'.$sub_image_name_1);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/blogs/sub/1/thumb/'.$sub_image_name_1, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            File::delete($previous_sub_image_1_name);
            //Updating the images name to database with its location
            $blog->blog_sub_image_1 = $sub_image_name_1;
        } else
        {
            $blog->blog_sub_image_1 = $previous_sub_image_1_name;
        }

        if($request->blog_sub_image_2 !== 'undefined' && $request->blog_sub_image_2 !== null)
        {
            //Renaming images file 
            $sub_image_name_2 = 'blog_sub_image_2'.time().'.'.$request->blog_sub_image_2->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->blog_sub_image_2->move(public_path('images/blogs/sub/2'), $sub_image_name_2);
            //Copy image to thumb folder to convert it later in low size image
            File::copy('images/blogs/sub/2/'.$sub_image_name_2, 'images/blogs/sub/2/thumb/'.$sub_image_name_2);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/blogs/sub/2/thumb/'.$sub_image_name_2, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            File::delete($previous_sub_image_2_name);
            //Updating the images name to database with its location
             $blog->blog_sub_image_2 = $sub_image_name_2;
        } else
        {
            $blog->blog_sub_image_2 = $previous_sub_image_2_name;
        }

        if($request->blog_sub_image_3 !== 'undefined' && $request->blog_sub_image_3 !== null)
        {
            //Renaming images file 
            $sub_image_name_3 = 'blog_sub_image_3'.time().'.'.$request->blog_sub_image_3->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->blog_sub_image_3->move(public_path('images/blogs/sub/3'), $sub_image_name_3);
            //Copy image to thumb folder to convert it later in low size image
            File::copy('images/blogs/sub/3/'.$sub_image_name_3, 'images/blogs/sub/3/thumb/'.$sub_image_name_3);
            //Resizing the copied image on server.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/blogs/sub/3/thumb/'.$sub_image_name_3, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
            File::delete($previous_sub_image_3_name);
            //Updating the images name to database with its location
            $blog->blog_sub_image_3 = $sub_image_name_3;
        } else
        {
            $blog->blog_sub_image_3 = $previous_sub_image_3_name;
        }

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
        //Delete images associated with Blogs
        File::delete($blog_data->blog_main_image);
        File::delete($blog_data->blog_sub_image_1);
        File::delete($blog_data->blog_sub_image_2);
        File::delete($blog_data->blog_sub_image_3);
        return response()->json($blog, 204);   
    }

    public function changeStatus($id)
    {
        $blog = Blog::find($id);
        if($blog->blog_status == 'Approved')
        {
            $blog->blog_status = 'Disapproved';
        } elseif 
        ($blog->blog_status == 'Disapproved')
        {
            $blog->blog_status = 'Approved';
        }
        $blog->save();
        return response()->json($blog, 200);
    }
}
