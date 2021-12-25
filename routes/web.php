<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\SessionController;


// home route
Route::get('/', [HomeController::class, 'index']);
// show news item route
Route::get('items/{item:id}', [HomeController::class, 'showItem']);


Auth::routes();
Route::group(['prefix' => 'admin'], function () {
    Route::resource('/', 'Admin\HomeController');
    Route::resource('/feeds', 'Admin\FeedsController');
    Route::resource('/items', 'Admin\ItemsController');
    Route::resource('/categories', 'Admin\CategoriesController');

    Route::get('feeds/{feed_id}/items', 'Admin\FeedsController@show');

    Route::get('categories/{cat_id}/items', 'Admin\CategoriesController@show');
});

