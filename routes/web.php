<?php

Route::get('/', 'IndexController@index');

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
Route::delete('/expenses/delete/{id}',             array('middleware' => 'cors', 'uses' => 'ExpensesController@delete'));  

Route::post('/login',                       array('middleware' => 'cors', 'uses' => 'LoginController@authenticate'));

