<?php

namespace App\Http\Controllers;

use App\User;
use File;
use App\Mail\VerifyEmail;
use App\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\EditRegisterRequest;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store', 'verifyEmailToken']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
            //For password encryption during registration a mutator has been set in User Model and for login it has been working default by JWT.
            $value = array_except($request->all(), ['profile_picture']);

            //Creating new user with empty profile picture field.
            $user = User::create($value);
            
            //Uploadin image to server.
            $profile_image_name = static::fileUpload($request->profile_picture, $user->profile_picture, "images/users/profile", "images/users/profile/thumb", "profile_picture");
            $user['profile_picture'] = $profile_image_name;

            $user->save();

            //Sending Verification Email
            Mail::to($request->email)->send(new VerifyEmail($user->id, $user->username));

            
            return response()->json($user, 201);
    }


    //Verify the Token recieved from source
    public function verifyEmailToken(Request $request)
    {
        $user = User::find($request->id);
        $user_token = $user->remember_token;
        if($request->token == $user_token)
        {
            $user['email_verified'] = 1;
            $user->save();

            return response()->json(['message' => 'E-mail Verified Successfully'], 200);
        } else
        {
            $user['email_verified'] = 0;
            $user->save();

            return response()->json(['message' => 'E-mail Verification failed'], 200);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return response()->json($user->all(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {  
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user['blogs_count'] = $user->blogs->count();
        $user['comments_count'] = $user->blogsComments->count();
        $product = Product::where('vendor_id', $user->id)->get();
        $user['products_count'] = $product->count();

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditRegisterRequest $request, User $user)
    {
        //Getting all values except file data its binary.
        $value = array_except($request->all(), ['profile_picture']);

        $previous_image_name = $user->profile_picture;
        //Updating all details of user.
        $update_user = $user->update($request->all());

        if($request->profile_picture !== 'undefined' && $request->profile_picture !== null)
        {
            //Renaming images file 
            $profile_picture_name = 'profile_picture'.time().'.'.$request->profile_picture->getClientOriginalExtension();
            //Storing images to server here with the name you create.
            $request->profile_picture->move(public_path('images/users/profile'), $profile_picture_name);
            //Copying file to server into thumb folder to create a small size copy later
            File::copy('images/users/profile/'.$profile_picture_name, 'images/users/profile/thumb/'.$profile_picture_name);

            //Resizing the new images.
            $resize = new \App\SmartResize();
            $resize->smart_resize_image('images/users/profile/thumb/'.$profile_picture_name, $width = 200,$height =0, $proportional = true,  $output = 'file', $delete_original = false, $use_linux_commands = false );
           
            //Deleting the previous image
            File::delete('images/users/profile/'.$previous_image_name);
            File::delete('images/users/profile/thumb/'.$previous_image_name);
            //Updating the images name to database with its location
            $user->profile_picture = $profile_picture_name;
        } else
        {
            $user->profile_picture = $previous_image_name;    
        }
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_data = User::find($id);
        $user = User::destroy($id);
        File::delete($user_data->profile_picture);
        return response()->json($user, 204);
    }




    public function changeAdminStatus($id)
    {
        $user = User::findOrFail($id);
        $status = $user->is_admin;
        if($status === 0)
        {
            $user->is_admin = 1;
            $user->is_vendor = 1;
        } elseif ($status === 1) 
        {
            $user->is_admin = 0;
        }
        $user->save();
        return response()->json($user, 200);
    }

    public function changeVendorStatus($id)
    {
        $user = User::findOrFail($id);
        $status = $user->is_vendor;
        $adminStatus = $user->is_admin;
        if($status === 0)
        {
            $user->is_vendor = 1;
        } elseif($status == 1 && $adminStatus == 1)
        {
            $user->is_vendor = 0;
            $user->is_admin = 0;
        } 
        elseif ($status === 1) 
        {
            $user->is_vendor = 0;
            $user->is_admin = 0;
        }
        $user->save();
        return response()->json($user, 200);
    }
}
