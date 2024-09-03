<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactUs;
use App\Models\Post;
use App\Models\Setting;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use UploadImageTrait;
    public function __construct(){
        $this->middleware('permission:settings-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:settings-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:settings-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:settings-create',['only' => ['create','store'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::paginate(10);
        return view('settings.index', compact('settings'));
    }

    /**
     * Display the specified resource.
     */


    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Setting::create($request->all());

        flash()->success('Settings Us created successfully.');
        return redirect()->route('settings.index');
    }

    public function edit(string $id)
    {
        $settings = Setting::findOrFail($id);
        return view('settings.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $settings = Setting::findOrFail($id);

        $settings->update($request->all());
        flash()->success('Settings updated successfully.');
        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $settings = Setting::findOrFail($id);
        $settings->delete();
        flash()->success('Settings deleted successfully.');
        return redirect()->route('settings.index');
    }
}
