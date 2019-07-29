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
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/transfer-data', 'TransferDataController@index');
Route::get('/transfer-data/add', 'TransferDataController@create');
Route::post('/transfer-data/save', 'TransferDataController@store')->name('save');
Route::delete('/transfer-data/delete/{id}', 'TransferDataController@destroy')->name('delete');

Route::get('/print-data', 'TransferDataController@preview');
Route::post('/print-data', 'TransferDataController@print')->name('print');

Route::get('/process', 'ProcessController@index');
Route::get('/process/testing', 'ProcessController@testing');

Route::get('/training', 'DataTrainingController@index');
Route::post('/training/import-csv', 'DataTrainingController@import_csv')->name('importCSV');

