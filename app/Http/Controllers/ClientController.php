<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Session;
use App\Insider;
use App\Client;
use App\ClientEmail;
use App\ClientPhone;
use App\ClientType;

class ClientController extends Controller
{
    public function prospectList()
    {
        return view('prospect.prospect-list');
    }

    public function clientList()
    {
        return view('client.client-list');
    }

    public function getProspect()
    {
        $prospect = Client::join('client_types','clients.client_type_id','=','client_types.id')
        ->join('client_phones','clients.id','=','client_phones.client_id')
        ->join('client_emails','clients.id','=','client_emails.client_id')
        ->select([
            'clients.id as id',
            'clients.photo as photo',
            'clients.name as name',
            'client_types.name as type',
            'client_phones.phone as phone',
            'client_emails.email as email',
            'clients.business_relationship_status as status_hub'
        ])->where('clients.status','=','prospect')->get();
        // $prospect = Client::with(['client_types','client_phones','client_emails'])->get();

        return Datatables::of($prospect)
        ->addColumn('options',function($prospect){
            return '<div class="text-center"><div class="item-action dropdown"><a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a><div class="dropdown-menu dropdown-menu-right"><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a><div class="dropdown-divider"></div><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a></div></div></div>';
        })->rawColumns(['options'])->make(true);
    }

    public function getClient()
    {
        $client = Client::with(['type','phone','email'])->where('clients.status','=','client')->get();

        return Datatables::of($client)
        ->addColumn('options',function($client){
            return '<div class="text-center"><div class="item-action dropdown"><a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a><div class="dropdown-menu dropdown-menu-right"><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Termin Pembayaran </a><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Progress Tracker</a><div class="dropdown-divider"></div><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a></div></div></div>';
        })->rawColumns(['options'])->make(true);
    }

    public function newProspectType()
    {
        $listProspectTypes = ClientType::get();
        return view('prospect.new-prospect-types',['listProspectTypes'=>$listProspectTypes]);
    }

    public function newClientType()
    {
        $listClientTypes = ClientType::get();
        return view('client.new-client-types',['listClientTypes'=>$listClientTypes]);
    }

    public function newProspectForm()
    {
        return view('prospect.new-prospect-form');
    }

    public function newClientForm()
    {
        return view('client.new-client-form');
    }

    public function getProspectType(Request $req)
    {
        //get parameter
        $idType = $req->getQueryString();
        //get value type id
        $valueId  = $req->input('prospect_type_id');
       
        $clientType = CLientType::where('id','=',$valueId)->first();
        if (!str_contains($idType,'prospect_type_id'))
        {
            Session::flash('message', 'Pilih type prospect dahulu !!!'); 
            Session::flash('alert-class', 'alert-warning'); 

            return redirect('/client/new/prospect-types');
        }

        return view('prospect.new-prospect-form',['idType'=>$clientType]);
    }

    public function getClientType(Request $req)
    {
        //get parameter
        $idType = $req->getQueryString();
        //get value type id
        $valueId  = $req->input('client_type_id');
       
        $clientType = CLientType::where('id','=',$valueId)->first();
        if (!str_contains($idType,'client_type_id'))
        {
            Session::flash('message', 'Pilih type client dahulu !!!'); 
            Session::flash('alert-class', 'alert-warning'); 

            return redirect('/client/new/client-types');
        }

        return view('client.new-client-form',['idType'=>$clientType]);
    }

    public function createProspectForm(\App\Http\Requests\StoreProspect $req)
    {

        $prospect = new Client();
        $prospect->client_type_id   = $req->tipeProspect;
        $prospect->name             = $req->nama;
        $prospect->business_relationship_status = $req->statusHub;
        if($req->has('photo'))
        {
            $prospectImage = $req->file('photo');
            dd($prospectImage);
        }
        // $prospect->photo = 'test';
        $prospect->status   = $prospect->getStatusTextAttribute(Client::IS_PROSPECT);
        $prospect->save();

        $prospect->address()->create(['address'=>$req->alamat]);

        foreach ($req->kota as $kota) {
            $prospect->city()->create(['city' => $kota]);
        }

        foreach ($req->telepon as $telepon) {
            $prospect->phone()->create(['phone' => $telepon]);
        }

        foreach ($req->email as $email) {
            $prospect->email()->create(['email' => $email]);
        }

        foreach ($req->norek as $norek) {
            $prospect->bankAccount()->create(['bank_account' => $norek]);
        }

        foreach ($req->web as $web) {
            $prospect->webAddress()->create(['web_addresses' => $web]);
        }
 
        return redirect()->route('newProspectInsider',['id'=>$prospect->id]);
        // ->with('message', 'Berhasil menambah prospect')
        // ->with('messageType', 'success');
    }

    public function newProspectInsider(Request $req)
    {
        $getId = $req->all();
        // print_r($getId);
        return view('prospect.new-prospect-insider',['idClient'=>$getId['id']]);
    }

    public function createProspectInsider(\App\Http\Requests\StoreInsider $req)
    {
        $client_id = $req->input('did');
        // print_r($client_id);
        $input = $req->all();
        $amount = count($input['nama']);
       
        $array_baru = [];
        for($i=1 ; $i <= $amount ; $i++)
        {
            $array_baru[]=[
                'nama'          =>$input['nama'][$i],
                'jabatan'       =>$input['jabatan'][$i],
                'alamat'        =>$input['alamat'][$i],
                'fotoProfile'   =>$input['fotoProfile'][$i],
                'keterangan'    =>$input['keterangan'][$i],
            ];
        }
        $client_insider = Client::find($client_id);
       foreach($array_baru as $key=>$insider)
       {
        
           $client_insider->insider()->create([
               'client_id'=>$client_id,
               'name'=>$insider['nama'],
               'position'=>$insider['jabatan'],
               'address'=>$insider['alamat'],
               'photo'=>$insider['fotoProfile'],
               'note'=>$insider['keterangan'],
           ]);
       }
        $insider_id = DB::table('client_orang_dalam')->where('client_id','=',$client_id)->select('id')->get();
   
        $count_telepon = count($input['telepon']);
        for($i=1 ; $i <=$count_telepon ; $i++)
        {
             foreach ($req->telepon[$i] as $telepon) {
            $telepon_insider = DB::table('client_orang_dalam_phones')->insert(['phone' => $telepon,'client_orang_dalam_id'=>$insider_id[$i-1]->id]);
            }
        }
   
        $count_email = count($input['email']);
        for($i=1 ; $i <=$count_email ; $i++)
        {
             foreach ($req->email[$i] as $email) {
            $email_insider = DB::table('client_orang_dalam_emails')->insert(['email' => $email,'client_orang_dalam_id'=>$insider_id[$i-1]->id]);
            }
        }
        
        return redirect()->route('prospectList');
     
    }
}
