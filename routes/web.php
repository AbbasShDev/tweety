<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware('auth')->group(function (){

Route::get('/tweets', 'TweetsController@index')->name('home');
Route::post('/tweets', 'TweetsController@store');
Route::delete('/tweets/{tweet}', 'TweetsController@destroy');

Route::post('/tweets/{tweet}/like', 'TweetLikeController@store');
Route::delete('/tweets/{tweet}/like', 'TweetLikeController@destroy');


Route::get('/profile/{user:username}', 'ProfileController@show')->name('profile');
Route::post('/profile/{user:username}/follow', 'FollowController@store');
Route::get('/profile/{user:username}/edit', 'ProfileController@edit')->middleware('can:edit,user');
Route::patch('/profile/{user:username}', 'ProfileController@update')->middleware('can:edit,user');

Route::get('/explore', 'ExploreController')->name('explore');

Route::get('/notifications', 'NotificationsController@show')->name('notifications');

});
