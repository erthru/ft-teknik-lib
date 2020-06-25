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

Route::get("/", function(){
    return "It Works!!";
});

Route::prefix("admin")->group(function (){
    Route::get("", "AdminController@index");
    Route::get("login", "AdminController@login");
    Route::get("logout", "AdminController@logoutAction");
    Route::post("login", "AdminController@loginAction");

    Route::prefix("book")->group(function (){
        Route::get("", "ItemController@index");
        Route::get("add", "ItemController@add");
        Route::post("add", "ItemController@addAction");
    });
});
