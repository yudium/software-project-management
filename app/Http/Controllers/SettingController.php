<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use DataTables;

class SettingController extends Controller
{
    /**
     * Show list of setting
     */
    public function get()
    {
        return view('setting.list');
    }

    /**
     * Data for DataTable plugin, in setting list page
     */
    public function getAjax(Request $request)
    {
        $projects = Setting::all();

        return DataTables::of($projects)->make(true);
    }

    public function create()
    {
        return view('setting.create');
    }

    public function store(Request $request)
    {
        $setting = Setting::create($request->all());

        return redirect()->route('setting-list');
    }

    public function edit($name)
    {
        $setting = Setting::find($name);

        return view('setting.edit', compact('setting'));
    }

    public function update(Request $request, $name)
    {
        $setting = Setting::find($name);
        // I make input field for "name" column readonly. So actually,
        // only "value" that can be edited
        $setting->update($request->all());

        return redirect()->route('setting-list');
    }

    public function delete($name)
    {
        $setting = Setting::find($name);
        $setting->delete();

        return redirect()->route('setting-list')
            ->with('message', 'Berhasil menghapus')
            ->with('messageType', 'success');
    }
}
