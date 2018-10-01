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

Route::get('/client/prospect-list/','ClientController@index')->name('prospectList');
Route::get('/getProspect','ClientController@getProspect')->name('getProspect');
Route::get('/client/new/prospect-types','ClientController@newProspectType')->name('newProspectTypes');
Route::post('/client/new/prospect-types/{prospect_id}','ClientCOntroller@getProspectType')->name('getProspectTypegit ');
Route::get('/client/new/prospect-form','ClientController@newProspectForm')->name('newProspectForm');
