<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Termin;
use App\TerminDetail;
use App\TerminPayment;
use App\Bank;

class TerminController extends Controller
{
    public function get($project_id)
    {
        $project = Project::find($project_id);
        $termin_details = $project->termin->details;
        $client = $project->client;

        return view('termin.list', compact('project', 'client', 'termin_details'));
    }

    public function paymentForm($termin_detail_id)
    {
        $termin_detail = TerminDetail::find($termin_detail_id);
        $project = $termin_detail->termin->project;
        $client = $project->client;
        $banks = Bank::all();

        return view('termin.payment-form', compact('project', 'client', 'termin_detail', 'banks'));
    }

    public function paymentFormPost(Request $request, $termin_detail_id)
    {
        $termin_detail = TerminDetail::find($termin_detail_id);
        $bank = Bank::find($request->bank);

        $termin_payment = new TerminPayment;
        $termin_payment->pay_date = date('Y-m-d', strtotime($request->pay_date));
        $termin_payment->amount = $request->amount;
        $request->photo->store('termin_photos', 'public');
        $termin_payment->photo_evidance = $request->photo->hashName();
        $termin_payment->bank()->associate($bank);
        $termin_payment->termin_detail()->associate($termin_detail);
        $termin_payment->save();
    }

    public function paymentHistory($termin_detail_id)
    {
        $termin_detail = TerminDetail::find($termin_detail_id);
        $termin_payments = $termin_detail->termin_payments;

        return view('termin.payment-history', compact('termin_detail', 'termin_payments'));
    }
}
