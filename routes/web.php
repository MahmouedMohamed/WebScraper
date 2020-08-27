<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
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

Route::get('/', 'AdminController@index');

Auth::routes();

Route::get('/scrap/{id}','WebsitesController@scrap');
Route::get('/websites','WebsitesController@index')->name('websites.index');
Route::delete('/websites/{website}','WebsitesController@destroy');

Route::get('/articles','ArticlesController@index')->name('articles.index');
Route::post('/articles','ArticlesController@store');
Route::get('/articles/{article}','ArticlesController@show')->name('articles.show');
Route::delete('/articles/{article}','ArticlesController@destroy');

Route::get('/contact', function () {
    return view('contact');
});