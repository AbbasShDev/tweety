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


Route::get('/profile/{user}', 'ProfileController@show')->name('profile');
Route::post('/profile/{user}/follow', 'FollowController@store');

});