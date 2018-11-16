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

        $listAgent = Agent::with(['email','phone'])->select(DB::raw("id, name, username,city,photo,created_at,(SELECT SUM(agent_commissions.amount) FROM agent_commissions,agent_projects WHERE agent_projects.id=agent_commissions.agent_project_id and agent_projects.agent_id=agents.id GROUP BY agents.id) as total_com "))->get();  
        return Datatables::of($listAgent)
        ->addColumn('options',function($listAgent){
            if($listAgent->username === 'Nonaktif'){
                return '<div class="text-center"><a href="'.route('activateAgent', $listAgent->id).'" class="btn btn-primary btn-sm mr-3">Aktifkan akun</a><a href="javascript:void(0);"  data-id-agent="'.$listAgent->id.'" class="btn btn-primary btn-sm mr-3 deleteAgent"> Delete </a></div>';
            }else{
                return '<div class="text-center"><a href="javascript:void(0);"  data-id-agent="'.$listAgent->id.'" class="btn btn-primary btn-sm mr-3 deleteAgent"> Delete </a></div>';
            }
          
        })->rawColumns(['options'])->make(true);

    }

    public function getAgentCommission()
    {
        // $agentCommission = Agent::
    }

    public function listCommission()
    {
        return view('agent.agent-listCommission');
    }

    public function getListCommission()
    {
        $listCommission = DB::table('agents')
                        ->join('agent_projects','agents.id','=','agent_projects.agent_id')
                        ->join('agent_commissions','agent_projects.id','=','agent_commissions.agent_project_id')
                        ->get();
        return Datatables::of($listCommission)
        ->addColumn('options',function($listCommission){
                return '<div class="text-center"><a href="komisi-agen_form-bayar.html" class="btn btn-secondary btn-sm mr-3">Bayar</a><a href="komisi-agen_history.html" class="btn btn-secondary btn-sm mr-3">Riwayat Komisi</a></div>';
        })
        ->addColumn('status_bayar',function($listCommission){
            return '<span class="badge badge-danger">Belum dibayar</span>';
        })
        ->rawColumns(['options','status_bayar'])->make(true);
    }

    public function newAgentForm()
    {
        return view('agent.new-agent-form');
    }

    public function deleteAgent(Request $req,$id)
    {   
      $agent = Agent::findorFail($id);
        if($agent->photo  === null )
        {
            $agent->delete();
        }
         $tes = Storage::delete('public/agentImage/'.$agent->photo);
         $agent->delete();
         return response()->json(['status'=>true]);
      
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

    public function paymentAgent()
    {
        return view('agent.agent-payment');
    }
}
