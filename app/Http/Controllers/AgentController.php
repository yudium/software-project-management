<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Agent;
use File;
use Storage;
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

        $listAgent = Agent::with(['email','phone'])->select(DB::raw("id, name, username,city,photo,(SELECT SUM(commissions.amount) FROM commissions,agent_projects WHERE agent_projects.id=commissions.agent_project_id and agent_projects.agent_id=agents.id GROUP BY agents.id) as total_com "))->get();  
        return Datatables::of($listAgent)
        ->addColumn('options',function($listAgent){
            if($listAgent->username === 'Nonaktif'){
                return '<div class="text-center"><a href="'.route('activateAgent', $listAgent->id).'" class="btn btn-primary btn-sm mr-3">Aktifkan akun</a><a href="javascript:deleteAgent('."'".$listAgent->id."'".')"  class="btn btn-primary btn-sm mr-3"> Delete </a></div>';
            }else{
                return '<div class="text-center"><a href="javascript:deleteAgent('."'".$listAgent->id."'".')"  class="btn btn-primary btn-sm mr-3"> Delete </a></div>';
            }
          
        })->rawColumns(['options'])->make(true);

    }

    public function newAgentForm()
    {
        return view('agent.new-agent-form');
    }

    public function createAgentForm(\App\Http\Requests\StoreAgent $req)
    {
        // dd($req->telepon);
        $agent = new Agent();
        if($req->hasFile('photoAgent'))
        {
            $agentImage      = $req->file('photoAgent');
            // dd($clientImage);
            $fileName   =  $agentImage->getClientOriginalName();
            Storage::putFileAs('public/agentImage', $agentImage, $fileName);
            $agent->photo            = $fileName;
        }else{
            $agent->photo            = '';
        }
        $agent->name        = $req->nama;
        $agent->address     = $req->alamat;
        $agent->city        = $req->kota;
        $agent->save();

        foreach($req->telepon as $listTelepon)
        {
            $agent->phone()->create(['phone'=>$listTelepon]);
        }

        foreach($req->email as $listNorek)
        {
            $agent->bankAccount()->create(['bank_account'=>$listNorek]);
        }

        foreach($req->email as $listEmail)
        {
            $agent->email()->create(['email'=>$listEmail]);
        }

        foreach($req->web as $listWeb)
        {
            $agent->webAddress()->create(['web_address'=>$listWeb]);
        }

        $notification = array(
            'message' => 'success in storing data!!', 
            'alert-type' => 'success'
        );
        
        return Redirect::to('/agent/agent-list')->with($notification);
    }

    public function activateAgent($id)
    {
        $random = str_random(7);
        $agent = Agent::findorFail($id);
        $agent->username = $random;
        $agent->save();
        return view('agent.agent-activation',['usernameKode'=>$random]);
    } 
}
