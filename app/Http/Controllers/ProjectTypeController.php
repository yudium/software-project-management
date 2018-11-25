<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectType;
use DataTables;

class ProjectTypeController extends Controller
{
    /**
     * Show list of project type
     */
    public function get()
    {
        return view('project_type.list');
    }

    /**
     * Data for DataTable plugin, in project type list page
     */
    public function getAjax(Request $request)
    {
        $project_types = ProjectType::all();

        return DataTables::of($project_types)->make(true);
    }

    public function create()
    {
        return view('project_type.create');
    }

    public function store(Request $request)
    {
        // TODO: variable is never used
        $project_type = ProjectType::create($request->all());

        return redirect()->route('project-type-list');
    }

    public function delete($name)
    {
        $project_type = ProjectType::find($name);

        if ( ($project_type->projects->count() > 0) OR
             ($project_type->potential_projects->count() > 0) ) {
            abort(405, 'This project type has relation with projects tables or/and potential projects. You should delete all these relation before delete.');
        }

        $project_type->delete();

        return redirect()->route('project-type-list')
            ->with('message', 'Berhasil menghapus')
            ->with('messageType', 'success');
    }
}
