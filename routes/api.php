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

Route::get('/types', 'TypesController@getAll');
Route::post('/types/create', 'TypesController@create');
Route::put('/types/update', 'TypesController@update');
Route::delete('/types/delete/{id}', 'TypesController@delete');
Route::get('/types/find/{id}', 'TypesController@findById');

Route::get('/revenues', 'RevenuesController@getAll');
Route::post('/revenues/create', 'RevenuesController@create');
Route::put('/revenues/update', 'RevenuesController@update');
Route::delete('/revenues/delete/{id}', 'RevenuesController@delete');
Route::get('/revenues/find/{id}', 'RevenuesController@findById');