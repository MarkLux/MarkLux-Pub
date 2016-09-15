<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/blog');
});

Route::get('/blog','BlogController@index');

Route::get('/blog/{id}','BlogController@show');

// 认证路由...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');
// 注册路由...
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

Route::get('/profile',['middleware' => 'auth',function(){
    return Auth::user();
}]);

Route::group(['middleware' => 'admin'],function(){
    Route::get('/admin',function(){
        return view('admin.panel');
    });
    Route::get('/admin/add-new',function(){
        return view('admin.add_new');
    });
});