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
    return view('app');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

//OAuth verify
Route::group(['middleware' => 'oauth'], function(){

    //Client
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    //Project
    //Route::group(['middleware' => 'CheckProjectOwner'], function(){
        Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);
    //});
    
    //Project Group
    Route::group(['prefix' => 'project'], function(){

        //ProjectFile
        Route::post('{id}/file', 'ProjectFileController@store');
        Route::delete('{id}/file/{file}', 'ProjectFileController@destroy');
        
        //ProjectNote
        Route::resource('{id}/note', 'ProjectNoteController', ['except' => ['create', 'edit']]);

        //ProjectTasks
        Route::resource('{id}/task', 'ProjectTaskController', ['except' => ['create', 'edit']]);

        //ProjectMember
        Route::resource('{id}/member', 'ProjectMemberController', ['except' => ['create', 'edit', 'update']]);

    });

    //User
    Route::get('user/authenticated', 'UserController@authenticated');

});