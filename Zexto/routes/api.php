<?php

use Illuminate\Http\Request;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
], function($router)
{
    //All Login and Register
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('email', function(Request $request){
        Mail::to($request->email)->send(new VerifyEmail($request->id, $request->username));
        return response()->json('Mail Sent Successfully, check it.', 200);
    });

    //All User related
    Route::resource('users', 'UserController');
    Route::post('users/{user}/adm', 'UserController@changeAdminStatus');
    Route::post('users/{user}/ven', 'UserController@changeVendorStatus');

    //All Blog related
    Route::resource('blogs', 'BlogController');
    Route::get('admin/blogs', 'BlogController@adminIndex');
    Route::post('blogs/{blog}/status', 'BlogController@changeStatus');
    Route::get('admin/blogs/user/{blog}', 'BlogController@userBlogs');

    //All Blogs Comment related
    Route::resource('comments', 'BlogsCommentController');
    Route::post('comments/{comment}/status', 'BlogsCommentController@changeStatus');
    Route::post('comments/{comment}/status/admin', 'BlogsCommentController@changeAdminStatus');
    Route::get('comments/{comment}/blog/comments', 'BlogsCommentController@blogCommentAdminIndex');
    Route::get('comments/{comment}/user/comments', 'BlogsCommentController@userCommentAdminIndex');
});