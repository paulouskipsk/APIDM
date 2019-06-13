<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
// ROTAS PARA CATEGORIA :: ROTA DEVE INICIAR COM "/api"
Route::get('/categories',           array('middleware' => 'cors', 'uses' => 'CategoriesController@getAll'));
Route::get('/categories/find/{id}', array('middleware' => 'cors', 'uses' => 'CategoriesController@findById'));
Route::post('/categories/create',   array('middleware' => 'cors', 'uses' => 'CategoriesController@create'));
Route::put('/categories/update',    array('middleware' => 'cors', 'uses' => 'CategoriesController@update'));
Route::delete('/categories/delete', array('middleware' => 'cors', 'uses' => 'CategoriesController@delete'));

Route::get('/types',                array('middleware' => 'cors', 'uses' => 'TypesController@getAll'));
Route::get('/types/find/{id}',      array('middleware' => 'cors', 'uses' => 'TypesController@findById'));
Route::post('/types/create',        array('middleware' => 'cors', 'uses' => 'TypesController@create'));
Route::put('/types/update',         array('middleware' => 'cors', 'uses' => 'TypesController@update'));
Route::delete('/types/delete',      array('middleware' => 'cors', 'uses' => 'TypesController@delete'));  

Route::get('/revenues',                array('middleware' => 'cors', 'uses' => 'RevenuesController@getAll'));
Route::get('/revenues/find/{id}',      array('middleware' => 'cors', 'uses' => 'RevenuesController@findById'));
Route::post('/revenues/create',        array('middleware' => 'cors', 'uses' => 'RevenuesController@create'));
Route::put('/revenues/update',         array('middleware' => 'cors', 'uses' => 'RevenuesController@update'));
Route::delete('/revenues/delete',      array('middleware' => 'cors', 'uses' => 'RevenuesController@delete'));  
