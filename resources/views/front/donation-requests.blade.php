@extends('front.master')
@section('content')
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                    </ol>
                </nav>
            </div>

            <!--requests-->
            <div class="requests">
                <div class="head-text">
                    <h2>طلبات التبرع</h2>
                </div>
                <div class="content">
                    <form class="row filter" action="{{ route('DR-filter') }}" method="get">
                        @csrf
                        @method('GET')
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select name="blood_type" class="form-control" id="exampleFormControlSelect1">
                                        <option selected disabled>اختر فصيلة الدم</option>
                                        @foreach(\App\Models\BloodType::all() as $bloodType)
                                            <option
                                                value="{{$bloodType->id}}"{{ request('blood_type') == $bloodType->id ? 'selected' : '' }}>
                                                {{$bloodType->name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select name="city" class="form-control" id="exampleFormControlSelect1">
                                        <option disabled selected>اختر المدينة</option>
                                        @foreach(\App\Models\City::all() as $city)
                                            <option
                                                value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="patients">
                        @if(session()->has('alert-danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('alert-danger') }}
                            </div>
                        @elseif(session()->has('alert-success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('alert-success') }}
                            </div>
                        @endif
                        @if(!isset($donationRequests))
                            @foreach($requests as $request)
                                <div class="details">
                                    <div class="blood-type">
                                        <h2 dir="rtl">{{ $request->bloodType->name }}</h2>
                                    </div>
                                    <ul>
                                        <li><span>اسم الحالة:</span>{{ $request->patient_name }}</li>
                                        <li><span>مستشفى:</span>{{ $request->hospital }}</li>
                                        <li><span>المدينة:</span>{{ $request->city->name }}</li>
                                    </ul>
                                    <a href="{{ url('donation-requests/dr/' . $request->id) }}">التفاصيل</a>
                                </div>
                            @endforeach
                        @else
                            @if($donationRequests->isEmpty())
                                <h3>لم يتم العثور على طلبات التبرع لفصيلة الدم والمدينة المحددة.</h3>
                            @else
                                <div id="results-section">
                                    @foreach($donationRequests as $donationRequest)
                                        <div class="details">
                                            <div class="image">
                                                <h2 dir="rtl">{{ $donationRequest->bloodType->name }}</h2>
                                            </div>
                                            <ul>
                                                <li><span>اسم الحالة:</span>{{ $donationRequest->patient_name }}</li>
                                                <li><span>مستشفى:</span>{{ $donationRequest->hospital }}</li>
                                                <li><span>المدينة:</span>{{ $donationRequest->city->name }}</li>
                                            </ul>
                                            <a href="{{ url('donation-requests/dr/' . $donationRequest->id) }}">التفاصيل</a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="pages">
                        <nav aria-label="Page navigation example" dir="ltr">
                            @if(request()->is('donation-requests/filter') )
                                {{ $donationRequests->total() <= 10 ? null : $donationRequests->links() }}
                            @else
                                {{ $requests->total() <= 10 ? null : $requests->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
