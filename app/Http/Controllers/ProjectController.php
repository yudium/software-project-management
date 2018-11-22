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
use App\ProjectTag;
use App\Bank;
use App\ProspectToClientTransformation;
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
        | Calculate progress percent for each project,
        | but also take the number of task complete and total number of task
        | --------------------------------------------------------------- */
        foreach ($projects as $project) {

            // we inform to ajax client that current project doesn't have
            // trello
            if (! $project->trello_board_id) {
                $project->progress = null;
                continue;
            }

            try {
                // calculate progress percent
                $progress_percent = getTrelloProgressByBoardId(
                    $project->trello_board_id,
                    $this->trello_auth,
                    $number_of_task,            // pass by reference
                    $number_of_task_complete    // pass by reference
                );

                // get last progress activity
                $last_complete_task = getTrelloLastProgress(
                    $project->trello_board_id,
                    $this->trello_auth
                );
                // in hours
                $last_progress_relative_time = Carbon::now()->diffInHours(Carbon::parse($last_complete_task['date']));

                // now save to the current model as array
                $project->progress = [
                    'status' => 200,
                    'message' => 'OK',
                    'data' => compact(
                        'progress_percent',
                        'number_of_task',
                        'number_of_task_complete',
                        'last_progress_relative_time'
                    ),
                ];
            }
            catch (\GuzzleHttp\Exception\ConnectException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => '502 HTTP Code. Try to check your internet connection',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ClientException $e)
            {
                $project->progress = [
                    'status' => 400,
                    'message' => 'Error 4XX HTTP Code',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\TooManyRedirectsException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Error. Too Many Redirection from Trello',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\RequestException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Networking Error',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ServerException $e)
            {
                $project->progress = [
                    'status' => 500,
                    'message' => 'Error 5XX HTTP Code',
                    'data' => null
                ];
            }
        }


        return DataTables::of($projects)->make(true);
    }

    /**
     * Get onprogress project by tags
     */
    public function getOnProgressByTags(Request $request)
    {
        $query_tags = $request->query('tags');

        // get all tags name uniquely
        // below is alternative for distinct sql
        $available_tags = ProjectTag::orderBy('name','asc')->groupBy('name')->get();

        return view('project.list-onprogress-by-tags', compact('query_tags', 'available_tags'));
    }

    /**
     * Data for DataTable plugin, in onprogress project by tags page
     */
    public function getOnProgressByTagsAjax(Request $request)
    {
        $query_tags = $request->query('tags');

        /**
         | Get projects that has specific tags
         |
         | --------------------------------------------- */
        // get individual tags as array
        $tags = $query_tags;
        $projects = Project::with(['client', 'project_type'])
                           ->where('status', '=', Project::IS_ONPROGRESS);
        foreach ($tags as $tag) {
            // chaining in loop. Please look at assignment operator.
            $projects = $projects->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', '=', $tag);
            });
        }
        $projects = $projects->get();

        /**
        | Calculate progress percent for each project,
        | but also take the number of task complete and total number of task
        | --------------------------------------------------------------- */
        foreach ($projects as $project) {

            // we inform to ajax client that current project doesn't have
            // trello
            if (! $project->trello_board_id) {
                $project->progress = null;
                continue;
            }

            try {
                // calculate progress percent
                $progress_percent = getTrelloProgressByBoardId(
                    $project->trello_board_id,
                    $this->trello_auth,
                    $number_of_task,            // pass by reference
                    $number_of_task_complete    // pass by reference
                );

                // get last progress activity
                $last_complete_task = getTrelloLastProgress(
                    $project->trello_board_id,
                    $this->trello_auth
                );
                // in hours
                $last_progress_relative_time = Carbon::now()->diffInHours(Carbon::parse($last_complete_task['date']));

                // now save to the current model as array
                $project->progress = [
                    'status' => 200,
                    'message' => 'OK',
                    'data' => compact(
                        'progress_percent',
                        'number_of_task',
                        'number_of_task_complete',
                        'last_progress_relative_time'
                    ),
                ];
            }
            catch (\GuzzleHttp\Exception\ConnectException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => '502 HTTP Code. Try to check your internet connection',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ClientException $e)
            {
                $project->progress = [
                    'status' => 400,
                    'message' => 'Error 4XX HTTP Code',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\TooManyRedirectsException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Error. Too Many Redirection from Trello',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\RequestException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Networking Error',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ServerException $e)
            {
                $project->progress = [
                    'status' => 500,
                    'message' => 'Error 5XX HTTP Code',
                    'data' => null
                ];
            }
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
     * Get draft project by tags
     */
    public function getDraftByTags(Request $request)
    {
        $query_tags = $request->query('tags');

        // get all tags name uniquely
        // below is alternative for distinct sql
        $available_tags = ProjectTag::orderBy('name','asc')->groupBy('name')->get();

        return view('project.list-draft-by-tags', compact('query_tags', 'available_tags'));
    }

    /**
     * Data for DataTable plugin, in draft project by tags page
     */
    public function getDraftByTagsAjax(Request $request)
    {
        $query_tags = $request->query('tags');

        /**
         | Get projects that has specific tags
         |
         | --------------------------------------------- */
        // get individual tags as array
        $tags = $query_tags;
        $projects = Project::with(['client', 'project_type'])
                           ->where('status', '=', Project::IS_DRAFT);
        foreach ($tags as $tag) {
            // chaining in loop. Please look at assignment operator.
            $projects = $projects->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', '=', $tag);
            });
        }
        $projects = $projects->get();

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
        foreach ($projects as $project) {
            // we inform to ajax client that current project doesn't have
            // trello
            if (! $project->trello_board_id) {
                $project->progress = null;
                continue;
            }

            try {
                // calculate progress percent
                $progress_percent = getTrelloProgressByBoardId(
                    $project->trello_board_id,
                    $this->trello_auth,
                    $number_of_task,            // pass by reference
                    $number_of_task_complete    // pass by reference
                );

                // now save to the current model as array
                $project->progress = [
                    'status' => 200,
                    'message' => 'OK',
                    'data' => compact(
                        'progress_percent',
                        'number_of_task',
                        'number_of_task_complete'
                    ),
                ];
            }
            catch (\GuzzleHttp\Exception\ConnectException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => '502 HTTP Code. Try to check your internet connection',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ClientException $e)
            {
                $project->progress = [
                    'status' => 400,
                    'message' => 'Error 4XX HTTP Code',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\TooManyRedirectsException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Error. Too Many Redirection from Trello',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\RequestException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Networking Error',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ServerException $e)
            {
                $project->progress = [
                    'status' => 500,
                    'message' => 'Error 5XX HTTP Code',
                    'data' => null
                ];
            }
        }

        return DataTables::of($projects)->make(true);
    }

    /**
     * Get success project by tags
     */
    public function getSuccessByTags(Request $request)
    {
        $query_tags = $request->query('tags');

        // get all tags name uniquely
        // below is alternative for distinct sql
        $available_tags = ProjectTag::orderBy('name','asc')->groupBy('name')->get();

        return view('project.list-success-by-tags', compact('query_tags', 'available_tags'));
    }

    /**
     * Data for DataTable plugin, in success project by tags page
     */
    public function getSuccessByTagsAjax(Request $request)
    {
        $query_tags = $request->query('tags');

        /**
         | Get projects that has specific tags
         |
         | --------------------------------------------- */
        // get individual tags as array
        $tags = $query_tags;
        $projects = Project::with(['client', 'project_type'])
                           ->where('status', '=', Project::IS_DONE_SUCCESS);
        foreach ($tags as $tag) {
            // chaining in loop. Please look at assignment operator.
            $projects = $projects->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', '=', $tag);
            });
        }
        $projects = $projects->get();

        /**
        | Calculate progress percent for each project,
        | but also take the number of task complete and total number of task
        | --------------------------------------------------------------- */
        foreach ($projects as $project) {
            // we inform to ajax client that current project doesn't have
            // trello
            if (! $project->trello_board_id) {
                $project->progress = null;
                continue;
            }

            try {
                // calculate progress percent
                $progress_percent = getTrelloProgressByBoardId(
                    $project->trello_board_id,
                    $this->trello_auth,
                    $number_of_task,            // pass by reference
                    $number_of_task_complete    // pass by reference
                );

                // now save to the current model as array
                $project->progress = [
                    'status' => 200,
                    'message' => 'OK',
                    'data' => compact(
                        'progress_percent',
                        'number_of_task',
                        'number_of_task_complete'
                    ),
                ];
            }
            catch (\GuzzleHttp\Exception\ConnectException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => '502 HTTP Code. Try to check your internet connection',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ClientException $e)
            {
                $project->progress = [
                    'status' => 400,
                    'message' => 'Error 4XX HTTP Code',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\TooManyRedirectsException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Error. Too Many Redirection from Trello',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\RequestException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Networking Error',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ServerException $e)
            {
                $project->progress = [
                    'status' => 500,
                    'message' => 'Error 5XX HTTP Code',
                    'data' => null
                ];
            }
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

        /**
        | Calculate progress percent for each project,
        | but also take the number of task complete and total number of task
        | --------------------------------------------------------------- */
        foreach ($projects as $project) {

            // we inform to ajax client that current project doesn't have
            // trello
            if (! $project->trello_board_id) {
                $project->progress = null;
                continue;
            }

            try {
                // calculate progress percent
                $progress_percent = getTrelloProgressByBoardId(
                    $project->trello_board_id,
                    $this->trello_auth,
                    $number_of_task,            // pass by reference
                    $number_of_task_complete    // pass by reference
                );

                // now save to the current model as array
                $project->progress = [
                    'status' => 200,
                    'message' => 'OK',
                    'data' => compact(
                        'progress_percent',
                        'number_of_task',
                        'number_of_task_complete'
                    ),
                ];
            }
            catch (\GuzzleHttp\Exception\ConnectException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => '502 HTTP Code. Try to check your internet connection',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ClientException $e)
            {
                $project->progress = [
                    'status' => 400,
                    'message' => 'Error 4XX HTTP Code',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\TooManyRedirectsException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Error. Too Many Redirection from Trello',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\RequestException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Networking Error',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ServerException $e)
            {
                $project->progress = [
                    'status' => 500,
                    'message' => 'Error 5XX HTTP Code',
                    'data' => null
                ];
            }
        }

        return DataTables::of($projects)->make(true);
    }

    /**
     * Get fail project by tags
     */
    public function getFailByTags(Request $request)
    {
        $query_tags = $request->query('tags');

        // get all tags name uniquely
        // below is alternative for distinct sql
        $available_tags = ProjectTag::orderBy('name','asc')->groupBy('name')->get();

        return view('project.list-fail-by-tags', compact('query_tags', 'available_tags'));
    }

    /**
     * Data for DataTable plugin, in fail project by tags page
     */
    public function getFailByTagsAjax(Request $request)
    {
        $query_tags = $request->query('tags');

        /**
         | Get projects that has specific tags
         |
         | --------------------------------------------- */
        // get individual tags as array
        $tags = $query_tags;
        $projects = Project::with(['client', 'project_type'])
                           ->where('status', '=', Project::IS_DONE_FAIL);
        foreach ($tags as $tag) {
            // chaining in loop. Please look at assignment operator.
            $projects = $projects->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', '=', $tag);
            });
        }
        $projects = $projects->get();

        /**
        | Calculate progress percent for each project,
        | but also take the number of task complete and total number of task
        | --------------------------------------------------------------- */
        foreach ($projects as $project) {

            // we inform to ajax client that current project doesn't have
            // trello
            if (! $project->trello_board_id) {
                $project->progress = null;
                continue;
            }

            try {
                // calculate progress percent
                $progress_percent = getTrelloProgressByBoardId(
                    $project->trello_board_id,
                    $this->trello_auth,
                    $number_of_task,            // pass by reference
                    $number_of_task_complete    // pass by reference
                );

                // now save to the current model as array
                $project->progress = [
                    'status' => 200,
                    'message' => 'OK',
                    'data' => compact(
                        'progress_percent',
                        'number_of_task',
                        'number_of_task_complete'
                    ),
                ];
            }
            catch (\GuzzleHttp\Exception\ConnectException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => '502 HTTP Code. Try to check your internet connection',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ClientException $e)
            {
                $project->progress = [
                    'status' => 400,
                    'message' => 'Error 4XX HTTP Code',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\TooManyRedirectsException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Error. Too Many Redirection from Trello',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\RequestException $e)
            {
                $project->progress = [
                    'status' => 502,
                    'message' => 'Networking Error',
                    'data' => null
                ];
            }
            catch (\GuzzleHttp\Exception\ServerException $e)
            {
                $project->progress = [
                    'status' => 500,
                    'message' => 'Error 5XX HTTP Code',
                    'data' => null
                ];
            }
        }

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
     */
    public function storeStep3(\App\Http\Requests\StoreProject $request)
    {
        // we need to convert date to mysql format. Use merge() instead of $request->property_name
        $request->merge(['starttime' => str_to_date('Y-m-d', $request->starttime)]);
        $request->merge(['endtime' => str_to_date('Y-m-d', $request->endtime)]);
        $request->merge(['DP_time' => str_to_date('Y-m-d', $request->DP_time)]);

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

        // TODO: message below is not used
        return redirect()->route('create-project-step4', ['id' => $project->id])
            ->with('message', 'Berhasil menambah proyek')
            ->with('messageType', 'success');
    }

    /*
     * Create project step 4
     *
     * Add tag to project
     */
    public function createStep4($id)
    {
        $project = Project::find($id);

        // get all tags name uniquely
        // below is alternative for distinct sql
        $available_tags = ProjectTag::orderBy('name','asc')->groupBy('name')->get();

        return view('project.tag.add', compact('project', 'available_tags'));
    }

    /*
     * store new project data in step 4
     *
     * Store project tag to DB
     */
    public function storeStep4(Request $request, $id)
    {
        $project = Project::find($id);

        // value is separated by comma
        $tags = explode(',', $request->tags);

        // store tag to DB and link relation between project and project-tag
        foreach ($tags as $tag) {
            $project->tags()->save(new ProjectTag([
                'name' => trim( $tag )
            ]));
        }

        return redirect()
               ->route('project-detail', ['id' => $project->id]);
    }

    /**
     * Edit for draft project
     *
     * for onprogress project see @method editRestricted()
     * for archive project is not allowed to edit
     */
    public function edit($id)
    {
        $project = Project::find($id);

        $client = $project->client;

        // get all PIC name uniquely, for autocomplete in the form
        // below sql is alternative for distinct sql
        $PICs = PIC::orderBy('name','asc')->groupBy('name')->get();

        if ($project->is_draft) {
            return view('project.edit-form', compact('project', 'client', 'PICs'));
        }

        // maybe project is archive or on progress
        // return HTTP 405 method not allowed
        abort(405);
    }

    /**
     * Update data of draft project
     *
     * for onprogress project see @method updateRestricted()
     * for archive project is not allowed to edit
     *
     * NOTE: request data already validated and sanitized
     */
    public function update(\App\Http\Requests\UpdateProject $request, $id)
    {
        $project = Project::find($id);

        // non-draft not allowed
        if (! $project->is_draft) abort(405);

        // we need to convert date to mysql format. Use merge() instead of $request->property_name
        $request->merge(['starttime' => str_to_date('Y-m-d', $request->starttime)]);
        $request->merge(['endtime' => str_to_date('Y-m-d', $request->endtime)]);
        $request->merge(['DP_time' => str_to_date('Y-m-d', $request->DP_time)]);

        $project->name = $request->name;
        $project->price = $request->price;
        $project->quantity = $request->quantity;
        $project->starttime = $request->starttime;
        $project->endtime = $request->endtime;
        $project->DP_time = $request->DP_time;
        $project->additional_note = $request->additional_note;
        $project->trello_board_id = $request->trello_board_id;
        $project->save();

        // [1] delete all PIC db record first
        foreach ($project->PICs as $model) {
            $model->delete();
        }
        // [2] then save again
        foreach ($request->PIC as $PIC_name) {
            $project->PICs()->create(['name' => $PIC_name]);
        }

        // [1] delete all backup link db record first
        foreach ($project->backup_source_code_project_links as $model) {
            $model->delete();
        }
        // [2] then save again
        foreach ($request->backup_source_code_project_link as $link) {
            $project->backup_source_code_project_links()->create(['link_text' => $link]);
        }

        // [1] delete all project link db record first
        foreach ($project->project_links as $model) {
            $model->delete();
        }
        // [2] then save again
        foreach ($request->project_link as $link) {
            $project->project_links()->create(['link_text' => $link]);
        }

        return redirect()->route('project-detail', ['project_id' => $project->id])
            ->with('message', 'Berhasil mengubah proyek')
            ->with('messageType', 'success');
    }

    /**
     * Update data of onprogress project
     *
     * for draft project see @method edit()
     * for archive project is not allowed to edit
     *
     * NOTE: request data already validated and sanitized
     */
    public function editRestricted($id)
    {
        $project = Project::find($id);

        $client = $project->client;

        if ($project->is_onprogress) {
            return view('project.edit-form_restricted', compact('project', 'client'));
        }

        // maybe project is archive or draft
        // return HTTP 405 method not allowed
        abort(405);
    }

    /**
     * Update data of onprogress project
     *
     * for draft project see @method update()
     * for archive project is not allowed to edit
     *
     * NOTE: request data already validated and sanitized
     */
    public function updateRestricted(\App\Http\Requests\UpdateRestrictedProject $request, $id)
    {
        $project = Project::find($id);

        // non-onprogress not allowed
        if (! $project->is_onprogress) abort(405);

        $project->additional_note = $request->additional_note;
        $project->trello_board_id = $request->trello_board_id;
        $project->save();

        // [1] delete all backup link db record first
        foreach ($project->backup_source_code_project_links as $model) {
            $model->delete();
        }
        // [2] then save again
        foreach ($request->backup_source_code_project_link as $link) {
            $project->backup_source_code_project_links()->create(['link_text' => $link]);
        }

        // [1] delete all project link db record first
        foreach ($project->project_links as $model) {
            $model->delete();
        }
        // [2] then save again
        foreach ($request->project_link as $link) {
            $project->project_links()->create(['link_text' => $link]);
        }

        return redirect()->route('project-detail', ['project_id' => $project->id])
            ->with('message', 'Berhasil mengubah proyek')
            ->with('messageType', 'success');
    }

    public function editTag($id)
    {
        $project = Project::find($id);

        // get all tags name uniquely
        // below is alternative for distinct sql
        $available_tags = ProjectTag::orderBy('name','asc')->groupBy('name')->get();

        return view('project.tag.edit', compact('project', 'available_tags'));
    }

    public function updateTag(Request $request, $id)
    {
        $project = Project::find($id);

        if (! $request->tags) {
            // if tags is empty, null here; we know user want to delete all tags
            foreach ($project->tags as $tag) {
                $tag->delete();
            }
        } else {
            // value is separated by comma
            $tags = explode(',', $request->tags);

            // [1] delete all project tag record first
            foreach ($project->tags as $tag) {
                $tag->delete();
            }
            // [2] then save again
            foreach ($tags as $tag) {
                $project->tags()->save(new ProjectTag([
                    'name' => trim( $tag )
                ]));
            }
        }

        return redirect()
               ->route('project-detail', ['id' => $project->id]);
    }

    public function changeClient($id)
    {
        $project = Project::find($id);

        return view('project.change-client', compact('project'));
    }

    public function changeClientConfirmation($id, $new_client_id)
    {
        $project = Project::find($id);

        $old_client = $project->client;
        $new_client = Client::find($new_client_id);

        return view('project.change-client_confirmation', compact('project', 'old_client', 'new_client'));
    }

    public function updateClient($id, $new_client_id)
    {
        $new_client = Client::find($new_client_id);

        // update
        $project = Project::find($id);
        $project->client()->associate($new_client);
        $project->save();

        return redirect()->route('project-detail', ['id' => $project->id])
            ->with('message', 'Berhasil mengubah client')
            ->with('messageType', 'success');
    }

    public function changeType($id)
    {
        $project = Project::find($id);

        $project_types = ProjectType::all();

        return view('project.change-type', compact('project', 'project_types'));
    }

    public function changeTypeConfirmation($id, $new_type_id)
    {
        $project = Project::find($id);

        $old_project_type = $project->project_type;
        $new_project_type = ProjectType::find($new_type_id);

        return view('project.change-type_confirmation', compact('project', 'old_project_type', 'new_project_type'));
    }

    public function updateType($id, $new_type_id)
    {
        $new_project_type = ProjectType::find($new_type_id);

        // update
        $project = Project::find($id);
        $project->project_type()->associate($new_project_type);
        $project->save();

        return redirect()->route('project-detail', ['id' => $project->id])
            ->with('message', 'Berhasil mengubah tipe proyek')
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
     * This activation step is just confirmation. Make sure that all data is
     * correct.
     */
    public function activationStep1($id)
    {
        $project = Project::find($id);
        $client = $project->client;

        return view('project.activation.confirmation', compact('project', 'client'));
    }

    public function activationStep2($id)
    {
        return view('project.activation.ask-payment-method', compact('id'));
    }

    /**
     * Payment method confirmation step
     */
    public function activationStep3($id, $choice)
    {
        $project = Project::find($id);

        if ($choice == Project::PAYMENT_BY_FULLCASH) {
            // we send confirmation
            return view('project.activation.set-payment-method-as-fullcash_confirmation', compact('id', 'project'));
        }
        if ($choice == Project::PAYMENT_BY_TERMIN) {
            // we send the work to termin controller
            return redirect()->route('create-termin', ['project_id' => $id]);
        }

        // we don't understand $choice value
        abort(404);
    }

    /**
     *
     * NOTE: if the flow is confusing I will make clear here.
     *
     * Below the flow of method execution based on user's chosen payment method.
     *
     *  1) Full Cash
     *
     *          activationStep3 -> activationStep4
     *
     *  2) Termin
     *
     *          activationStep3 -> termin controller -> activationStep4
     *
     *     if termin, this action method accessed by redirection from termin
     *     controller store() method.
     */
    public function activationStep4($id, $choice)
    {
        $project = Project::find($id);

        /**
         | Set payment method
         | ---------------------------------------------- */
        if ($choice == Project::PAYMENT_BY_FULLCASH) {
            // we set payment method here
            $project->payment_method = Project::PAYMENT_BY_FULLCASH;
        } else if ($choice == Project::PAYMENT_BY_TERMIN) {
            // the work is done by termin controller store() method
            // so here we have no work
        } else {
            abort(404);
        }

        /**
         | Activate the project
         |
         | Mark project as On Progress
         | ---------------------------------------------- */
        $project->status = Project::IS_ONPROGRESS;
        $project->save();

        /**
         | Change prospect to client
         |
         | if this person is prospect
         |
         | NOTE: Prospek adalah orang yang tidak memiliki riwayat
         |       proyek *berjalan*. Sehingga setelah dia memiliki proyek berjalan
         |       maka akan berubah menjadi client
         | ---------------------------------------------- */
        $project->client->status = Client::IS_CLIENT;
        $project->client->save();
        // record 'when' the transformation happens to database
        $prospect_transformation = new ProspectToClientTransformation;
        $prospect_transformation->client()->associate($project->client);
        $prospect_transformation->created_at = date('Y-m-d');
        $prospect_transformation->save();

        return redirect()->route('project-detail', ['project_id' => $id])
            ->with('message', 'Proyek telah aktif')
            ->with('messageType', 'success');
    }

    /**
     * NOTE: deactivation = mark project done (success or fail)
     */
    public function deactivationConfirmation($id)
    {
        $project = Project::find($id);

        // we add 1 because diffInDays() is exclusive in one edge
        $project_age = Carbon::now()->diffInDays(Carbon::parse($project['starttime']));

        return view('project.deactivation.confirmation', compact('project', 'project_age'));
    }

    public function deactivation(Request $request, $id)
    {
        // TODO: add validation to make sure $request->status is valid value
        $project = Project::find($id);
        $project->status = $request->status;
        $project->endtime_actual = date('Y-m-d');
        $project->save();

        return redirect()->route('project-detail', ['id' => $project->id]);
    }

    public function deleteConfirmation($id)
    {
        $project = Project::find($id);

        return view('project.delete_confirmation', compact('id', 'project'));
    }

    public function delete($id)
    {
        $project = Project::find($id);

        // delete non-draft project is not allowed
        if ( ! $project->is_draft) {
            abort(405, 'Tidak diizinkan untuk proyek non-draft');
        }

        $project->delete();

        return redirect()->route('draft-project-list');
    }
}
