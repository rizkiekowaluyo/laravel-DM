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
    return view('admin\dashboard');
});

//Disaster
// Route::get('/disasters', 'DisastersController@index');
// Route::post('/disasters', 'DisastersController@store');
// Route::put('/disasters/edit/{disaster}', 'DisastersController@update');
Route::resource('/disasters', 'DisastersController');
Route::get('/disasters/{id}/destroy', 'DisastersController@destroy');
Route::get('/disasters/exportexcel', 'DisastersController@exportexcel')->name('disasters.export');
Route::post('/disasters/importexcel', 'DisastersController@importexcel')->name('disasters.import');
Route::get('/disasterkmeans', 'DisastersKmeansController@kmeans');
//Route::post('/disasterkmeans', 'DisasterKmeansController@kmeans');

//Geographic
Route::resource('/geographics', 'GeographicsController');
Route::get('/geographics/{id}/destroy', 'GeographicsController@destroy');
Route::post('/geographics/importexcel', 'GeographicsController@importexcel')->name('geographics.import');
Route::get('/geographickmeans', 'GeographicsKmeansController@kmeans');




