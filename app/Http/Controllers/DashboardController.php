<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Client;
use App\PotentialProject;
use App\Termin;

class DashboardController extends Controller
{
    public function main()
    {
        /**
         | Client & Prospect count
         |
         | ----------------------------------------------------------- */
        $client_count = Client::where('status', Client::IS_CLIENT)->count();
        $prospect_count = Client::where('status', Client::IS_PROSPECT)->count();

        /**
         | Project count
         |
         | ----------------------------------------------------------- */
        $project_total_count = Project::all()->count();
        $project_draft_count = Project::where('status', '=', Project::IS_DRAFT)->count();
        $project_onprogress_count = Project::where('status', '=', Project::IS_ONPROGRESS)->count();
        $project_success_count = Project::where('status', '=', Project::IS_DONE_SUCCESS)->count();
        $project_fail_count = Project::where('status', '=', Project::IS_DONE_FAIL)->count();

        $potential_project_count = PotentialProject::doesntHave('project')->count();

        /**
         | Rough income
         |
         | calculated by sum all price*quantity of success project (archive)
         | ----------------------------------------------------------- */
        $total_income = 0;
        $project_success = Project::where('status', '=', Project::IS_DONE_SUCCESS)->get();
        foreach ($project_success as $project) {
            $total_income += $project->price * $project->quantity;
        }

        /**
         | Get onprogress project
         |
         | ----------------------------------------------------------- */
        $project_onprogress = Project::where('status', '=', Project::IS_ONPROGRESS)->get();

        /**
         | Get termins for getting next charge date
         | (ambil termin untuk mengambil tanggal penagihan berikutnya)
         |
         | this model has @property current_termin_detail that return model
         | termin_detail that contains next charge date.
         | ----------------------------------------------------------- */
        $termins = Termin::whereNull('paid_off')->get();

        return view('dashboard', compact(
            'client_count',
            'prospect_count',

            'project_total_count',
            'project_draft_count',
            'project_onprogress_count',
            'project_success_count',
            'project_fail_count',
            'potential_project_count',

            'total_income',

            'project_onprogress',

            'termins'
        ));
    }
}
