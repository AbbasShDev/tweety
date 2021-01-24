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


Route::get('/home', 'TweetsController@index')->name('home');
Route::post('/home', 'TweetsController@store');
Route::delete('/home/{tweet}', 'TweetsController@destroy');


Route::get('/explore', 'ExploreController')->name('explore');

Route::get('/notifications', 'NotificationsController@show')->name('notifications');

Route::post('/mention', 'MentionController@index')->name('mention');

Route::get('/{user:username}', 'ProfileController@show')->name('profile');
Route::post('/{user:username}/follow', 'FollowController@store')->name('profile.follow');
Route::get('/{user:username}/edit', 'ProfileController@edit')->middleware('can:edit,user')->name('profile.edit');
Route::patch('/{user:username}', 'ProfileController@update')->middleware('can:edit,user');

Route::post('/tweets/{tweet}/like', 'TweetLikeController@store');
Route::delete('/tweets/{tweet}/like', 'TweetLikeController@destroy');

});

