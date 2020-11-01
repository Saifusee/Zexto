<?php

use Illuminate\Http\Request;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use App\User;
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

    //All User related
    Route::resource('users', 'UserController');
    Route::post('users/{user}/adm', 'UserController@changeAdminStatus');
    Route::post('users/{user}/ven', 'UserController@changeVendorStatus');
    Route::post('check-email', 'UserController@verifyEmailToken');
        //This is for direct email verification.
    Route::post('resend-email', function(Request $request){
        $user = User::find($request->id);
        $user->email = $request->email;
        $user->save();
        Mail::to($request->email)->send(new VerifyEmail($user->id, $user->username));
        return response()->json('email sent successfully', 200);
    });

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

    //All Product related
    Route::resource('products', 'ProductController');
    Route::get('products/user/{product}', 'ProductController@userIndex');
    Route::post('products/{product}/status', 'ProductController@changeStatus');

    //All Taxes related
    Route::resource('taxes', 'TaxController');
    Route::get('taxes/{tax}', 'TaxController@userIndex');

    //Payu Gateway
    Route::post('checkout/payment/payu', 'PaymentController@payuPaymentInitialize'); 
});

