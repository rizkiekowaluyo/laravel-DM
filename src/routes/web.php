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
Route::group(['middleware' => ['auth']], function () {
    //
    Route::get('/dashboard', function () {
        return view('admin\dashboard');
    })->name('dashboard');
    
    //Disaster
    Route::resource('/disasters', 'DisastersController');
    Route::get('/disasters/{id}/destroy', 'DisastersController@destroy');
    Route::get('/exportdisasters', 'DisastersController@export')->name('disasters.export');
    Route::post('/disasters/importexcel', 'DisastersController@importexcel')->name('disasters.import');
    Route::get('/disasterkmeans', 'DisastersKmeansController@kmeans');    
    //Route::post('/disasterkmeans', 'DisasterKmeansController@kmeans');
    
    //Geographic
    Route::resource('/geographics', 'GeographicsController');
    Route::get('/geographics/{id}/destroy', 'GeographicsController@destroy');
    Route::get('/exportgeo', 'GeographicsController@export')->name('geographics.export');
    Route::post('/geographics/importexcel', 'GeographicsController@importexcel')->name('geographics.import');
    Route::get('/geographickmeans', 'GeographicsKmeansController@kmeans');

    //Correlation
    Route::get('/correlations', 'CorrelationController@pearson');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
