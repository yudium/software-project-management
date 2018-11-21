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
     /**
     * Create termin for project X
     *
     * NOTE: this method intended to only accessed by redirection from
     *       ProjectController activationStep3() method.
     *
     *       Since creating termin only done when activating project.
     */
    public function create($project_id)
    {
        $project = Project::find($project_id);

        return view('termin.create', compact('project'));
    }

    /**
     * Store termin data to database
     *
     */
    public function store(Request $request)
    {
        /**
         *  The form doesn't send input in convenient format, so I need to convert it here.
         * 
         *  Target format:
         *      [
         *          serial_number,
         *          due_date,
         *          amount,
         *      ]
         */
        $termin_detail = [];                            // new format
        $old_termin_detail = $request->termin_detail;   // old format that sent by form
        // debt_amount just representative number of element
        for ($i = 0; $i < count($old_termin_detail['debt_amount']); $i++) {
            // just aliasing, more shorter
            $due_date = $old_termin_detail['due_date'];

            array_push($termin_detail, [
                // because it zero-indexed so increment by 1 to get serial number
                // the order of termin_detail is important to `serial_number`
                'serial_number' => $i + 1,
                'due_date' => sprintf('%s-%s-%s', $due_date['year'][$i], $due_date['month'][$i], $due_date['day'][$i]),
                'amount' => $old_termin_detail['debt_amount'][$i],
            ]);
        }

        // set the payment method
        $project = Project::find($request->project_id);
        $project->payment_method = Project::PAYMENT_BY_TERMIN;
        $project->save();

        // new termin record for the project is stored to database
        $termin = new Termin;
        $termin->periodic_type = $request->periodic_type;
        $termin->project()->associate($project); // termin has relation to project
        $termin->paid_off = Termin::IS_NOT_PAID_OFF;
        $termin->save();

        // the detail of termin is stored to database, like `amount` and `due_date`
        $termin->details()->createMany($termin_detail);

        /**
         | Activate project after termin created
         |
         | NOTE: since create termin only done when activating project.
         | ------------------------------------------------------------- */
        return redirect()->route('project-activation-step4', [
            'id' => $project->id,
            'choice' => \App\Project::PAYMENT_BY_TERMIN,
        ]);
    }

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

        // jumlahkan semua uang yang sudah dibayar di termin_detail_id terkait
        $total_paid_amount = 0;
        foreach ($termin_detail->termin_payments as $termin_payment) {
            $total_paid_amount += $termin_payment->amount;
        }

        return view('termin.payment-form', compact('project', 'client', 'termin_detail', 'banks', 'total_paid_amount'));
    }

    public function storePayment(Request $request, $termin_detail_id)
    {
        // get termin_detail data
        $termin_detail = TerminDetail::find($termin_detail_id);

        // get bank data
        $bank = Bank::find($request->bank);

        /**
         | Store
         |
         | ----------------------------------------------------------- */
        $termin_payment = new TerminPayment;

        // If payment is cash; not transfer we know that by null value in DB
        if ($request->bank == 'cash') {
            // then we know that $termin_payment->bank_id will be null
        } else {
            $termin_payment->bank()->associate($bank); // termin_payment has relation to bank
        }

        $termin_payment->termin_detail()->associate($termin_detail); // termin_payment has relation to termin_detail
        // increment serial number for this termin_payment
        $termin_payment->serial_number = 1 + getCurrentSerialNumberForTerminPayment($termin_detail_id);
        $termin_payment->pay_date = date('Y-m-d', strtotime($request->pay_date)); // convert date to mysql format
        $termin_payment->amount = $request->amount;

        // TODO: The term 'photo' here is not suitable. Change to other term. Maybe proof?
        if ($request->has('photo')) {
            // store photo to storage in public directory
            $request->photo->store('termin_photos', 'public');
            // save photo path to db column
            $termin_payment->photo_evidance = $request->photo->hashName();
        }

        $termin_payment->save();


        /**
         | Mark termin as paid off (lunas)
         |
         | ----------------------------------------------------------- */
        $termin = $termin_detail->termin;

        $paid_off = true;
        /**
         * iterate over all termin detail and check one-by-one if each of detail
         * is paid off
         *
         * NOTE: $termin_detail already defined so I use $detail
         */
        foreach ($termin->details as $detail) {
            if ($detail->paid_amount != $detail->amount) {
                $paid_off = false;
            }
        }
        if ($paid_off) {
            $termin->paid_off = Termin::IS_PAID_OFF;
            $termin->save();
        }


        /**
         | Footer code
         |
         | ----------------------------------------------------------- */
        $project = $termin_detail->termin->project;

        return redirect()->route('termin-list', ['project_id' => $project->id]);
    }

    public function paymentHistory($termin_detail_id)
    {
        $termin_detail = TerminDetail::find($termin_detail_id);
        $termin_payments = $termin_detail->termin_payments;

        return view('termin.payment-history', compact('termin_detail', 'termin_payments'));
    }
}
