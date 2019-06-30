<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
// ROTA DEVE INICIAR COM "/api"
Route::get('/categories',                   array('middleware' => 'cors', 'uses' => 'CategoriesController@getAll'));
Route::get('/categories/find/{id}',         array('middleware' => 'cors', 'uses' => 'CategoriesController@findById'));
Route::post('/categories/create',           array('middleware' => 'cors', 'uses' => 'CategoriesController@create'));
Route::put('/categories/update',            array('middleware' => 'cors', 'uses' => 'CategoriesController@update'));
Route::delete('/categories/delete/{id}',    array('middleware' => 'cors', 'uses' => 'CategoriesController@delete'));

Route::get('/types',                        array('middleware' => 'cors', 'uses' => 'TypesController@getAll'));
Route::get('/types/find/{id}',              array('middleware' => 'cors', 'uses' => 'TypesController@findById'));
Route::post('/types/create',                array('middleware' => 'cors', 'uses' => 'TypesController@create'));
Route::put('/types/update',                 array('middleware' => 'cors', 'uses' => 'TypesController@update'));
Route::delete('/types/delete/{id}',         array('middleware' => 'cors', 'uses' => 'TypesController@delete'));  

Route::get('/revenues',                     array('middleware' => 'cors', 'uses' => 'RevenuesController@getAll'));
Route::get('/revenues/find/{id}',           array('middleware' => 'cors', 'uses' => 'RevenuesController@findById'));
Route::post('/revenues/create',             array('middleware' => 'cors', 'uses' => 'RevenuesController@create'));
Route::put('/revenues/update',              array('middleware' => 'cors', 'uses' => 'RevenuesController@update'));
Route::delete('/revenues/delete/{id}',      array('middleware' => 'cors', 'uses' => 'RevenuesController@delete'));  

Route::get('/users',                        array('middleware' => 'cors', 'uses' => 'UsersController@getAll'));
Route::get('/users/find/{id}',              array('middleware' => 'cors', 'uses' => 'UsersController@findById'));
Route::post('/users/create',                array('middleware' => 'cors', 'uses' => 'UsersController@create'));
Route::put('/users/update',                 array('middleware' => 'cors', 'uses' => 'UsersController@update'));
Route::delete('/users/delete/{id}',         array('middleware' => 'cors', 'uses' => 'UsersController@delete'));  

Route::get('/expenses',                     array('middleware' => 'cors', 'uses' => 'ExpensesController@getAll'));
Route::get('/expenses/find/{id}',           array('middleware' => 'cors', 'uses' => 'ExpensesController@findById'));
Route::post('/expenses/create',             array('middleware' => 'cors', 'uses' => 'ExpensesController@create'));
Route::put('/expenses/update',              array('middleware' => 'cors', 'uses' => 'ExpensesController@update'));
Route::delete('/expenses/delete/{id}',      array('middleware' => 'cors', 'uses' => 'ExpensesController@delete'));  

Route::post('/login',                       array('middleware' => 'cors', 'uses' => 'LoginController@authenticate'));



// RELATORIOS
Route::get('/reports/budget/{monthIni}/{monthFin}',  array('middleware' => 'cors', 'uses' => 'ReportsController@budget'));

