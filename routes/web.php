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

Route::get('/project/list/onprogress', 'ProjectController@getOnProgress');
Route::get('/project/list/onprogress/ajax', 'ProjectController@getOnProgressAjax');

Route::get('/project/new/select-client', 'ProjectController@createStep1');
Route::get('/project/new/select-client/ajax/client', 'ProjectController@createStep1AjaxClient');
Route::get('/project/new/select-client/ajax/prospect', 'ProjectController@createStep1AjaxProspect');

Route::get('/project/new/select-project-type', 'ProjectController@createStep2');
Route::get('/project/new/step-3', 'ProjectController@createStep3');
