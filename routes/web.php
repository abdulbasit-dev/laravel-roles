<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
  return view('welcome');
});

Route::group(["middleware" => "auth"], function () {
  Route::resources([
    "articles" => "ArticleController",
  ]);

  Route::group(['middleware' => 'is_admin'], function () {
    Route::resource('categories', 'CategoryController');
  });
});



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
