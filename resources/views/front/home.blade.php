@use('App\Models\Post','Post')
@extends('front.master')
@section('content')
    <!--intro-->
    <div class="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-1 active">
                    <div class="container info" id="div">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>{{$settings->intro_text_ar_1}}</p>
                            <a href="{{url('about')}}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">
                    <div class="container info" id="div">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>{{$settings->intro_text_ar_2}}</p>
                            <a href="{{url('about')}}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">
                    <div class="container info" id="div">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>{{$settings->intro_text_ar_3}}</p>
                            <a href="{{url('about')}}">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about-->
    <div class="about">
        <div class="container">
            <div class="col-lg-6 text-center">
                <p>
                    <span>بنك الدم</span> {{$settings->about_app_ar}}
                </p>
            </div>
        </div>
    </div>

    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">
                <h2>المقالات</h2>
            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel articles-carousel">


                        @foreach(Post::all() as $post)
                            <div class="card" style="width: 350px; height: 400px;">
                                <div class="photo">
                                    <img width="347.73" height="230.26" src="{{ asset('images/'.$post->image) }}"
                                         class="card-img-top" alt="...">
                                    <a href="{{ url('articles/'.$post->id) }}" class="click">المزيد</a>
                                </div>
                                @livewire('post-like', ['post' => $post])

                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->detailed_title }}</p>
                                </div>
                            </div>
                        @endforeach


                        <div class="card">
                            <div class="photo">
                                <img src="{{asset('front/imgs/p2.jpg')}}" class="card-img-top" alt="...">
                                <a href="article-details.html" class="click">المزيد</a>
                            </div>
                            <a href="#" class="favourite">
                                <i class="far fa-heart"></i>
                            </a>

                            <div class="card-body">
                                <h5 class="card-title">طريقة الوقاية من الأمراض</h5>
                                <p class="card-text">
                                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد
                                    النص العربى،
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--requests-->
    <div class="requests">
        <div class="container">
            <div class="head-text">
                <h2>طلبات التبرع</h2>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <form class="row filter" action="{{ route('filter') }}" method="get">
                    @csrf
                    @method('GET')
                    <input type="hidden" name="scroll" value="true">
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
                    @if(!isset($donationRequests))
                        @foreach(\App\Models\DonationRequest::take(4)->latest()->get() as $donationRequest)
                            <div class="details">
                                <div class="blood-type">
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
                    @elseif(request()->is('filter'))
                        @if($donationRequests->isEmpty())
                            <p>No donation requests found for the selected blood type and city.</p>
                        @else
                            <div id="results-section">
                                @foreach($donationRequests as $donationRequest)
                                    <div class="details">
                                        <div class="blood-type">
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
                <div class="more">
                    <a href="{{url('/donation-requests')}}">المزيد</a>
                </div>
            </div>
        </div>
    </div>

    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>اتصل بنا</h3>
                </div>
                <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
                <div class="row whatsapp">
                    <a target="_blank" href="{{$contact_us->whatsapp_link}}">
                        <img src="{{asset('front/imgs/whats.png')}}">
                        <p dir="ltr">{{$contact_us->phone}}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--app-->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>تطبيق بنك الدم</h3>
                    <p>{{$settings->promoting_text_ar}}</p>
                    <div class="download">
                        <h4>متوفر على</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a target="_blank" href="{{$contact_us->android_app_link}}">
                                    <img src="{{asset('front/imgs/google.png')}}">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a target="_blank" href="{{$contact_us->apple_app_link}}">
                                    <img src="{{asset('front/imgs/ios.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src="{{asset('front/imgs/App.png')}}">
                </div>
            </div>
        </div>
    </div>

@endsection
