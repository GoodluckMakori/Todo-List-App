<?php

// Home Page
Route::get('/', 'AuthController@home');

// Login and Logout
Route::get('/login', ['middleware' => 'guest', 'uses' => 'AuthController@getLogin']);
Route::post('/login', ['middleware' => 'guest', 'uses' => 'AuthController@postLogin']);
Route::get('/logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout']);

// Registration and User Profile
Route::resource('user', 'UserController', ['except' => ['index', 'show', 'destroy']]);

// Todo Resources
Route::resource('todo', 'TodoController', ['middleware' => 'auth']);

// Route::get('todo/updateTodo', 'Todocontroller@updateTodo');

/* edit page*/
Route::post('/todo/{id}/edit', 'Todocontroller@kubadilisha')->name('todo');
/* complete page */
Route::get('/todo/{id}/completetask', 'TodoController@imeisha')->name('imeisha');
//Route::get('/todo/{id}/completetask','TodoController@update')->name('todocomplete');