<?php

use Illuminate\Support\Facades\Auth;
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
    if (!Auth::check()) {
        return view('welcome');
    } else {
        return view('home');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web']], function () {
    /** Routes for testing miscellaneous operation */
    Route::get('/test/firebase', 'TestController@firebase');
    Route::get('/test/websocket', 'TestController@websocket');
    /** Miscellaneous operation ends here  */
    Route::namespace('Admin')->group(function () {
        /** Routes for product operation*/
        Route::get('/product/summary', 'ProductController@get');
        Route::get('/product/summary/get/{id}', 'ProductController@getprimary');
        Route::get('/product/summary/delete/{id}', 'ProductController@delete');
        Route::post('/product/summary/create', 'ProductController@create');
        Route::post('/product/summary/update', 'ProductController@update');
        Route::get('/product/summary/deleted', 'ProductController@getrestore');
        Route::get('/product/summary/restore/{id}', 'ProductController@restore');
        /** Product operation ends here */
        /** Routes for user operation*/
        Route::get('/user/summary', 'UserController@get');
        /** User operation ends here */
    });
});
//Route bringing the application back to dashboard
Route::group(['middleware' => ['web'], 'prefix' => 'project'], function () {
    Route::get('/{any}', 'HomeController@index')->where('any', '.*');
});
