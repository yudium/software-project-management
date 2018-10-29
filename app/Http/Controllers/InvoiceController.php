<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Bank;
use App\TerminDetail;

class InvoiceController extends Controller
{
    /**
     * Form for input data that will be used by generated invoice
     */
    public function form($project_id)
    {
        $project = Project::find($project_id);
        $client = $project->client;

        $banks = Bank::all();

        return view('invoice.form', compact('project', 'client', 'banks', 'termin_details'));
    }

    /**
     * Generate invoice
     * 
     */
    public function generate(Request $request, $project_id)
    {
        // get project data
        $project = Project::find($project_id);

        // get bank data
        $bank = Bank::find($request->bank);

        // NOTE: if you reload the invoice print web page, the invoice number
        //       will be incremented.

        // the invoice table only contains one record with one column
        $invoice_table = \DB::table('invoice')->first();
        // increment invoice_number
        $invoice_number = 1 + $invoice_table->invoice_number;
        // save incremented invoice_number column value
        \DB::table('invoice')->update(['invoice_number' => $invoice_number]);

        // get all termin_details that selected by user in the form
        $termin_details = TerminDetail::whereIn('id', $request->termin_detail_id)->get();

        // sum *all* amount that already paid by client
        $total_paid_amount = 0;
        foreach ($project->termin->payments as $termin_payment) {
            $total_paid_amount += $termin_payment->amount;
        }

        // retrieve all input sent by form
        $input = $request->all();

        return view('invoice.generate', compact(
            'project',
            'input',
            'total_paid_amount',
            'termin_details',
            'invoice_number',
            'bank'
        ));
    }
}
