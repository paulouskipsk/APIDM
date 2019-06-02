<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
// ROTAS PARA CATEGORIA :: ROTA DEVE INICIAR COM "/api"
Route::get('/categories', 'CategoriesController@getAll');
Route::post('/categories/create', 'CategoriesController@create');
Route::put('/categories/update', 'CategoriesController@update');
Route::delete('/categories/delete/{id}', 'CategoriesController@delete');
Route::get('/categories/find/{id}', 'CategoriesController@findById');