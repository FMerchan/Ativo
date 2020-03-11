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
// Route::get('/modality/find/', 'ModalityController@findByParameters');
// Fin.
// --------------------------



// --------------------------
// Rutas del controller de duracion.
// --------------------------
Route::get('/duration/exist/', 'DurationController@exist');
Route::get('/duration/save/', 'DurationController@crear');
Route::get('/duration/', 'DurationController@getAll');
// Fin.
// --------------------------


// --------------------------
// Rutas del controller de nivel.
// --------------------------
Route::get('/level/exist/', 'LevelController@exist');
Route::get('/level/save/', 'LevelController@crear');
Route::get('/level/', 'LevelController@getAll');
// Fin.
// --------------------------


// --------------------------
// Rutas del controller de Distancia.
// --------------------------
Route::get('/distance/exist/', 'DistanceController@exist');
Route::get('/distance/save/', 'DistanceController@crear');
Route::get('/distance/', 'DistanceController@getAll');
// Fin.
// --------------------------

// --------------------------
// Rutas del controller de Distancia.
// --------------------------
Route::get('/calendar/year/{year}', 'CalendarEventController@getByYear');
Route::get('/calendar/month/{month}', 'CalendarEventController@getByMonth');
Route::get('/calendar/day/{day}', 'CalendarEventController@getByDay');
Route::get('/calendar/', 'CalendarEventController@getAll');
// Fin.
// --------------------------
