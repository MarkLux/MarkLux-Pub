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

Route::get('/quote-price',function (){
   return response()->view('quote_price.item_index');
});

Route::get('/quote-price/template',function (){
    return response()->view('quote_price.template_index');
});

Route::get('/',function (){
    return response()->view('index.calendar');
});