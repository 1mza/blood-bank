<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Favorite;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MainController extends Controller
{
//    public function home(){
//        return view('front.home');
//    }
//    public function about(){
//        return view('front.about');
//    }


    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'sometimes|confirmed',
            'email' => Rule::unique('clients')->ignore($request->user()->id),
            'phone' => Rule::unique('clients')->ignore($request->user()->id),
            'city_id' => 'required',
        ]);
//        dd($validator->errors());
        $loginUser = auth('web-clients')->user();

        $loginUser->update($request->except('password'));
        if ($request->has('password')) {
            $request->passsword = $loginUser->password;
            $loginUser->save();

        }
        if ($request->has('governorate_id')) {
            $loginUser->governorates()->sync($request->governorate_id);
        }
        if ($request->has('blood_type_id')) {
            $loginUser->bloodTypes()->sync($request->blood_type_id);
        }
        return redirect()->route('profile')->with('alert-success', 'تم تحديث بياناتك بنجاح');
    }
//    public function updateProfile(Request $request)
//    {
//        $rules = [
//            'name' => 'sometimes|string|max:255',
//            'email' => ['sometimes', 'email', Rule::unique('clients')->ignore($request->user()->id)],
//            'password' => 'sometimes|confirmed',
//            'd_o_b' => 'sometimes|date|before:today',
//            'last_donation_date' => 'sometimes|date|before:today',
//            'blood_type_id' => 'sometimes|exists:blood_types,id',
//            'governorate_id' => 'sometimes|exists:governorates,id',
//            'city_id' => 'required|exists:cities,id',
//        ];
//        $validator = Validator::make($request->all(), $rules);
//        if ($validator->fails()) {
//            return redirect()->route('update-profile')->with('alert-danger', 'حدث خطأ ما، حاول مرة أخرى.');
//        }
//        $loginUser = auth('web-clients')->user();
//        $data = $request->except('password_confirmation');
//
//        if ($request->filled('password')) {
//            $data['password'] = bcrypt($request['password']);
//        } else {
//            unset($data['password']);
//        }
//
//        $loginUser->update($data);
//        if ($request->has('governorate_id')) {
//            $loginUser->governorates()->sync([$request->governorate_id]);
//        }
//        if ($request->has('blood_type_id')) {
//            $loginUser->bloodTypes()->sync([$request->blood_type_id]);
//        }
//        return redirect()->route('profile')->with('alert-success', 'تم تحديث بياناتك بنجاح');
//    }


    public function sendContacts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('contact-us')->with('alert-danger', 'حدث خطأ ما، حاول مرة أخرى.');
        }
        Contact::create($request->all());
        return redirect()->route('contact-us')->with('alert-success', 'تم إرسال الرسالة بنجاح.');
    }

    public function articles()
    {
        $favorites = auth('web-clients')->user()->favourites;
        $posts = Post::latest()->paginate(10);

        return view('front.articles', compact('posts', 'favorites'));
    }

    public function favorites()
    {
        $favorites = Favorite::where('client_id', auth('web-clients')->user()->id)
            ->with('post')->paginate(10);

        return view('front.favorites', compact('favorites'));
    }

    public function article(int $id)
    {
        $post = Post::findOrFail($id);
        return view('front.article-details', compact('post'));
    }

    public function donationRequests()
    {
        $requests = DonationRequest::latest()->paginate(10);
        return view('front.donation-requests', compact('requests'));
    }

    public function donationRequestDetails(int $id)
    {
        $donationRequest = DonationRequest::findOrFail($id);
        return view('front.inside-request', compact('donationRequest'));
    }

    public function storeRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput()
                ->with('alert-danger', 'حدث خطأ ما، حاول مرة أخرى.');
        }
        $user_id = auth('web-clients')->user()->id;
        DonationRequest::create([
            'patient_name' => $request->patient_name,
            'patient_age' => $request->patient_age,
            'blood_type_id' => $request->blood_type_id,
            'bags_num' => $request->bags_num,
            'hospital' => $request->hospital,
            'hospital_address' => $request->hospital_address,
            'details' => $request->details,
            'city_id' => $request->city_id,
            'patient_phone' => $request->patient_phone,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'client_id' => $user_id
        ]);
        return redirect()->route('donation-requests')->with('alert-success', 'تم إضافة الطلب بنجاح.');

    }

    public function filter(Request $request)
    {
        $request->validate([
            'blood_type' => 'exists:blood_types,id',
            'city' => 'exists:cities,id',
        ]);
        $donationRequests = DonationRequest::query();

        if ($request->filled('blood_type')) {
            $donationRequests->where('blood_type_id', $request->blood_type);
        }

        if ($request->filled('city')) {
            $donationRequests->where('city_id', $request->city);
        }
        $donationRequests = $donationRequests->latest()->paginate(4);
        return view('front.home', compact('donationRequests'));
    }

    public function donationRequestsFilter(Request $request)
    {
        $request->validate([
            'blood_type' => 'exists:blood_types,id',
            'city' => 'exists:cities,id',
        ]);

        $donationRequests = DonationRequest::query();

        if ($request->filled('blood_type')) {
            $donationRequests->where('blood_type_id', $request->blood_type);
        }

        if ($request->filled('city')) {
            $donationRequests->where('city_id', $request->city);
        }
        $donationRequests = $donationRequests->latest()->paginate(10);
        $requests = DonationRequest::latest()->paginate(10);


        return view('front.donation-requests', compact('donationRequests', 'requests'));
    }

}
