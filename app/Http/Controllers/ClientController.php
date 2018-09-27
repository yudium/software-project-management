<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Client;
use App\ClientEmail;
use App\ClientPhone;
use App\ClientType;

class ClientController extends Controller
{
    public function index()
    {
        return view('prospect.prospect-list');
    }

    public function getProspect()
    {
        $prospect = Client::select([
            'clients.photo as photo',
            'clients.name as name',
            'client_types.name as type',
            'client_phones.phone as phone',
            'client_emails.email as email',
            'clients.business_relationship_status as status_hub'
        ])->join('client_types','client_types.id','=','clients.client_type_id')
        ->join('client_phones','client_phones.client_id','=','clients.id')
        ->join('client_emails','client_emails.client_id','=','clients.id');

        return Datatables::of($prospect)->make(true);
    }
}
