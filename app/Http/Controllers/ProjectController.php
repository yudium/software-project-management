<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\PotentialProject;
use App\Client;
use DataTables;
use App\ProjectType;
use App\PIC;
use App\Termin;
use App\TerminDetail;
use App\Bank;
use Carbon;

class ProjectController extends Controller
{
    private $trello_auth;

    public function __construct()
    {
        $this->trello_auth = [
            'key' => \Setting::value('trello_api_key'),
            'token' => \Setting::value('trello_token'),
        ];
    }

    /**
     * Get active running project page
     */
    public function getOnProgress()
    {
        return view('project.list-onprogress');
    }

    /**
     * Data for DataTable plugin, in onprogress project page
     */
    public function getOnProgressAjax(Request $request)
    {
        $projects = Project::with(['client', 'project_type'])
                           ->where('status', '=', Project::IS_ONPROGRESS)->get();

        /**
         | I do 2 thing:
         |      (1) Calculate progress percent for each project,
         |          but also take the number of task complete and total number of task
         |
         |      (2) Take the last progress activity relative time (completed task) in hours
         | --------------------------------------------------------------- */
        $progress_percent = 0;
        $number_of_task = 0;
        $number_of_task_complete = 0;

        $last_complete_task = null;
        foreach ($projects as $project) {

            // we inform to ajax client that current project doesn't have
            // trello
            if (! $project->trello_board_id) {
                $project->progress = null;
                continue;
            }

            // (1)
            // calculate progress percent
            $progress_percent = getTrelloProgressByBoardId(
                $project->trello_board_id,
                $this->trello_auth,
                $number_of_task,            // pass by reference
                $number_of_task_complete    // pass by reference
            );

            // (2)
            // get last progress activity
            $last_complete_task = getTrelloLastProgress(
                $project->trello_board_id,
                $this->trello_auth
            );
            // in hours
            $last_progress_relative_time = Carbon::now()->diffInHours(Carbon::parse($last_complete_task['date']));

            // now save to the current model as array
            $project->progress = compact(
                'progress_percent',
                'number_of_task',
                'number_of_task_complete',
                'last_progress_relative_time'
            );
        }

        return DataTables::of($projects)->make(true);
    }

    /**
     * Get draft project
     */
    public function getDraft()
    {
        return view('project.list-draft');
    }

    /**
     * Data for DataTable plugin, in draft project page
     */
    public function getDraftAjax(Request $request)
    {
        $projects = Project::with(['client', 'project_type'])
                           ->where('status', '=', Project::IS_DRAFT)->get();

        return DataTables::of($projects)->make(true);
    }

    /**
     * Get success project
     */
    public function getSuccess()
    {
        return view('project.list-success');
    }

    /**
     * Data for DataTable plugin, in success project page
     */
    public function getSuccessAjax(Request $request)
    {
        $projects = Project::with(['client', 'project_type'])
                           ->where('status', '=', Project::IS_DONE_SUCCESS)->get();

        /**
         | Calculate progress percent for each project,
         | but also take the number of task complete and total number of task
         | --------------------------------------------------------------- */
        $progress_percent = 0;
        $number_of_task = 0;
        $number_of_task_complete = 0;
        foreach ($projects as $project) {

            // we inform to ajax client that current project doesn't have
            // trello
            if (! $project->trello_board_id) {
                $project->progress = null;
                continue;
            }

            // calculate progress percent
            $progress_percent = getTrelloProgressByBoardId(
                $project->trello_board_id,
                $this->trello_auth,
                $number_of_task,            // pass by reference
                $number_of_task_complete    // pass by reference
            );

            // now save to the current model as array
            $project->progress = compact(
                'progress_percent',
                'number_of_task',
                'number_of_task_complete'
            );
        }

        return DataTables::of($projects)->make(true);
    }

    /**
     * Get fail project
     */
    public function getFail()
    {
        return view('project.list-fail');
    }

    /**
     * Data for DataTable plugin, in fail project page
     */
    public function getFailAjax(Request $request)
    {
        $projects = Project::with(['client', 'project_type'])
                           ->where('status', '=', Project::IS_DONE_FAIL)->get();

        return DataTables::of($projects)->make(true);
    }

    /**
     * Select client or prospect
     * 
     * This step doesn't have store function since only send query parameter to
     * step2 directly in UI
     */
    public function createStep1()
    {
        return view('project.create-select_client');
    }

    /**
     * Data for DataTable JS plugin, in step 1
     */
    public function createStep1AjaxClient()
    {
        // get clients data
        $clients = Client::with('type')->where('status', '=', Client::IS_CLIENT)->get();

        return DataTables::of($clients)->make(true);
    }

    /**
     * Data for DataTable JS plugin, in step 1
     */
    public function createStep1AjaxProspect()
    {
        // get prospects data
        $prospects = Client::with('type')->where('status', '=', Client::IS_PROSPECT)->get();

        return DataTables::of($prospects)->make(true);
    }

    /**
     * User selects project type
     * 
     * This step doesn't have store function since only send query parameter to
     * step3 directly in UI
     */
    public function createStep2(Request $request)
    {
        // get client id that sent using url's query parameter
        $client_id = $request->query('client_id');

        // ensure user already selects client in step 1
        if (! $client_id)
        {
            // TODO: implementasi alert di setiap laman
            $request->session()->flash('message', 'Anda harus memilih client/prospect terlebih dahulu');
            $request->session()->flash('messageType', 'warning');

            // user should selects client
            return redirect()->route('create-project-step1');
        }

        // get all project type
        $project_types = ProjectType::all();

        return view('project.create-select_type', compact('project_types', 'client_id'));
    }

    /**
     * Main form of all create step
     */
    public function createStep3(Request $request)
    {
        $client = Client::find($request->input('client_id'));

        // ensure user already selects client in step 1
        if (! $client)
        {
            // TODO: implementasi alert di setiap laman
            $request->session()->flash('message', 'Anda harus memilih client/prospect terlebih dahulu');
            $request->session()->flash('messageType', 'warning');

            // user should selects client
            return redirect()->route('create-project-step1');
        }

        // get project type
        // in case of validation fails, I take value from $request->old
        // remember, I put validation rule before calling method `storeStep3`
        $project_type_id = $request->input('project_type_id') ?? $request->old('project_type_id');
        $project_type = ProjectType::find($project_type_id);

        // get all PIC name uniquely, for autocomplete in the form
        // below sql is alternative for distinct sql
        $PICs = PIC::orderBy('name','asc')->groupBy('name')->get();

        return view('project.create-form', compact('client', 'project_type', 'PICs'));
    }

    /**
     * Store data in main form of project to database
     *
     * NOTE: request data already validated and sanitized
     *
     * TODO: implementasi untuk kolom tabel: `bank_id` dan `payment_method`
     */
    public function storeStep3(\App\Http\Requests\StoreProject $request)
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
        $project->quantity = $request->quantity;
        $project->starttime = $request->starttime;
        $project->endtime = $request->endtime;
        $project->DP_time = $request->DP_time;
        $project->additional_note = $request->additional_note;
        $project->status = Project::IS_DRAFT;
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

        /**
         * The logic below is executed only when the new project is from
         * Potential Project data that are converted to real project data
         */
        if ($request->potential_project_id) {
            // we need to keep relation
            $potential_project = PotentialProject::find($request->potential_project_id);
            $potential_project->project()->associate($project);
            $potential_project->save();
        }

        /**
         * Prospect is a person (pseudo-client) that doesn't have projects,
         * except potential projects. So, after prospect has project he become
         * client.
         */
        if ($client->status == Client::IS_PROSPECT) {
            // change prospect status to client
            $client->status = Client::IS_CLIENT;
            $client->save();

            // record 'when' the transformation happens to database
            $prospect_transformation = new ProspectToClientTransformation;
            $prospect_transformation->client()->associate($client);
            $prospect_transformation->created_at = date('Y-m-d');
            $prospect_transformation->save();
        }

        return redirect()->route('project-detail', ['project_id' => $project->id])
            ->with('message', 'Berhasil menambah proyek')
            ->with('messageType', 'success');
    }

    /**
     * The logic is same as method `createStep3` except this purpose project
     * creation is for potential project conversion.
     */
    public function createFromPotentialProject(Request $request)
    {
        $potential_project = PotentialProject::find($request->potential_project_id);

        // get the client
        $client = $potential_project->client;

        // get project type
        $project_type = $potential_project->project_type;

        // get all PIC name uniquely, for autocomplete in the form
        // below sql is alternative for distinct sql
        $PICs = PIC::orderBy('name','asc')->groupBy('name')->get();

        return view('project.create-form', compact('potential_project', 'client', 'project_type', 'PICs'));
    }

    /**
     * Get the detail of project
     *
     * @param $id   project's id
     */
    public function detail($id)
    {
        $project = Project::find($id);

        return view('project.detail', compact('project'));
    }


    /**
     * Mark current project as on progress
     *
     * @param $id   project's id
     */
    public function activate($id)
    {
        $project = Project::find($id);
        $project->status = Project::IS_ONPROGRESS;
        $project->save();

        return redirect()->route('project-detail', ['project_id' => $id])
            ->with('message', 'Proyek telah aktif')
            ->with('messageType', 'success');
    }

    /**
     * Set current project's payment method as full cash
     *
     * @param $id   project's id
     */
    public function setPaymentMethodFullCash(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $project = Project::find($id);
            $project->payment_method = Project::PAYMENT_BY_FULLCASH;
            $project->save();

            return redirect()->route('project-detail')
                ->with('message', 'Pembayaran diatur sebagai Full Cash')
                ->with('messageType', 'success');
        }

        return view('project.set-payment-method-fullcash', compact('id'));
    }

    /**
     * User choice between mark as fail or success for status of completed
     * project
     */
    public function markProjectDone($id)
    {
        return view('project.mark-project-done', compact('id'));
    }

    /**
     * Show dialog confirm to user about mark project as done
     *
     * @param $id        project's id
     * @param $choice    possible value: Project::IS_DONE_FAIL or Project::IS_DONE_SUCCESS
     */
    public function confirmMarkProjectDone($id, $choice)
    {
        $project = Project::find($id);

        return view('project.mark-project-done_confirm', compact('project', 'choice'));
    }

    /**
     * User confirmed 100% sure will mark project as done
     *
     * @param $id        project's id
     * @param $choice    possible value: Project::IS_DONE_FAIL or Project::IS_DONE_SUCCESS
     */
    public function confirmedMarkProjectDone($id, $choice)
    {
        // TODO: add validation to make sure $choice is valid value
        $project = Project::find($id);
        $project->status = $choice;
        $project->save();

        return redirect()->route('project-detail', ['id' => $project->id]);
    }
}
