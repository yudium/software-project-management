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



Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/prospect/prospect-list/','ClientController@prospectList')->name('prospectList');
    Route::get('/getProspect','ClientController@getProspect')->name('getProspect');
    Route::get('/prospect/new/prospect-types','ClientController@newProspectType')->name('newProspectTypes');
    Route::get('/prospect/new/prospect','ClientController@getProspectType')->name('getProspectTypegit ');
    Route::get('/prospect/new/prospect-form','ClientController@newProspectForm')->name('newProspectForm');
    Route::post('/prospect/new/prospect-form','ClientController@createProspectForm')->name('createProspectForm');
    Route::get('/prospect/new/prospect-insider','ClientController@newProspectInsider')->name('newProspectInsider');
    Route::post('/prospect/new/prospect-insider','ClientController@createClientInsider')->name('createProspectInsider');

    Route::get('/client/client-list','CLientController@clientList')->name('clientList');
    Route::get('/getClient','ClientController@getClient')->name('getClient');
    Route::get('/client/new/client-types','ClientController@newClientType')->name('newClientTypes');
    Route::get('/client/new/client','ClientController@getClientType')->name('getClientTypegit ');
    Route::get('/client/new/client-form','ClientController@newClientForm')->name('newClientForm');
    Route::post('/client/new/client-form','ClientController@createClientForm')->name('createClientForm');
    Route::get('/client/new/client-insider','ClientController@newClientInsider')->name('newClientInsider');
    Route::post('/client/new/client-insider','ClientController@createClientInsider')->name('createClientInsider');

    Route::get('/agen/agen-list','AgenController@index')->name('agenList');

    Route::get('/project/list/onprogress', 'ProjectController@getOnProgress')->name('onProgressList');
    Route::get('/project/list/onprogress/ajax', 'ProjectController@getOnProgressAjax');

    Route::get('/project/new/step-1', 'ProjectController@createStep1')->name('newProjectStep1');
    Route::get('/project/new/step-1/ajax/client', 'ProjectController@createStep1AjaxClient')->name('newProjectStep1AjaxClient');
    Route::get('/project/new/step-1/ajax/prospect', 'ProjectController@createStep1AjaxProspect')->name('newProjectStep1AjaxProspect');

    Route::get('/project/new/step-2', 'ProjectController@createStep2')->name('newProjectStep2');

    Route::get('/project/new/step-3', 'ProjectController@createStep3')->name('newProjectStep3');
    Route::post('/project/new/step-3', 'ProjectController@createStep3Post')->name('newProjectStep3Post');

    Route::get('/project/new/step-4', 'ProjectController@createStep4')->name('newProjectStep4');

    Route::get('/home', 'HomeController@index')->name('home');
 
});

Auth::routes();
