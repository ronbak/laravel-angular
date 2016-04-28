<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Client Routes
Route::group(['prefix' => 'client'], function(){
    Route::get('/', ['as' => 'client_index', 'uses' => 'ClientController@index']);
    Route::post('/', ['as' => 'client_store', 'uses' => 'ClientController@store']);
    Route::get('/{id}', ['as' => 'client_show', 'uses' => 'ClientController@show']);
    Route::delete('/{id}', ['as' => 'client_destroy', 'uses' => 'ClientController@destroy']);
    Route::put('/{id}', ['as' => 'client_update', 'uses' => 'ClientController@update']);
});
//Project Routes
Route::group(['prefix' => 'project'], function(){
    Route::get('/', ['as' => 'project_index', 'uses' => 'ProjectController@index']);
    Route::post('/', ['as' => 'project_store', 'uses' => 'ProjectController@store']);
    Route::get('/{id}', ['as' => 'project_show', 'uses' => 'ProjectController@show']);
    Route::delete('/{id}', ['as' => 'project_destroy', 'uses' => 'ProjectController@destroy']);
    Route::put('/{id}', ['as' => 'project_update', 'uses' => 'ProjectController@update']);
});