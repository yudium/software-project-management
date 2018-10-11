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
Route::post('/project/new/step-4', 'ProjectController@createStep4Post')->name('newProjectStep4Post');

Route::get('/project/detail/{id}', 'ProjectController@detail')->name('projectDetail');

Route::get('/project/follow-up/new/step-1', 'PotentialProjectController@createStep1')->name('newPotentialProjectStep1');
Route::get('/project/follow-up/new/step-1/ajax/client', 'PotentialProjectController@createStep1AjaxClient')->name('newPotentialProjectStep1AjaxClient');
Route::get('/project/follow-up/new/step-1/ajax/prospect', 'PotentialProjectController@createStep1AjaxProspect')->name('newPotentialProjectStep1AjaxProspect');
Route::get('/project/follow-up/new/step-2', 'PotentialProjectController@createStep2')->name('newPotentialProjectStep2');

Route::get('/project/follow-up/new/step-3', 'PotentialProjectController@createStep3')->name('newPotentialProjectStep3');
Route::post('/project/follow-up/new/step-3', 'PotentialProjectController@createStep3Post')->name('newPotentialProjectStep3Post');

Route::get('/project/follow-up/list', 'PotentialProjectController@get')->name('listPotentialProject');
Route::get('/project/follow-up/list/ajax', 'PotentialProjectController@getAjax')->name('listPotentialProjectAjax');

Route::get('/project/follow-up/list/archive', 'PotentialProjectController@getArchive')->name('ArchiveListPotentialProject');
Route::get('/project/follow-up/list/archive/ajax', 'PotentialProjectController@getArchiveAjax')->name('ArchiveListPotentialProjectAjax');

Route::get('/project/follow-up/follow-up/{id}', 'PotentialProjectController@followUp')->name('FollowUpPotentialProject');
Route::post('/project/follow-up/follow-up/{id}', 'PotentialProjectController@followUpPost')->name('FollowUpPotentialProjectPost');

Route::get('/project/follow-up/{potential_project_id}/history', 'PotentialProjectController@getFollowUpHistories')->name('listFollowUpPotentialProjectHistory');
