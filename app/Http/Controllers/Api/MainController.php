<?php

namespace App\Http\Controllers\Api;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use Dotenv\Validator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    public function governorates(){
        $governorates = Governorate::all();
        return responseJson(1,'success',$governorates);
    }
    public function cities(Request $request){
        $cities = City::when($request->governorate_id,
            function($query){
                $query->where('governorate_id',request('governorate_id'));
            })->get();
        return responseJson(1,'success',$cities);
    }
    public function posts(Request $request){
        $posts = Post::when($request->category_id,
            function($query){
                $query->where('category_id',request('category_id'));
            })->with('category')->get();
        return responseJson(1,'success',$posts);
    }

    public function profile(Request $request){
        try {
            $request->validate([
                'password' => 'confirmed',
//                'blood_type_id' => 'array',
                'email' => Rule::unique('clients')->ignore($request->user()->id),
                'phone' => Rule::unique('clients')->ignore($request->user()->id),
            ]);
            $loginUser = $request->user();
            if ($request->has('password')) {
                $request->merge([$request->password => bcrypt($request->password)]);
            }
            $loginUser->update([$request->all()]);
            $loginUser->save();
            if ($request->has('governorate_id')){
                $loginUser->governorates()->sync($request->governorate_id);
            }
            if ($request->has('blood_type_id')){
                $loginUser->bloodTypes()->sync($request->blood_type_id);
            }
            return responseJson(1, 'Profile updated successfully');

        }catch(\Exception $ex){
            return responseJson(0,$ex->getMessage());
        }
    }
    public function postFavourite(Request $request){
        $rules = [
            'post_id' => 'required|exists:posts,id',
        ];
        $validator = validator()->make($request->all(),$rules);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $toggle = $request->user()->favourites()->toggle($request->post_id);
        return responseJson(1,'success',$toggle);
    }

    public function myFavourites(Request $request){
        $posts = $request->user()->favourites()->latest()->paginate(10);
        return responseJson(1,'Loaded...',$posts);
    }
    public function donationRequestCreate(Request $request){
        $validator = $request->validate( [
            'patient_name' => 'required',
            'patient_age' => 'required|digits:2',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required|digits:1',
            'hospital' => 'required',
            'hospital_address' => 'required',
            'details' => 'required',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => 'required|digits:11',
            'longitude' => 'required',
            'latitude' => 'required',
            ]);
        $donationRequest = $request->user()->donationRequests()->create($validator);
        $clientsIds = Client::whereHas('governorates',function($query)  use($donationRequest){
            $query->where('governorate_id',$donationRequest->city->governorate_id);
        })->whereHas('bloodTypes',function($query) use($donationRequest){
            $query->where('blood_type_id',$donationRequest->blood_type_id);
        })->pluck('id')->toArray();
        if (count($clientsIds)){
            $notification = $donationRequest->notifications()->create([
                'title' => 'أحتاج متبرع للدم',
                'content' => $donationRequest->blood_type.'انا في مستشفي القصر العيني'
            ]);
            $notification->clients()->attach($clientsIds);
            $tokens = Token::whereIn('client_id', $clientsIds)->where('token','!=','null')->pluck('token')->toArray();
            if (count($tokens)){
                $title = $notification->title;
                $content = $notification->content;
                $data = [
                    'donation_request_id' => $donationRequest->id
                ];
                info(json_encode($data));
                $send = notifyByFirebase($title,$content,$tokens,$data);
                info('Firebasse result',$send);
            }
        }
        return responseJson(1,'Added Successfully',$donationRequest);

    }

    public function contacts(Request $request){
        try {
            $data = $request->validate([
                'subject' => 'required',
                'message' => 'required',
            ]);
            $contact = $request->user()->contacts()->create($data);
            return responseJson(1, 'Message sent successfully', $contact);
        } catch (\Exception $ex) {
            return responseJson(0, $ex->getMessage());
        }
    }

    public function settings(){
        $settings = Setting::all();
        return responseJson(1,'success',$settings);
    }

}
