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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function()  {
   echo 'trumpia';
});
//list routes
Route::get('list/all', 'ListController@all');
Route::get('list/item/{id}', 'ListController@item');
Route::post('list/create', 'ListController@create');
Route::post('/list/update/{id}', 'ListController@update');
Route::get('/list/delete/{id}', 'ListController@delete');

//report routes
Route::get('/report/{id}', 'ReportController@index');
