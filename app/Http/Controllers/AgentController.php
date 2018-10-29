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
        $agent = Agent::with(['email','phone',DB::raw("(SELECT SUM(commissions.amount) FROM commissions,agent_projects WHERE agent_projects.id=commissions.agent_project_id and agent_projects.agent_id=agents.id GROUP BY agents.id) as total_com")])->get();

        // $agent = DB::table('agents')
        // ->join('agent_phones','agents.id','=','agent_phones.agent_id')
        // ->join('agent_emails','agents.id','=','agent_emails.agent_id')
        // ->select([
        //             'agents.id',
        //             'agents.name as name',
        //             'agents.username as username',
        //             'agents.city as city',
        //             'agents.photo',
        //             'agent_emails.email',
        //             'agent_phones.phone',
        //             DB::raw("(SELECT SUM(commissions.amount) FROM commissions,agent_projects WHERE agent_projects.id=commissions.agent_project_id and agent_projects.agent_id=agents.id GROUP BY agents.id) as total_com "
        //             )])->get();
        
        return Datatables::of($agent)
        ->addColumn('options',function($agent){
            return '<div class="text-center"><a href="agen-aktifkan-akun.html" class="btn btn-primary btn-sm mr-3">Aktifkan akun</a><div class="item-action dropdown"><a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a><div class="dropdown-menu dropdown-menu-right"><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i>Detail </a><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i>Termin Pembayaran </a><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i>Progress Tracker</a><div class="dropdown-divider"></div><a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i>Separated link</a></div></div></div>';
        })->rawColumns(['options'])->make(true);

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
