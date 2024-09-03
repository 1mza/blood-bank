<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        try {
            $validatedData = $request->validate([
//            $validatedData = validator()->make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:clients',
                'password' => 'required|confirmed',
                'd_o_b' => 'required|date|before:today',
                'phone' => 'required',
                'last_donation_date' => 'required|date|before:today',
                'blood_type_id' => 'required|exists:blood_types,id',
                'governorate_id' => 'required|exists:governorates,id',
                'city_id' => 'required|exists:cities,id',
            ]);
            $validatedData['password'] = bcrypt($validatedData['password']);
//            $request->merge(['password' => bcrypt($request->password)]);
            $client = Client::create($validatedData);
            $client->api_token = Str::random(60);
            $client->save();
            $client->bloodTypes()->attach($request->blood_type_id);

            $client->governorates()->attach($request->governorate_id);
            return responseJson(1, "Client created successfully", [
                'api token' => $client->api_token,
                'client' => $client]);
        } catch (ValidationException $ex) {
            return responseJson(0, $ex->validator->errors()->first(), $ex->errors());
        }
    }

    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'phone' => 'required',
                'password' => 'required',
            ]);
            $client = Client::Where('phone', $validatedData['phone'])->first();
            if (!$client) {
                return responseJson(0, 'Invalid credentials', ['phone' => 'Phone number not found']);
            }
            if (!Hash::check($validatedData['password'], $client->password)) {
                return responseJson(0, 'Invalid credentials', ['password' => 'Password is incorrect']);
            }
            return responseJson(1, "Login successfully", [
                'api token' => $client->api_token,
                'client' => $client
            ]);
        } catch (ValidationException $ex) {
            return responseJson(0, $ex->validator->errors()->first(), $ex->errors());
        }
    }

    public function ResetPassword(Request $request)
    {
        try {
            $request->validate([
            'phone' => 'required|string'
        ]);
            $client = Client::where('phone', $request->phone)->first();
            if (!$client) {
                return response()->json([
                    'status' => 0,
                    'message' => 'User not found, please try again'
                ], 404);
            }
            $code = random_int(111111, 999999);
            $client->update([
                'pin_code' => $code,
                'pin_code_expires_at' => now()->addMinutes(10),
            ]);
            Mail::to($client->email)
                ->bcc('moab5090@gmail.com')
                ->send(new ResetPassword($code,$client));
            return response()->json([
                'status' => 1,
                'message' => 'Please check your email for pin code that is valid for 10 minutes',
                'pin code' => $code
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 0,
                'message' => 'Something went wrong, please try again',
                'error' => $ex->getMessage()
            ], 500);
        }
    }
    public function password(Request $request){
        try {
            $request->validate([
                'pin_code' => 'required',
                'password' => 'required|confirmed',
            ]);
            $client = Client::
                where('pin_code',$request->pin_code)->
                where('pin_code_expires_at','>',now())->
                first();
            if ( Client::
                where('pin_code',$request->pin_code)->
                where('pin_code_expires_at','<',now())->
                first()) {
                return responseJson(0,'Pin code has been expired');
            }
            if (!$client) {
                return responseJson(0,'Pin code is incorrect' );
            }
            $client->update([
                'password' => bcrypt($request->password),
                'pin_code' => NULL,
                'pin_code_expires_at' => NULL,
            ]);
            return responseJson(1,'Password updated successfully');
        }catch(\Exception $ex){
            return responseJson(0,'Something went wrong, please try again',$ex->getMessage());
        }
    }
    public function registerToken(Request $request){
        $validator = validator()->make($request->all,[
           'token' => 'required',
           'platform' => 'required|in:android,ios'
        ]);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first());
        }
        Token::where('token',$request->token)->delete();
        $request->user()->token()->create($request->all());
        return responseJson(1,'Token registered successfully');
    }
    public function removeToken(Request $request){
        $validator = validator()->make($request->all,[
            'token' => 'required',
        ]);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first());
        }
        Token::where('token',$request->token)->delete();
        return responseJson(1,'Token removed successfully');
    }
}
