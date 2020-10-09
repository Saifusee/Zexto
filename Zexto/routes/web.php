<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-email', function () {
    return view('emails.mail')->with(['name' => 'Heya There this is web.php', 'link' => 'Heya There this is web.php']);
});

// Route::get('/check', function () {
//     $string1 = 'this is my site and you would love it';
//     $string2 = 'and i m now verifying the email, and its good to check it';
//     $id = 1; //User id we recieve
//     $decode_string = $string1.$id.$string2.$id.$id.$string1.$string2;  //Creating a random string.
//     $token = base64_encode($decode_string);  //Generating token with the string we created.
//     $link = env('FRONTEND_URL').'verify-email/'.$token.'/verify';
// });
