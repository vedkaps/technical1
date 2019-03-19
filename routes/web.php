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

Route::post('/accept', 'AcceptDataController@accept');

Route::post('/mailchimp', 'MailchimpController@home');

Route::prefix('test')->group(function () {
    Route::get('/', 'TestController@home')->name('test.home');
    Route::get('/about', 'TestController@about')->name('test.about');
    Route::get('/contact', 'TestController@contact')->name('test.contact');
});
