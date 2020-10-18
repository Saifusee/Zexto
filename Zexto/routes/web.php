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
    return view('welcome')->with('frontend_url', env('FRONTEND_URL'));
});

Route::get('/test', function () {
    return view('test');
});
Route::group([
    'prefix' => 'transaction',
], function($router)
{
    Route::post('checkout/payment/{id}/payu/response', 'PaymentController@payuPaymentResponse');
});