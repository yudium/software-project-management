<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Agent;
use App\Http\Requests\StoreAgent;
use Redirect;
use Illuminate\Support\Facades\Log;
class AgentController extends Controller
{
    public function index()
    {
        return view('agent.agent-list');
    }

    public function getAgent()
    {
        $agent = Agent::with(['email','phone'])->get();
        return Datatables::of($agent)->make(true);
    }

    public function newAgentForm()
    {
        return view('agent.new-agent-form');
    }

    public function createAgentForm(StoreAgent $req)
    {
        Log::error($req);
        // echo "berhasil request";
        // $agent = new Agent();
        // $agent->name        = $req->nama;
        // $agent->address     = $req->alamat;
        // $agent->city        = $req->kota;
        // if($req->hasFile('foto'))
        // {
        //     $agentImage = $req->file('foto');
        //     $fileName = $agentImage->getClientOriginalExtension();
        //     Image::make($agentImage)->resize(300, 300)->save( storage_path('/agentImage/' . $filename ));
        //     $agent->photo =  $fileName ;
        // }
     

        // $agent->save();

        // foreach($req->telepon as $listTelepon)
        // {
        //     $agent->phone()->create(['phone'=>$listTelepon]);
        // }

        // foreach($req->email as $listNorek)
        // {
        //     $agent->bankAccount()->create(['bank_account'=>$listNorek]);
        // }

        // foreach($req->email as $listEmail)
        // {
        //     $agent->email()->create(['email'=>$listEmail]);
        // }

        // foreach($req->web as $listWeb)
        // {
        //     $agent->webAddress()->create(['web_address'=>$listWeb]);
        // }

        // $notification = array(
        //     'message' => 'success in storing data!!', 
        //     'alert-type' => 'success'
        // );
        
        // return Redirect::to('/agent/agent-list')->with($notification);
    }
}
