<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Client;
use DataTables;


class ProjectController extends Controller
{
    public function getOnProgressAjax(Request $request)
    {
        $projects = Project::with(['client', 'project_type'])->get();

        return DataTables::of($projects)->make(true);
    }

    public function getOnProgress()
    {
        return view('project.list-onprogress');
    }

    /**
     * Select client or prospect
     */
    public function createStep1()
    {
        return view('project.create-select_client');
    }

    public function createStep1AjaxClient()
    {
        $clients = Client::with('type')->where('status', '=', Client::IS_CLIENT)->get();

        return DataTables::of($clients)->make(true);
    }

    public function createStep1AjaxProspect()
    {
        $prospects = Client::with('type')->where('status', '=', Client::IS_PROSPECT)->get();

        return DataTables::of($prospects)->make(true);
    }

    public function createStep2()
    {
        return view('project.create-select_type');
    }

    public function createStep3(Request $request)
    {
        $client = Client::find($request->input('client_id'));

        return view('project.create-form', compact('client'));
    }
}
