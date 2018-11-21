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

/** NOTE: naming route constantly has become difficult.
 *
 *       - option 1
 *          /project/{project_id}/action
 *
 *       - option 2
 *          /project/action/{project_id}
 *
 *  the option 2 is more suitable for using in javascript
 *  (especially render link inside DataTable.js)
 *
 *  the option 1 is my choice for semantic reason.
 */



Route::auth();


//Route::middleware(['auth'])->group(function () {
    Route::get('/')->name('home');

    Route::get('/prospect/prospect-list/','ClientController@prospectList')->name('prospectList');
    Route::get('/getProspect','ClientController@getProspect')->name('getProspect');

    Route::get('/client/client-list','ClientController@clientList')->name('clientList');
    Route::get('/getClient','ClientController@getClient')->name('getClient');
    Route::get('/client/new/client-types','ClientController@newClientType')->name('newClientTypes');
    Route::get('/client/new/client','ClientController@getClientType')->name('getClientTypegit ');
    Route::get('/client/new/client-form','ClientController@newClientForm')->name('newClientForm');
    Route::post('/client/new/client-form','ClientController@createClientForm')->name('createClientForm');
    Route::get('/client/new/client-insider','ClientController@newClientInsider')->name('newClientInsider');
    Route::post('/client/new/client-insider','ClientController@createClientInsider')->name('createClientInsider');
    Route::post('/client/deleteClient/{id}','ClientController@deleteClient')->name('deleteClient');

    Route::get('/agent/agent-list','AgentController@index')->name('agentList');
    Route::get('/getAgent','AgentController@getAgent')->name('getAgent');
    Route::get('/agent/new/agent-form','AgentController@newAgentForm')->name('newAgentForm');
    Route::post('/agent/new/agent-form','AgentController@createAgentForm')->name('createAgentForm');
    Route::get('/agent/agent-activation/{id}','AgentController@activateAgent')->name('activateAgent');
    Route::post('/agent/deleteAgent/{id}','AgentController@deleteAgent')->name('deleteAgent');
    Route::get('/agent/agent-payment/{id}','AgentController@paymentAgent')->name('agentPayment');
    Route::post('/agent/agent-payment/{id}','AgentController@storePaymentAgent')->name('storePaymentAgent');
    Route::get('/agent/agent-payment-history/{id}','AgentController@paymentHistory')->name('agentPaymentHistory');
    Route::get('/agent/agent-listCommission','AgentController@listCommission')->name('listCommission');
    Route::get('/getListCommission','AgentController@getListCommission')->name('getListCommission');

    Route::get('/project/list/onprogress', 'ProjectController@getOnProgress')->name('onprogress-project-list');
    Route::get('/project/list/onprogress/ajax', 'ProjectController@getOnProgressAjax')->name('onprogress-project-list-ajax');

    Route::get('/project/list/draft', 'ProjectController@getDraft')->name('draft-project-list');
    Route::get('/project/list/draft/ajax', 'ProjectController@getDraftAjax')->name('draft-project-list-ajax');

    Route::get('/project/list/success', 'ProjectController@getSuccess')->name('success-project-list');
    Route::get('/project/list/success/ajax', 'ProjectController@getSuccessAjax')->name('success-project-list-ajax');

    Route::get('/project/list/fail', 'ProjectController@getFail')->name('fail-project-list');
    Route::get('/project/list/fail/ajax', 'ProjectController@getFailAjax')->name('fail-project-list-ajax');

    Route::get('/project/create/step-1', 'ProjectController@createStep1')->name('create-project-step1');
    Route::get('/project/create/step-1/ajax/client', 'ProjectController@createStep1AjaxClient')->name('create-project-step1-client-ajax');
    Route::get('/project/create/step-1/ajax/prospect', 'ProjectController@createStep1AjaxProspect')->name('create-project-step1-prospect-ajax');

    Route::get('/project/create/step-2', 'ProjectController@createStep2')->name('create-project-step2');

    Route::get('/project/create/step-3', 'ProjectController@createStep3')->name('create-project-step3');
    Route::post('/project/create/step-3', 'ProjectController@storeStep3')->name('store-project-step3');

    Route::get('/project/edit/{id}', 'ProjectController@edit')->name('edit-project');
    Route::post('/project/update/{id}', 'ProjectController@update')->name('update-project');

    Route::get('/project/edit/restricted/{id}', 'ProjectController@editRestricted')->name('edit-restricted-project');
    Route::post('/project/update/restricted/{id}', 'ProjectController@updateRestricted')->name('update-restricted-project');

    // TODO: I am not happy with these route url; not pretty url
    Route::get('/project/change-client/{id}', 'ProjectController@changeClient')->name('change-project-client');
    Route::get('/project/change-client/confirmation/{id}/{new_client_id}', 'ProjectController@changeClientConfirmation')->name('change-project-client-confirmation');
    Route::post('/project/change-client/confirmation/{id}/{new_client_id}', 'ProjectController@updateClient')->name('update-project-client');

    // TODO: I am not happy with these route url; not pretty url
    Route::get('/project/change-type/{id}', 'ProjectController@changeType')->name('change-project-type');
    Route::get('/project/change-type/confirmation/{id}/{new_type_id}', 'ProjectController@changeTypeConfirmation')->name('change-project-type-confirmation');
    // TODO: thing again about name of route because below route has conflict with other
    //Route::post('/project/change-type/confirmation/{id}/{new_type_id}', 'ProjectController@updateType')->name('update-project-type');
    Route::post('/project/change-type/confirmation/{id}/{new_type_id}', 'ProjectController@updateType')->name('update-type-of-a-project');

    Route::get('/project/detail/{id}', 'ProjectController@detail')->name('project-detail');

    Route::get('/project/{id}/delete/confirmation', 'ProjectController@deleteConfirmation')->name('project-delete-confirmation');
    Route::get('/project/{id}/delete', 'ProjectController@delete')->name('project-delete');

    Route::get('/project/{id}/activation/step-1', 'ProjectController@activationStep1')->name('project-activation-step1');
    Route::get('/project/{id}/activation/step-2', 'ProjectController@activationStep2')->name('project-activation-step2');
    Route::get('/project/{id}/activation/step-3/{choice}', 'ProjectController@activationStep3')->name('project-activation-step3');
    Route::get('/project/{id}/activation/step-4/{choice}', 'ProjectController@activationStep4')->name('project-activation-step4');

    Route::get('/project/{id}/deactivation/confirmation', 'ProjectController@deactivationConfirmation')->name('project-deactivation-confirmation');
    Route::post('/project/{id}/deactivation', 'ProjectController@deactivation')->name('project-deactivation');

    Route::get('/project/potential/create/step-1', 'PotentialProjectController@createStep1')->name('create-potential-project-step1');
    // We don't need this route, instead I use existing route in create-project-step1-(client|prospect)-ajax
    // Route::get('/project/potential/create/step-1/ajax/client', 'PotentialProjectController@createStep1AjaxClient')->name('create-potential-project-step1-client-ajax');
    // Route::get('/project/potential/create/step-1/ajax/prospect', 'PotentialProjectController@createStep1AjaxProspect')->name('create-potential-project-step1-prospect-ajax');

    Route::get('/project/potential/create/step-2', 'PotentialProjectController@createStep2')->name('create-potential-project-step2');

    Route::get('/project/potential/create/step-3', 'PotentialProjectController@createStep3')->name('create-potential-project-step3');
    Route::post('/project/potential/create/step-3', 'PotentialProjectController@storeStep3')->name('store-potential-project-step3');

    Route::get('/project/potential/list', 'PotentialProjectController@get')->name('potential-project-list');
    Route::get('/project/potential/list/ajax', 'PotentialProjectController@getAjax')->name('potential-project-list-ajax');

    Route::get('/project/potential/list/archive', 'PotentialProjectController@getArchive')->name('potential-project-list-archive');
    Route::get('/project/potential/list/archive/ajax', 'PotentialProjectController@getArchiveAjax')->name('potential-project-list-archive-ajax');

    Route::get('/project/potential/follow-up/{id}', 'PotentialProjectController@followUp')->name('follow-up-potential-project');
    Route::post('/project/potential/follow-up/{id}', 'PotentialProjectController@storeFollowUp')->name('store-follow-up-potential-project');

    Route::get('/project/potential/history/{potential_project_id}', 'PotentialProjectController@getFollowUpHistories')->name('follow-up-potential-project-history-list');

    // used by DataTable so I put {id} in right
    Route::get('/project/potential/delete/confirmation/{id}', 'PotentialProjectController@deleteConfirmation')->name('potential-project-delete-confirmation');
    Route::get('/project/potential/delete/{id}', 'PotentialProjectController@delete')->name('potential-project-delete');

    Route::get('/project/create/potential/{potential_project_id}', 'ProjectController@createFromPotentialProject')->name('create-project-from-potential-project');

    Route::get('/termin/create/{project_id}', 'TerminController@create')->name('create-termin');
    Route::post('/termin/create/{project_id}', 'TerminController@store')->name('store-termin');

    Route::get('/termin/list/{project_id}', 'TerminController@get')->name('termin-list');

    Route::get('/termin/payment/form/{termin_detail_id}', 'TerminController@paymentForm')->name('termin-payment-form');
    Route::post('/termin/payment/form/{termin_detail_id}', 'TerminController@storePayment')->name('store-termin-payment');

    Route::get('/termin/payment/history/{termin_detail_id}', 'TerminController@paymentHistory')->name('termin-payment-history');

    Route::get('/invoice/form/{project_id}', 'InvoiceController@form')->name('invoice-form');
    Route::post('/invoice/print/{project_id}', 'InvoiceController@generate')->name('invoice-generate');

    Route::get('/progress/{project_id}', 'ProgressController@get')->name('project-progress');

    Route::get('/dashboard', 'DashboardController@main')->name('dashboard');

    Route::get('/setting/list', 'SettingController@get')->name('setting-list');
    Route::get('/setting/list/ajax', 'SettingController@getAjax')->name('setting-list-ajax');

    Route::get('/setting/create', 'SettingController@create')->name('create-setting');
    Route::post('/setting/store', 'SettingController@store')->name('store-setting');

    Route::get('/setting/edit/{name}', 'SettingController@edit')->name('edit-setting');
    Route::post('/setting/update/{name}', 'SettingController@update')->name('update-setting');

    Route::get('/setting/delete/{name}', 'SettingController@delete')->name('delete-setting');

    Route::get('/bank/list', 'BankController@get')->name('bank-list');
    Route::get('/bank/list/ajax', 'BankController@getAjax')->name('bank-list-ajax');

    Route::get('/bank/create', 'BankController@create')->name('create-bank');
    Route::post('/bank/store', 'BankController@store')->name('store-bank');

    Route::get('/bank/delete/{id}', 'BankController@delete')->name('delete-bank');

    Route::get('/client-type/list', 'ClientTypeController@get')->name('client-type-list');
    Route::get('/client-type/list/ajax', 'ClientTypeController@getAjax')->name('client-type-list-ajax');

    Route::get('/client-type/create', 'ClientTypeController@create')->name('create-client-type');
    Route::post('/client-type/store', 'ClientTypeController@store')->name('store-client-type');

    Route::get('/client-type/edit/{id}', 'ClientTypeController@edit')->name('edit-client-type');
    Route::post('/client-type/update/{id}', 'ClientTypeController@update')->name('update-client-type');

    Route::get('/client-type/delete/{id}', 'ClientTypeController@delete')->name('delete-client-type');

    Route::get('/project-type/list', 'ProjectTypeController@get')->name('project-type-list');
    Route::get('/project-type/list/ajax', 'ProjectTypeController@getAjax')->name('project-type-list-ajax');

    Route::get('/project-type/create', 'ProjectTypeController@create')->name('create-project-type');
    Route::post('/project-type/store', 'ProjectTypeController@store')->name('store-project-type');

    Route::get('/project-type/edit/{id}', 'ProjectTypeController@edit')->name('edit-project-type');
    Route::post('/project-type/update/{id}', 'ProjectTypeController@update')->name('update-project-type');

    Route::get('/project-type/delete/{id}', 'ProjectTypeController@delete')->name('delete-project-type');

    Route::get('/icon-list', function(){
        return view('icon-list');
    })->name('icon-list');

    Route::get('/agent/agent-activation/{id}','AgentController@activateAgent')->name('activateAgent');
    Route::post('/agent/deleteAgent/{id}','AgentController@deleteAgent')->name('deleteAgent');
    Route::get('/agent/agent-payment','AgentController@paymentAgent');
    Route::get('/agent/agent-listCommission','AgentController@listCommission')->name('listCommission');
    Route::get('/getListCommission','AgentController@getListCommission')->name('getListCommission');

    // NOTE: route di bawah konflik dengan Maulvi

//    Route::get('/project/list/onprogress', 'ProjectController@getOnProgress')->name('onprogress-project-list');
//    Route::get('/project/list/onprogress/ajax', 'ProjectController@getOnProgressAjax')->name('onprogress-project-list-ajax');
//    Route::get('/project/list/draft', 'ProjectController@getDraft')->name('draft-project-list');
//    Route::get('/project/list/draft/ajax', 'ProjectController@getDraftAjax')->name('draft-project-list-ajax');

//    Route::get('/project/list/success', 'ProjectController@getSuccess')->name('success-project-list');
//    Route::get('/project/list/success/ajax', 'ProjectController@getSuccessAjax')->name('success-project-list-ajax');

//    Route::get('/project/list/fail', 'ProjectController@getFail')->name('fail-project-list');
//    Route::get('/project/list/fail/ajax', 'ProjectController@getFailAjax')->name('fail-project-list-ajax');

//    Route::get('/project/create/step-1', 'ProjectController@createStep1')->name('create-project-step1');
//    Route::get('/project/create/step-1/ajax/client', 'ProjectController@createStep1AjaxClient')->name('create-project-step1-client-ajax');
//    Route::get('/project/create/step-1/ajax/prospect', 'ProjectController@createStep1AjaxProspect')->name('create-project-step1-prospect-ajax');
//
//    Route::get('/project/create/step-1', 'ProjectController@createStep1')->name('create-project-step1');
//    Route::get('/project/create/step-1/ajax/client', 'ProjectController@createStep1AjaxClient')->name('create-project-step1-client-ajax');
//    Route::get('/project/create/step-1/ajax/prospect', 'ProjectController@createStep1AjaxProspect')->name('create-project-step1-prospect-ajax');
//
//    Route::get('/project/create/step-2', 'ProjectController@createStep2')->name('create-project-step2');
//
//    Route::get('/project/create/step-3', 'ProjectController@createStep3')->name('create-project-step3');
//    Route::post('/project/create/step-3', 'ProjectController@storeStep3')->name('store-project-step3');
//
//    Route::get('/project/detail/{id}', 'ProjectController@detail')->name('project-detail');
//    Route::get('/project/{id}/set-payment-method-as-fullcash', 'ProjectController@setPaymentMethodFullCash')->name('set-payment-method-fullcash');
//
//    Route::get('/project/payment-method/fullcash/{id}', 'ProjectController@setPaymentMethodFullCash')->name('set-payment-method-fullcash');
//    Route::get('/project/{id}/mark-as-done', 'ProjectController@markProjectDone')->name('mark-project-done');
//    Route::get('/project/{id}/mark-as-done/{choice}/confirm', 'ProjectController@confirmMarkProjectDone')->name('confirm-mark-project-done');
//    Route::get('/project/{id}/mark-as-done/{choice}/confirmed', 'ProjectController@confirmedMarkProjectDone')->name('confirmed-mark-project-done');
//
//    Route::get('/project/activate/{id}', 'ProjectController@activate')->name('activate-project');
//
//    Route::get('/project/activate/{id}', 'ProjectController@activate')->name('activate-project');
//
//    Route::get('/project/potential/create/step-1', 'PotentialProjectController@createStep1')->name('create-potential-project-step1');
//    // We don't need this route, instead I use existing route in create-project-step1-(client|prospect)-ajax
//    // Route::get('/project/potential/create/step-1/ajax/client', 'PotentialProjectController@createStep1AjaxClient')->name('create-potential-project-step1-client-ajax');
//    // Route::get('/project/potential/create/step-1/ajax/prospect', 'PotentialProjectController@createStep1AjaxProspect')->name('create-potential-project-step1-prospect-ajax');
//
//    Route::get('/project/potential/create/step-2', 'PotentialProjectController@createStep2')->name('create-potential-project-step2');
//
//    Route::get('/project/potential/create/step-3', 'PotentialProjectController@createStep3')->name('create-potential-project-step3');
//    Route::post('/project/potential/create/step-3', 'PotentialProjectController@storeStep3')->name('store-potential-project-step3');
//
//    Route::get('/project/potential/list', 'PotentialProjectController@get')->name('potential-project-list');
//    Route::get('/project/potential/list/ajax', 'PotentialProjectController@getAjax')->name('potential-project-list-ajax');
//
//    Route::get('/project/potential/list/archive', 'PotentialProjectController@getArchive')->name('potential-project-list-archive');
//    Route::get('/project/potential/list/archive/ajax', 'PotentialProjectController@getArchiveAjax')->name('potential-project-list-archive-ajax');
//
//    Route::get('/project/potential/follow-up/{id}', 'PotentialProjectController@followUp')->name('follow-up-potential-project');
//    Route::post('/project/potential/follow-up/{id}', 'PotentialProjectController@storeFollowUp')->name('store-follow-up-potential-project');
//
//    Route::get('/project/potential/history/{potential_project_id}', 'PotentialProjectController@getFollowUpHistories')->name('follow-up-potential-project-history-list');
//
//    Route::get('/project/create/potential/{potential_project_id}', 'ProjectController@createFromPotentialProject')->name('create-project-from-potential-project');
//
//    Route::get('/termin/create/{project_id}', 'TerminController@create')->name('create-termin');
//    Route::post('/termin/create/{project_id}', 'TerminController@store')->name('store-termin');
//
//    Route::get('/termin/list/{project_id}', 'TerminController@get')->name('termin-list');
//
//    Route::get('/termin/payment/form/{termin_detail_id}', 'TerminController@paymentForm')->name('termin-payment-form');
//    Route::post('/termin/payment/form/{termin_detail_id}', 'TerminController@storePayment')->name('store-termin-payment');
//
//    Route::get('/termin/payment/history/{termin_detail_id}', 'TerminController@paymentHistory')->name('termin-payment-history');
//
//    Route::get('/invoice/form/{project_id}', 'InvoiceController@form')->name('invoice-form');
//    Route::post('/invoice/print/{project_id}', 'InvoiceController@generate')->name('invoice-generate');
//    Route::get('/progress/{project_id}', 'ProgressController@get')->name('project-progress');
//
//    Route::get('/progress/test', 'ProgressController@test')->name('progress-test');
//
//    Route::get('/dashboard', 'DashboardController@main')->name('dashboard');
    Route::redirect('/', '/dashboard', 301);

//    Route::get('/setting/list', 'SettingController@get')->name('setting-list');
//    Route::get('/setting/list/ajax', 'SettingController@getAjax')->name('setting-list-ajax');
//
//    Route::get('/setting/create', 'SettingController@create')->name('create-setting');
//    Route::post('/setting/store', 'SettingController@store')->name('store-setting');
//
//    Route::get('/setting/edit/{name}', 'SettingController@edit')->name('edit-setting');
//    Route::post('/setting/update/{name}', 'SettingController@update')->name('update-setting');
//
//    Route::get('/setting/delete/{name}', 'SettingController@delete')->name('delete-setting');

    // Route::get('/array-validation-test', function(){
    //     return view('array-validation-test');
    // });
    // Route::post('/array-validation-test', 'ArrayValidationController@test')->name('array-validation-test');

    //Route::Auth();
//});
