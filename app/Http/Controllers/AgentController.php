<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Agent;
use App\AgentProject;
use App\Bank;
use App\AgentCommission;
use App\AgentCommissionPayment;
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

    // public function getAgentCommission()
    // {
    //     // $agentCommission = Agent::
    // }

    public function listCommission()
    {
        return view('agent.agent-listCommission');
    }

    public function getListCommission()
    {
        $agentListCommission = Agent::with(['agentProject'])->get();
    
         return Datatables::of($agentListCommission)
        ->addColumn('options',function($agentListCommission){
                return '<div class="text-center"><a href="'.route('listCommissionDetail',$agentListCommission->id).'" class="btn btn-secondary btn-sm mr-3">Detail Commission</a>';
         
        })->rawColumns(['options'])->make(true);
    }

    public function listCommissionDetail($id)
    {
        $agent = Agent::find($id)->first();
        $listCommissions = AgentProject::with(['commission'])->where('agent_id','=',$id)->get();
        return view('agent.agent-listCommission-detail',compact('agent','listCommissions'));
    }
    // public function getListCommission()
    // {
    //     $listCommission = DB::table('agents')
    //                     ->join('agent_projects','agents.id','=','agent_projects.agent_id')
    //                     ->join('agent_commissions','agent_projects.id','=','agent_commissions.agent_project_id')
    //                     ->get();
    //     return Datatables::of($listCommission)
    //     ->addColumn('options',function($listCommission){
    //             return '<div class="text-center"><a href="'.route('agentPayment',$listCommission->id).'" class="btn btn-secondary btn-sm mr-3">Bayar</a><a href="'.route('agentPaymentHistory',$listCommission->id).'" class="btn btn-secondary btn-sm mr-3">Riwayat Komisi</a></div>';
    //     })
    //     ->addColumn('status_bayar',function($listCommission){
    //         return '<span class="badge badge-danger">Belum dibayar</span>';
    //     })
    //     ->rawColumns(['options','status_bayar'])->make(true);
    // }

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

    public function paymentAgent($id)
    {
        //list of bank for payment
        $listBank = Bank::all();
        //get id agent that has project
        $agent    = DB::table('agents')
        ->join('agent_projects','agents.id','=','agent_projects.agent_id')
        ->join('agent_commissions','agent_projects.id','=','agent_commissions.agent_project_id')
        ->select('agents.id','agents.name','agents.username')
        ->where('agent_commissions.id','=',$id)->first();
        //find amount commission of agent by his id
        $agentCommission = AgentCommission::findorFail($id);
        //total commission agent that paid
        $totalCommission = 0;
        foreach ($agentCommission->commissionHistory as $commissionDetail){
            $totalCommission += $commissionDetail->amount;
        }
        // dd($totalCommission);
        return view('agent.agent-payment',compact('id','listBank','agent','agentCommission','totalCommission'));
    }

    public function storePaymentAgent($id_commission,Request $req)
    {
    
  
          $agent_commission_payment = new AgentCommissionPayment;
          $agent_commission_payment->agent_commission_id = $id_commission;
          $agent_commission_payment->bank_id =$req->bank;
          $agent_commission_payment->pay_date = date('Y-m-d', strtotime($req->pay_date)); 
          $agent_commission_payment->amount = $req->amount;
          if($req->hasFile('photo'))
          {
              $agentImage      = $req->file('photo');
              $fileName   =  $agentImage->getClientOriginalName();
              Storage::putFileAs('public/agentImage/agentPayment', $agentImage, $fileName);
              $agent_commission_payment->photo_evidance            = $fileName;
          }

          $agent_commission_payment->save();
          return redirect()->route('listCommission');


    }

    public function paymentHistory($id)
    {
      $agent_commission = AgentCommission::findorFail($id);
      $agent_commission_history = $agent_commission->commissionHistory;
      
      return view('agent.agent-payment-history', compact('agent_commission', 'agent_commission_history'));
    }
}
