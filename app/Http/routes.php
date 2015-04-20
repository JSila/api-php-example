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

Route::group(['prefix' => 'api/v1'], function() {

    Route::get('/lessons/{id}/tags', 'TagsController@index');
    Route::get('/tags/{id}/lessons', 'LessonsController@index');

    Route::resource('lessons', 'LessonsController', ['only' => ['index', 'show', 'store']]);
    Route::resource('tags', 'TagsController', ['only' => ['index', 'show']]);
});
