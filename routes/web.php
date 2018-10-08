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

Route::get('/client/prospect-list/','ClientController@prospectList')->name('prospectList');
Route::get('/getProspect','ClientController@getProspect')->name('getProspect');
Route::get('/client/new/prospect-types','ClientController@newProspectType')->name('newProspectTypes');
Route::get('/client/new/prospect','ClientController@getProspectType')->name('getProspectTypegit ');
Route::get('/client/new/prospect-form','ClientController@newProspectForm')->name('newProspectForm');
Route::post('/client/new/prospect-form','ClientController@createProspectForm')->name('createProspectForm');
Route::get('/client/new/prospect-insider','ClientController@newProspectInsider')->name('newProspectInsider');
Route::post('/client/new/prospect-insider','ClientController@createProspectInsider')->name('createProspectInsider');

Route::get('/client/client-list','CLientController@clientList')->name('clientList');
Route::get('/getClient','ClientController@getClient')->name('getClient');

Route::get('/project/list/onprogress', 'ProjectController@getOnProgress');
Route::get('/project/list/onprogress/ajax', 'ProjectController@getOnProgressAjax');

Route::get('/project/new/step-1', 'ProjectController@createStep1')->name('newProjectStep1');
Route::get('/project/new/step-1/ajax/client', 'ProjectController@createStep1AjaxClient')->name('newProjectStep1AjaxClient');
Route::get('/project/new/step-1/ajax/prospect', 'ProjectController@createStep1AjaxProspect')->name('newProjectStep1AjaxProspect');

Route::get('/project/new/step-2', 'ProjectController@createStep2')->name('newProjectStep2');

Route::get('/project/new/step-3', 'ProjectController@createStep3')->name('newProjectStep3');
Route::post('/project/new/step-3', 'ProjectController@createStep3Post')->name('newProjectStep3Post');

