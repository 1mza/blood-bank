<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Post;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use UploadImageTrait;
    public function __construct(){
        $this->middleware('permission:contacts-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:contacts-lists',['only' => ['index','show'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        flash()->success('Message deleted successfully.');
        return redirect()->route('contacts.index');
    }
}
