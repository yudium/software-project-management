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
Route::get('/test',function(){
    return view('template.master');
});

Route::get('/client/client-list/','ClientController@index')->name('clientList');
Route::get('/getProspect','ClientController@getProspect')->name('getProspect');

Route::get('/project/list/onprogress', 'ProjectController@getOnProgress');
Route::get('/project/list/onprogress/ajax', 'ProjectController@getOnProgressAjax');

Route::get('/project/new/step-1', 'ProjectController@createStep1')->name('newProjectStep1');
Route::get('/project/new/step-1/ajax/client', 'ProjectController@createStep1AjaxClient')->name('newProjectStep1AjaxClient');
Route::get('/project/new/step-1/ajax/prospect', 'ProjectController@createStep1AjaxProspect')->name('newProjectStep1AjaxProspect');

Route::get('/project/new/step-2', 'ProjectController@createStep2')->name('newProjectStep2');

Route::get('/project/new/step-3', 'ProjectController@createStep3')->name('newProjectStep3');
Route::post('/project/new/step-3', 'ProjectController@createStep3Post')->name('newProjectStep3Post');

Route::get('/project/new/step-4', 'ProjectController@createStep4')->name('newProjectStep4');
