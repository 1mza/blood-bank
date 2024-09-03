<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\UploadImageTrait;

class HomeController extends Controller
{
    use UploadImageTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function homeAdmin()
    {
//        $clients = Client::all(); ,compact('clients')
        return view('homeAdmin');
    }

    public function form(Request $request){
        return view('form');
    }
    public function formstore(Request $request){
        $image = $request->file('image');
        return $this->uploadImage($image,'posts');
    }
}
