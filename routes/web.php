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


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/', 'middleware' => 'auth'],function()
{

	Route::get('/',['uses'=>'IndexController@view','as'=>'index']);

	Route::resource('purses','PursesController');

	Route::resource('incomes','IncomeController');

	Route::resource('expenses','ExpensesController');

    Route::resource('debts','DebtsController');

    Route::resource('categories','CategoriesController');

    Route::resource('categories','CategoriesController');

    Route::match(['get','post'],'/user/{user_id}',['uses'=>'UserController@index','as'=>'user']);


    Route::delete('user/{user_id}',['uses'=>'UserController@destroy','as'=>'deleteUser']);

	Route::match(['get','post'],'/addPhoto/{user_id}',['uses'=>'IndexController@addPhoto','as'=>'addPhoto']);

});
