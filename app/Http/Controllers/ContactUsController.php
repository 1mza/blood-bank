<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactUs;
use App\Models\Post;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use UploadImageTrait;
    public function __construct(){
        $this->middleware('permission:contact-us-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:contact-us-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:contact-us-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:contact-us-create',['only' => ['create','store'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact_us = ContactUs::all();
        return view('contact_us.index', compact('contact_us'));

    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//        $contact_us = ContactUs::findOrFail($id);
//        return view('contact_us.show', compact('contact_us'));
//    }

    public function create()
    {
        return view('contact_us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ContactUs::create($request->all());

        flash()->success('Contact Us created successfully.');
        return redirect()->route('contact-us.index');
    }

    public function edit(string $id)
    {
        $contact_us = ContactUs::findOrFail($id);
        return view('contact_us.edit', compact('contact_us'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact_us = ContactUs::findOrFail($id);

        $contact_us->update($request->all());
        flash()->success('Contact Us updated successfully.');
        return redirect()->route('contact-us.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact_us = ContactUs::findOrFail($id);
        $contact_us->delete();
        flash()->success('Contact Us deleted successfully.');
        return redirect()->route('contact-us.index');
    }
}
