<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientType;
use DataTables;

class ClientTypeController extends Controller
{
    /**
     * Show list of client type
     */
    public function get()
    {
        return view('client_type.list');
    }

    /**
     * Data for DataTable plugin, in client type list page
     */
    public function getAjax(Request $request)
    {
        $client_types = ClientType::all();

        return DataTables::of($client_types)->make(true);
    }

    public function create()
    {
        return view('client_type.create');
    }

    public function store(Request $request)
    {
        // TODO: variable is never used
        $client_type = ClientType::create($request->all());

        return redirect()->route('client-type-list');
    }

    public function delete($name)
    {
        $client_type = ClientType::find($name);

        if ($client_type->clients->count() > 0) {
            abort(405, 'This client type has relation with clients tables. You should delete all these relation before delete.');
        }

        $client_type->delete();

        return redirect()->route('client-type-list')
            ->with('message', 'Berhasil menghapus')
            ->with('messageType', 'success');
    }
}
