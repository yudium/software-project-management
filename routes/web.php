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

    Route::get('/agent/agent-list','AgentController@index')->name('agentList');
    Route::get('/agent/new/agent-form','AgentController@newAgentForm')->name('newAgentForm');
    Route::post('/agent/new/agent-form','AgentController@createAgentForm')->name('createAgentForm');

    Route::get('/project/list/onprogress', 'ProjectController@getOnProgress')->name('onProgressList');
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

    Route::get('/project/new/step-4', 'ProjectController@createStep4')->name('newProjectStep4');

    Route::get('/home', 'HomeController@index')->name('home');
 
});

Auth::routes();
