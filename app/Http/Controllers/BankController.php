<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Bank;

class BankController extends Controller
{
    /**
     * Show list of bank
     */
    public function get()
    {
        return view('bank.list');
    }

    /**
     * Data for DataTable plugin, in bank list page
     */
    public function getAjax(Request $request)
    {
        $banks = Bank::all();

        return DataTables::of($banks)->make(true);
    }

    public function create(Request $request)
    {
        return view('bank.create');
    }

    public function store(Request $request)
    {
        $bank = Bank::create($request->all());

        return redirect()->route('bank-list');
    }

    public function delete($id)
    {
        $bank = Bank::find($id);

        if ( ($bank->termin_payments->count() > 0) OR
             ($bank->agent_commissions->count() > 0) ) {
            abort(405, 'This bank has relation with termin payments tables or/and agent commissions. You should delete all these relation before delete.');
        }

        $bank->delete();

        return redirect()->route('bank-list')
            ->with('message', 'Berhasil menghapus')
            ->with('messageType', 'success');
    }
}
