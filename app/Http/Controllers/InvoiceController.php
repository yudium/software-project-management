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

        // call view that handle both payment method: Full Cash and Termin
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

        /**
         | Get invoice number to display in invoice; by increment last
         | invoice number in setting table.
         |
         | NOTE: if you just reload the invoice print web page, the invoice number
         |       will be incremented.
         | -----------------------------------------------------------*/
        $invoice_number = (int) \Setting::value('last_invoice_number');
        $invoice_number = 1 + $invoice_number;
        // save incremented invoice_number column value
        \Setting::change('last_invoice_number', $invoice_number);


        /**
         | Different logic depends on payment method value
         |
         | -----------------------------------------------------------*/

        // retrieve all input sent by form
        $input = $request->all();

        if ($project->payment_method == Project::PAYMENT_BY_FULLCASH) {
            return view('invoice.generate_fullcash', compact(
                'project',
                'input',
                'invoice_number',
                'bank'
            ));
        }
        if ($project->payment_method == Project::PAYMENT_BY_TERMIN) {
            /**
            | Get termin details that are selected by user in invoice form.
            | -----------------------------------------------------------*/
            $termin_details = TerminDetail::whereIn('id', $request->termin_detail_id)->get();

            /**
            | Sum all amount that already paid by client
            | -----------------------------------------------------------*/
            $total_paid_amount = 0;
            foreach ($project->termin->payments as $termin_payment) {
                $total_paid_amount += $termin_payment->amount;
            }

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
}
