<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
// ROTAS PARA CATEGORIA :: ROTA DEVE INICIAR COM "/api"
Route::get('/categories', 'CategoriesController@getAll');
Route::post('/categories/create', 'CategoriesController@create');
Route::put('/categories/update', 'CategoriesController@update');
Route::delete('/categories/delete/{id}', 'CategoriesController@delete');
Route::get('/categories/find/{id}', 'CategoriesController@findById');

// ROTAS PARA TYPE :: ROTA DEVE INICIAR COM "/api"
Route::get('/type', 'TypesController@getAll');
Route::post('/type/create', 'TypesController@create');
Route::put('/type/update', 'TypesController@update');
Route::delete('/type/delete/{id}', 'TypesController@delete');
Route::get('/type/find/{id}', 'TypesController@findById');

// ROTAS PARA REVENUE :: ROTA DEVE INICIAR COM "/api"
Route::get('/revenue', 'RevenuesController@getAll');
Route::post('/revenue/create', 'RevenuesController@create');
Route::put('/revenue/update', 'RevenuesController@update');
Route::delete('/revenue/delete/{id}', 'RevenuesController@delete');
Route::get('/revenue/find/{id}', 'RevenuesController@findById');