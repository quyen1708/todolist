<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
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



Route::get('/', 'TodoController@index');

Route::get('/todos/create', 'TodoController@create');

Route::get('/todos/edit/{id}', 'TodoController@edit');

Route::patch('todos/save/{id}', 'TodoController@save');

Route::get('/todos/delete/{id}','TodoController@destroy');

Route::post('todos/create', 'TodoController@Store');

Route::get('/todo-search','TodoController@search');

Route::put('/update', 'TodoController@update');

Route::post('/post-sortable','TodoController@dragdrop');


Route::get('/todos/not_comp', 'TodoController@notcomp');

Route::get('/todos/todo-search1','TodoController@searchnotcomp');

Route::get('/todos/complete', 'TodoController@comp');

Route::get('/todos/todo-search2','TodoController@searchcomp');


