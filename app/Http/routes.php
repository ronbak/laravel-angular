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

//ProjectNote Routes
Route::group(['prefix' => 'project/{id}/note'], function(){
    Route::get('/', ['as' => 'project_note_index', 'uses' => 'ProjectNoteController@index']);
    Route::post('/', ['as' => 'project_note_store', 'uses' => 'ProjectNoteController@store']);
    Route::get('/{noteId}', ['as' => 'project_note_show', 'uses' => 'ProjectNoteController@show']);
    Route::delete('/{noteId}', ['as' => 'project_note_destroy', 'uses' => 'ProjectNoteController@destroy']);
    Route::put('/{noteId}', ['as' => 'project_note_update', 'uses' => 'ProjectNoteController@update']);
});

//ProjectTasks Routes
Route::group(['prefix' => 'project/{id}/task'], function(){
    Route::get('/', ['as' => 'project_task_index', 'uses' => 'ProjectTaskController@index']);
    Route::post('/', ['as' => 'project_task_store', 'uses' => 'ProjectTaskController@store']);
    Route::get('/{taskId}', ['as' => 'project_task_show', 'uses' => 'ProjectTaskController@show']);
    Route::delete('/{taskId}', ['as' => 'project_task_destroy', 'uses' => 'ProjectTaskController@destroy']);
    Route::put('/{taskId}', ['as' => 'project_task_update', 'uses' => 'ProjectTaskController@update']);
});

//ProjectMember Routes
Route::group(['prefix' => 'project/{id}/member'], function(){
    Route::get('/', ['as' => 'project_member_index', 'uses' => 'ProjectMemberController@index']);
    Route::post('/', ['as' => 'project_member_store', 'uses' => 'ProjectMemberController@addMember']);
    Route::get('/{memberId}', ['as' => 'project_member_show', 'uses' => 'ProjectMemberController@isMember']);
    Route::delete('/{memberId}', ['as' => 'project_member_destroy', 'uses' => 'ProjectMemberController@removeMember']);
});