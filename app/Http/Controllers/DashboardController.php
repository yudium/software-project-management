<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function main()
    {
        // TODO: status number here just for test, change it
        $number_of_active_projects = \App\Project::where('status', '=', 1)->count();

        return view('dashboard', compact('number_of_active_projects'));
    }
}
