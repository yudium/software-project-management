<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Client;
use DataTables;
use App\ProjectType;
use App\PIC;
use App\Termin;

class ProjectController extends Controller
{
    public function getOnProgressAjax(Request $request)
    {
        $projects = Project::with(['client', 'project_type'])->get();
        dd($projects);
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
        $client_id = $request->query('client_id');

        if (! $client_id)
        {
            $request->session()->flash('message', 'Anda harus memilih client/prospect terlebih dahulu');
            $request->session()->flash('messageType', 'warning');

            return redirect()->route('newProjectStep1');
        }

        $project_types = ProjectType::all();

        return view('project.create-select_type', compact('project_types', 'client_id'));
    }

    public function createStep3(Request $request)
    {
        $client = Client::find($request->input('client_id'));
        $project_type = ProjectType::find($request->input('project_type_id', $request->old('project_type_id')));
        // alternative to distinct sql
        $PICs = PIC::orderBy('name','asc')->groupBy('name')->get();

        return view('project.create-form', compact('client', 'project_type', 'PICs'));
    }

    public function createStep3Post(\App\Http\Requests\StoreProject $request)
    {
        // we need to convert date to mysql format
        $request->merge(['starttime' => date('Y-m-d', strtotime($request->starttime))]);
        $request->merge(['endtime' => date('Y-m-d', strtotime($request->endtime))]);
        $request->merge(['DP_time' => date('Y-m-d', strtotime($request->DP_time))]);

        $client = Client::find($request->client_id);
        $project_type = ProjectType::find($request->project_type_id);

        $project = new Project;
        $project->client()->associate($client);
        $project->project_type()->associate($project_type);
        $project->name = $request->name;
        $project->price = $request->price;
        $project->starttime = $request->starttime;
        $project->endtime = $request->endtime;
        $project->DP_time = $request->DP_time;
        $project->additional_note = $request->additional_note;
        // TODO dan NOTE: karena program KP ini tidak selesai maka statusnya
        // belum saya bisa isi, asalnya ingin: IS_DRAFT, IS_ACTIVE_PROJECT, IS_IN_MAITENANCE
        $project->status = '';
        $project->trello_board_id = $request->trello_board_id;
        $project->save();

        foreach ($request->PIC as $PIC_name) {
            $project->PICs()->create(['name' => $PIC_name]);
        }
        foreach ($request->backup_source_code_project_link as $link) {
            $project->backup_source_code_project_links()->create(['link_text' => $link]);
        }
        foreach ($request->project_link as $link) {
            $project->project_links()->create(['link_text' => $link]);
        }

        return redirect()->route('newProjectStep4', ['project_id' => $project->id])
            ->with('message', 'Berhasil menambah proyek')
            ->with('messageType', 'success');
    }

    public function createStep4(Request $request)
    {
        $project = Project::find($request->project_id);

        return view('project.create-termin_pembayaran', compact('project'));
    }

    public function createStep4Post(Request $request)
    {
        // input <form> doesn't have desired format, I convert to desired format
        // which is:
        //      [
        //          due_date,
        //          amount,
        //      ]
        $termin_detail = [];                            // new format
        $old_termin_detail = $request->termin_detail;   // old format
        // debt_amount just representative number of element
        for ($i = 0; $i < count($old_termin_detail['debt_amount']); $i++) {
            $termin_detail[] = [
                'due_date' => $old_termin_detail['due_date']['year'][$i].'-'.$old_termin_detail['due_date']['month'][$i].'-'.$old_termin_detail['due_date']['day'][$i],
                'amount' => $old_termin_detail['debt_amount'][$i],
            ];
        }

        $termin = new Termin;
        $termin->periodic_type = $request->periodic_type;
        $termin->save();

        $termin->details()->createMany($termin_detail);

        // TODO: buat migrasi termin
        $project = Project::find($request->project_id);
        $project->termin()->associate($termin);
    }

    public function detail($id)
    {
        $project = Project::find($id);

        return view('project.detail', compact('project'));
    }
}

