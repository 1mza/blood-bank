<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use App\Models\Governorate;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    public function __construct(){
        $this->middleware('permission:donation-requests-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:donation-requests-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:donation-requests-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:donation-requests-create',['only' => ['create','store'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donation_requests = DonationRequest::all();
        return view('donation-requests.index', compact('donation_requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donation-requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'patient_name' => 'required',
            'patient_age' => 'required|digits:2',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required|digits:1',
            'hospital' => 'required',
            'hospital_address' => 'required',
            'details' => 'required',
            'client_id' => 'required|exists:clients,id',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => 'required|digits:11',
            'longitude' => 'required',
            'latitude' => 'required',
        ];
        $messages = [
            'name.required' => 'Name is required.',
        ];
        $this->validate($request,$rules,$messages);
        $donation_request = DonationRequest::create($request->all());
        flash()->success('Donation Request created successfully.');
        return redirect()->route('donation-requests.show',compact('donation_request'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donation_request = DonationRequest::findOrFail($id);

        return view('donation-requests.show', compact('donation_request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donation_request = DonationRequest::findOrFail($id);

        return view('donation-requests.edit', compact('donation_request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'patient_name' => 'required',
            'patient_age' => 'required|digits:2',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required|digits:1',
            'hospital' => 'required',
            'hospital_address' => 'required',
            'details' => 'required',
            'client_id' => 'required|exists:clients,id',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => 'required|digits:11',
            'longitude' => 'required',
            'latitude' => 'required',
        ];
        $messages = [
            'name.required' => 'Name is required.',
        ];
        $this->validate($request,$rules,$messages);
        $donation_request = DonationRequest::findOrFail($id);
        $donation_request->update($request->all());
        flash()->success('Donation Request updated successfully.');
        return redirect()->route('donation-requests.show',$donation_request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donation_request = DonationRequest::findOrFail($id);
        $donation_request->delete();
        flash()->success('Donation Request deleted successfully.');
        return redirect()->route('donation-requests');
    }
}
