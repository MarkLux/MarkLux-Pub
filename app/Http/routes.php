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

Route::get('/', 'BlogController@index');

Route::get('/blog','BlogController@showAll');

Route::get('/blog/{id}','BlogController@showSingle');

// 认证路由...
Route::get('/login', function(){
    return view('auth.login');
});
Route::post('/login', 'UserController@login');

Route::get('/logout', 'Auth\AuthController@getLogout');
// 注册路由...
Route::get('/register', function(){
    return view('auth.register');
});
Route::post('/register', 'UserController@register');

Route::get('/profile',['middleware' => 'auth',function(){
    return Auth::user();
}]);

Route::group(['middleware' => 'admin','prefix' => 'admin'],function(){
    Route::get('/',function(){
        return view('admin.panel');
    });
    Route::get('/add-new',function(){
        return view('admin.add_new');
    });
    Route::post('/add-new','BlogController@addNew');
    Route::get('/update/{id}','BlogController@getUpdate');
    Route::post('/update/{id}','BlogController@postUpdate');
    Route::get('/delete/{id}','BlogController@deletePost');
    Route::get('/list','AdminController@showList');
});

