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
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


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
        $prospect = Client::with(['type','phone','email'])->where('clients.status','=',Client::IS_PROSPECT)->get();
        
        return Datatables::of($prospect)
        ->addColumn('options',function($prospect){
            return '<div class="text-center"><div class="item-action dropdown"><a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a><div class="dropdown-menu dropdown-menu-right"><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a><a href="javascript:deleteProspect('."'".$prospect->id."'".')" id="deleteProspect" class="dropdown-item"><i class="dropdown-icon fe fe-trash"></i> Delete </a>';
        })->rawColumns(['options'])->make(true);
    }

    public function getClient()
    {
        $client = Client::with(['type','phone','email'])->where('clients.status','=',Client::IS_CLIENT)->get();

        return Datatables::of($client)
        ->addColumn('options',function($client){
            return '<div class="text-center"><div class="item-action dropdown"><a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a><div class="dropdown-menu dropdown-menu-right"><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detail </a><a href="javascript:deleteClient('."'".$client->id."'".')" id="deleteClient" class="dropdown-item"><i class="dropdown-icon fe fe-trash"></i> Delete </a>';
        })->rawColumns(['options'])->make(true);
    }

    public function deleteClient(Request $req,$id)
    {   
      $client = Client::findorFail($id);
        if($client->photo  === null )
        {
            $client->delete();
        }
         $tes = Storage::delete('public/clientImage/'.$client->photo);
         $client->delete();
         return response()->json(['status'=>true]);
      
    }

    
    public function deleteProspect(Request $req,$id)
    {   
      $prospect = Prospect::findorFail($id);
        if($prospect->photo  === null )
        {
            $prospect->delete();
        }
         $tes = Storage::delete('public/prospectImage/'.$prospect->photo);
         $prospect->delete();
         return response()->json(['status'=>true]);
      
    }

    public function newClientType()
    {
        $listClientTypes = ClientType::get();
        return view('client.new-client-types',['listClientTypes'=>$listClientTypes]);
    }

    public function newClientForm()
    {
        return view('client.new-client-form');
    }

    public function getClientType(Request $req)
    {
        //get parameter
        $idType = $req->getQueryString();
        // dd($idType);
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


    public function createClientForm(\App\Http\Requests\StoreClient $req)
    {
       
        $client = new Client();
        
        if($req->hasFile('photo'))
        {
            $clientImage      = $req->file('photo');
            // dd($clientImage);
            $fileName   =  $clientImage->getClientOriginalName();
            Storage::putFileAs('public/clientImage', $clientImage, $fileName);
            $client->photo            = $fileName;
        }

        $client->client_type_id   = $req->tipeClient;
        $client->name             = $req->nama;

        $client->business_relationship_status = $req->statusHub;    
        // this person is prospect until has project active
        $client->status = Client::IS_PROSPECT;
        $client->save();

        $client->address()->create(['address'=>$req->alamat]);

        foreach ($req->kota as $kota) {
            $client->city()->create(['city' => $kota]);
        }

        foreach ($req->telepon as $telepon) {
            $client->phone()->create(['phone' => $telepon]);
        }

        foreach ($req->email as $email) {
            $client->email()->create(['email' => $email]);
        }

        foreach ($req->norek as $norek) {
            $client->bankAccount()->create(['bank_account' => $norek]);
        }

        foreach ($req->web as $web) {
            $client->webAddress()->create(['web_addresses' => $web]);
        }
 
        return redirect()->route('newClientInsider',['id'=>$client->id])
        ->with('message', 'Berhasil menambah Client')
        ->with('alert-class', 'alert-success');

    }

    public function newClientInsider(Request $req)
    {
        $getId = $req->all();
        // print_r($getId);
        return view('client.new-client-insider',['idClient'=>$getId['id']]);
    }

    public function createClientInsider(\App\Http\Requests\StoreInsider $req)
    {
     
        $client_id = $req->input('did');
        // print_r($client_id);
        $input = $req->all();
        // dd($input);
        $amount = count($input['nama']);
    
        $array_baru = [];
        for($i=1 ; $i <= $amount ; $i++)
        {
            if( $req->has('fotoProfile'))
            {
                echo 'tes dalam';
                $clientImage = $req->file('fotoProfile')[$i];
                $fileName    =  $clientImage->getClientOriginalName();
                Storage::putFileAs('public/insiderClient', $clientImage, $fileName);
            
            
            $array_baru[]=[
                'nama'          =>$input['nama'][$i],
                'jabatan'       =>$input['jabatan'][$i],
                'alamat'        =>$input['alamat'][$i],
                'fotoProfile'   =>$fileName,
                'keterangan'    =>$input['keterangan'][$i],
            ];
        }else{
            $array_baru[]=[
                'nama'          =>$input['nama'][$i],
                'jabatan'       =>$input['jabatan'][$i],
                'alamat'        =>$input['alamat'][$i],
                'fotoProfile'   =>'no photo',
                'keterangan'    =>$input['keterangan'][$i],
            ];
        }
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
        
        return redirect()->route('clientList')
        ->with('message', 'Berhasil menambah Insider Client')
        ->with('alert-class', 'alert-success');
     
    }
}
