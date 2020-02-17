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

Route::get('/', function () {
    return view('welcome');
});

// --------------------------
// Rutas del controller de entrenamiento.
// --------------------------
Route::get('/training/find-name/{name}', 'TrainingController@getByName');
Route::get('/training/find-id/{id}', 'TrainingController@getById');
Route::get('/training/', 'TrainingController@getAll');
// Fin.
// --------------------------


// --------------------------
// Rutas del controller de entrenamiento.
// --------------------------
Route::get('/modality/find-name/{name}', 'ModalityController@getByName');
Route::get('/modality/find-id/{id}', 'ModalityController@getById');
Route::get('/modality/', 'ModalityController@getAll');
// Fin.
// --------------------------


