<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



// dashboard routes

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth');


Route::get('dashboard/category/create','App\Http\Controllers\Dashboard\CategoryController@create')->middleware('auth');
Route::post('dashboard/category/store','App\Http\Controllers\Dashboard\CategoryController@store')->middleware('auth');
Route::get('dashboard/category','App\Http\Controllers\Dashboard\CategoryController@index')->middleware('auth');
Route::get('dashboard/category/edit/{id}','App\Http\Controllers\Dashboard\CategoryController@edit')->middleware('auth');
Route::post('dashboard/category/update/{id}','App\Http\Controllers\Dashboard\CategoryController@update')->middleware('auth');
Route::post('dashboard/category/delete/{id}','App\Http\Controllers\Dashboard\CategoryController@destroy')->middleware('auth');
Route::post('dashboard/category/restore/{id}','App\Http\Controllers\Dashboard\CategoryController@restore')->middleware('auth');


Route::get('dashboard/store/create','App\Http\Controllers\Dashboard\StoreController@create')->middleware('auth');
Route::post('dashboard/store/store','App\Http\Controllers\Dashboard\StoreController@store')->middleware('auth');
Route::get('dashboard/store','App\Http\Controllers\Dashboard\StoreController@index')->middleware('auth');
Route::get('dashboard/store/edit/{id}','App\Http\Controllers\Dashboard\StoreController@edit')->middleware('auth');
Route::post('dashboard/store/update/{id}','App\Http\Controllers\Dashboard\StoreController@update')->middleware('auth');
Route::post('dashboard/store/delete/{id}','App\Http\Controllers\Dashboard\StoreController@destroy')->middleware('auth');
Route::post('dashboard/store/restore/{id}','App\Http\Controllers\Dashboard\StoreController@restore')->middleware('auth');
Route::get('dashboard/store/search','App\Http\Controllers\Dashboard\StoreController@search')->middleware('auth');

Route::get('dashboard/rates_review','App\Http\Controllers\Dashboard\RateController@index')->middleware('auth');
Route::get('aa','App\Http\Controllers\Dashboard\RateController@aa');

// public webiste routes

Route::get('/','App\Http\Controllers\Website\WebsiteController@index');
Route::get('category/{id}','App\Http\Controllers\Website\WebsiteController@showCategoryStores');
Route::get('search','App\Http\Controllers\Website\WebsiteController@search');
Route::post('rate/add_Rate/{store_id}','App\Http\Controllers\Dashboard\RateController@add_rate');
