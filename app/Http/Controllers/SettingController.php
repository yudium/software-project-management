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
        $settings = Setting::all();

        return DataTables::of($settings)->make(true);
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
        // TODO: some setting is shouldn't deleted like trello_api_key or it
        //       will raise error in some application page. My idea is add boolean column
        //      'permanent' then don't delete setting that this column value is true.
        $setting = Setting::find($name);
        $setting->delete();

        return redirect()->route('setting-list')
            ->with('message', 'Berhasil menghapus')
            ->with('messageType', 'success');
    }
}
