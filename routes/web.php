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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/message', 'IndexController@message');
Route::get('/index', 'IndexController@index');
Route::post('/addFriend' , 'IndexController@addFriend');
Route::get('/getFriendList' , 'IndexController@friendList');
Route::get('/getSessionList' , 'IndexController@sessionList');
Route::post('/sendAddFriendRequest' , 'IndexController@sendAddFriendRequest');


Route::post('/bind', 'IndexController@bind');
Route::get('/use', 'Test\UseController@test');
Route::post('/store', 'TestController@store');
Route::get('/test', 'Test\UseController@test_two');
