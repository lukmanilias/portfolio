<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = GeneralSetting::first();
        return view('admin.setting.general-setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['required', 'max:5000', 'image'],
            'footer_logo' => ['required', 'max:5000', 'image'],
            'favicon' => ['required', 'max:5000', 'image'],
        ]);

        $setting = GeneralSetting::first();
        $logo_path = handleUpload('logo', $setting);
        $footer_logo_path = handleUpload('footer_logo', $setting);
        $favicon_path = handleUpload('favicon', $setting);



        GeneralSetting::updateOrcreate([
            'id' => $id,
        ], [
            'logo' => (!empty($logo_path)) ? $logo_path : $setting->logo,
            'footer_logo' => (!empty($footer_logo_path)) ? $footer_logo_path : $setting->footer_logo,
            'favicon' => (!empty($favicon_path)) ? $favicon_path : $setting->favicon,
        ]);

        toastr()->success('Updated successfully', 'Congrats!');
        return redirect()->route('admin.general-setting.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
