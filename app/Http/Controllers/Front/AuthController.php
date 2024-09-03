<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function Laravel\Prompts\password;

class AuthController extends Controller
{
//    public function viewRegister()
//    {
//        return view('front.create-account');
//    }

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:clients',
                'phone' => 'required',
                'd_o_b' => 'required|date|before:today',
                'password' => 'required|confirmed',
                'blood_type_id' => 'required|exists:blood_types,id',
                'governorate_id' => 'required|exists:governorates,id',
                'city_id' => 'required|exists:cities,id',
                'last_donation_date' => 'required|date|before:today',
            ]);
            $validatedData['password'] = bcrypt($validatedData['password']);
            $client = Client::create($validatedData);
            $client->api_token = Str::random(60);
            $client->save();
            $client->bloodTypes()->attach($request->blood_type_id);
            $client->governorates()->attach($request->governorate_id);
            auth('web')->login($client);
            return redirect('/');

        } catch (\Exception $exception) {
            return responseJson(0, $exception->getMessage());
        }
    }

//    public function viewLogin()
//    {
//        return view('front.signin-account');
//    }

    public function login(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);
        if ($validatedData->fails()) {
            return redirect('v-sign-in')->with('alert', 'Please enter your credentials.');
        }
        $client = Client::where('phone', $request->phone)->first();
        if (!$client) {
            return redirect('v-sign-in')->with('alert', 'رقم الهاتف المحمول الذي أدخلته غير مرتبط بحساب.');
        }
        if (!Hash::check($request->password, $client->password)) {
            return redirect('v-sign-in')->with('alert-danger', 'كلمة السر غير صحيحة.');
        }
        if (auth('web-clients')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->has('remember_token'))) {
            return redirect('/')->with('alert-success', 'Logged in successfully');
        }
        return redirect('v-sign-in')->with('alert-danger', 'فشلت عملية تسجيل الدخول, حاول مرة اخري.');
    }

    public function signout(){
        if(auth('web-clients')->check()){
            auth('web-clients')->logout();
            return redirect('v-sign-in')->with('alert-success', 'تم تسجيل خروجك بنجاح');
        }else{
            abort(403);
        }
    }

}
