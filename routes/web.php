<?php


Route::get('/', function () {
    return view('welcome');
});

// ROTAS PARA CATEGORIA
Route::get('/categories', 'CategoriesController@getAll');
Route::post('/categories/create', 'CategoriesController@create');
Route::put('/categories/update', 'CategoriesController@update');
Route::delete('/categories/delete/{id}', 'CategoriesController@delete');
Route::get('/categories/find/{id}', 'CategoriesController@findById');

// ROTAS PARA 

