<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\PotentialProject;
use App\ProjectType;
use App\Client;
use App\FollowUpHistory;
use App\FollowUpDealHistory;

class PotentialProjectController extends Controller
{
    public function followUp($id)
    {
        $potential_project = PotentialProject::find($id);

        return view('project.potential.follow_up', compact('potential_project'));
    }

    public function storeFollowUp(Request $request, $id)
    {
        $potential_project = PotentialProject::find($id);

        $follow_up_history = new FollowUpHistory;
        $follow_up_history->status = $request->follow_up_status;
        $follow_up_history->note = $request->follow_up_note;
        $follow_up_history->potential_project()->associate($potential_project);
        $follow_up_history->save();

        if ($request->follow_up_status == FollowUpHistory::HAS_FOLLOWED_UP) {
            $deal_history = new FollowUpDealHistory;
            $deal_history->status = $request->deal_status;
            $deal_history->note = $request->deal_note;
            $deal_history->follow_up_history()->associate($follow_up_history);
            $deal_history->save();
        }

        return redirect()->route('potential-project-list');
    }

    public function getAjax(Request $request)
    {
        /**
         * Data yg diambil hanya data potential project yang tidak memiliki
         * deal history dengan status = 'Y' atau 'N'
         *
         * Artinya yang belum jelas status dealnya. Makanya masih perlu
         * di-follow up.
         *
         * Gunakan tools online SQL Formatter agar SQL di whereRaw() bawah enak
         * dibaca dan dimengerti.
         */
        $potential_projects = PotentialProject::with(['client', 'project_type', 'project'])
            ->doesntHave('project')
            ->whereRaw('not exists (SELECT 1 FROM follow_up_histories WHERE follow_up_histories.potential_project_id = potential_projects.id AND exists (SELECT 1 FROM follow_up_deal_histories WHERE follow_up_deal_histories.follow_up_history_id = follow_up_histories.id AND (status = "Y" OR status = "N")))')
            ->get();

        // TODO: hapus kode di bawah
        /*
        $potential_projects = \DB::table('potential_projects')
                                ->join('clients', 'clients.id', '=', 'potential_projects.client_id')
                                ->join('client_types', 'client_types.id', '=', 'clients.client_type_id')
                                ->join('project_types', 'project_types.id', '=', 'potential_projects.project_type_id')
                                ->whereRaw('not exists (SELECT 1 FROM follow_up_histories WHERE follow_up_histories.potential_project_id = potential_projects.id AND exists (SELECT 1 FROM follow_up_deal_histories WHERE follow_up_deal_histories.follow_up_history_id = follow_up_histories.id AND status = "Y" OR status = "N"))')
                                ->get();
         */

        return DataTables::of($potential_projects)->make(true);
    }

    public function get()
    {
        return view('project.potential.list');
    }

    public function getArchiveAjax(Request $request)
    {
        /**
         * Data yg diambil hanya data potential project yang *memiliki*
         * deal history dengan status = 'Y' atau 'N'
         *
         * Artinya yang *sudah* jelas status dealnya.
         *
         * Gunakan tools online SQL Formatter agar SQL di whereRaw() bawah enak
         * dibaca dan dimengerti.
         */
        $potential_projects = PotentialProject::with(['client', 'project_type', 'project', 'deal_histories'])
            ->whereRaw('exists (SELECT 1 FROM follow_up_histories WHERE follow_up_histories.potential_project_id = potential_projects.id AND exists (SELECT 1 FROM follow_up_deal_histories WHERE follow_up_deal_histories.follow_up_history_id = follow_up_histories.id AND status = "Y" OR status = "N"))')
            ->get();

        return DataTables::of($potential_projects)->make(true);
    }

    public function getArchive()
    {
        return view('project.potential.list-archive');
    }

    /**
     * Select client or prospect
     */
    public function createStep1()
    {
        return view('project.potential.create-select_client');
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

            return redirect()->route('create-potential-project-step1');
        }

        $project_types = ProjectType::all();

        return view('project.potential.create-select_type', compact('project_types', 'client_id'));
    }

    public function createStep3(Request $request)
    {
        $client = Client::find($request->input('client_id'));
        $project_type = ProjectType::find($request->input('project_type_id', $request->old('project_type_id')));

        return view('project.potential.create-form', compact('client', 'project_type'));
    }

    public function storeStep3(Request $request)
    {
        $client = Client::find($request->client_id);
        $project_type = ProjectType::find($request->project_type_id);

        $potential_project = new PotentialProject;
        $potential_project->client()->associate($client);
        $potential_project->project_type()->associate($project_type);
        $potential_project->project_name = $request->project_name;
        $potential_project->save();

        return redirect()->route('potential-project-list')
            ->with('message', 'Berhasil menambah proyek')
            ->with('messageType', 'success');
    }

    public function getFollowUpHistories($potential_project_id)
    {
        $potential_project = PotentialProject::find($potential_project_id);

        return view('project.potential.history', compact('potential_project'));
    }

    public function deleteConfirmation($id)
    {
        $project = PotentialProject::find($id);

        return view('project.potential.delete_confirmation', compact('id', 'project'));
    }

    public function delete($id)
    {
        $project = PotentialProject::find($id);

        // delete archive-potential-project not allowed
        // archive is indicated by status IS NOT NULL
        if ($project->status != null)
        {
            abort(405, 'Tidak diizinkan untuk proyek potensial non-archive');
        }

        $project->delete();

        return redirect()->route('potential-project-list');
    }
}
