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

Route::get('/', 'TreeController@create')->name('create');

Route::post('/store-tree', 'TreeController@store')->name('store-tree');

Route::post('/store-branch', 'BranchController@store')->name('store-branch');

Route::post('/store-leaf', 'LeafController@store')->name('store-leaf');


Route::get('/search', 'SearchController@index')->name('list-index');

Route::get('/livesearch', 'SearchController@search')->name('livesearch');




