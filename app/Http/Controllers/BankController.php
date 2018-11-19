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
        //TODO: only allow delete for bank that has no relation with others table.
        $bank = Bank::find($id);
        $bank->delete();

        return redirect()->route('bank-list')
            ->with('message', 'Berhasil menghapus')
            ->with('messageType', 'success');
    }
}
