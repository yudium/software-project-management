<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Client;
use DataTables;
use App\ProjectType;

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

    public function createStep2(Request $request)
    {
        // TODO: use query() method
        $queryString = $request->getQueryString();

        // client_id AND client_status is a must
        if (! str_contains($queryString, 'client_id') OR
            ! str_contains($queryString, 'client_status'))
        {
            $request->session()->flash('message', 'Anda harus memilih client/prospect terlebih dahulu');
            $request->session()->flash('messageType', 'warning');

            return redirect('project/new/select-client');
        }

        $project_types = ProjectType::all();

        return view('project.create-select_type', compact('project_types', 'queryString'));
    }

    public function createStep3(Request $request)
    {
        $client = Client::find($request->input('client_id'));

        return view('project.create-form', compact('client'));
    }
}
