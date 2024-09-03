@use('App\Models\Post','Post')
@use('App\Models\BloodType','BloodType')
@use('App\Models\City','City')
@extends('front.master-ltr')
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
                    <div class="container-info" style="height: 100%;
    display: flex;
    align-items: center;
    margin-left: 50px;
    justify-content: left; /* Align the text on the left side for English */
    text-align: left; /* Ensure text alignment is to the left */
    font-size: medium" dir="ltr">
                        <div class="col-lg-5">
                            <h3 class="h3" style="color: #a70f14; font-weight: 700;">Blood bank moving forward to better
                                health</h3>
                            <p style="color: #2d3e50;
    font-weight: 600;
    font-size: 23px;
    line-height: 2;
    margin-bottom: 40px;">{{$settings->intro_text_en_1}}</p>
                            <a style="color: #FFF;
    background-color: #2d3e50;
    padding: 8px 70px;
    text-decoration: none;" href="{{url('about')}}">more</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">
                    <div class="container-info" style="height: 100%;
    display: flex;
    align-items: center;
        margin-left: 50px;
    justify-content: left; /* Align the text on the left side for English */
    text-align: left; /* Ensure text alignment is to the left */
    font-size: medium" dir="ltr">
                        <div class="col-lg-5">
                            <h3 class="h3" style="color: #a70f14; font-weight: 700;">Blood bank moving forward to better
                                health</h3>
                            <p style="color: #2d3e50;
    font-weight: 600;
    font-size: 23px;
    line-height: 2;
    margin-bottom: 40px;">{{$settings->intro_text_en_2}}</p>
                            <a style="color: #FFF;
    background-color: #2d3e50;
    padding: 8px 70px;
    text-decoration: none;" href="{{url('about')}}">more</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">
                    <div class="container-info" style="height: 100%;
    display: flex;
    align-items: center;
        margin-left: 50px;

    justify-content: left; /* Align the text on the left side for English */
    text-align: left; /* Ensure text alignment is to the left */
    font-size: medium" dir="ltr">
                        <div class="col-lg-5">
                            <h3 class="h3" style="color: #a70f14; font-weight: 700;">Blood bank moving forward to better
                                health</h3>
                            <p style="color: #2d3e50;
    font-weight: 600;
    font-size: 23px;
    line-height: 2;
    margin-bottom: 40px;">{{$settings->intro_text_en_3}}</p>
                            <a style="color: #FFF;
    background-color: #2d3e50;
    padding: 8px 70px;
    text-decoration: none;" href="{{url('about')}}">more</a>
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
                    <span>Blood Bank</span> {{$settings->about_app_en}}
                </p>
            </div>
        </div>
    </div>

    <!--articles-->
    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">
                <h2>Articles</h2>
            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel articles-carousel">
                        @foreach(Post::take(4)->get() as $post)
                            <div class="card" style="width: 350px; height: 400px;">
                                <div class="photo">
                                    <img width="347.73" height="230.26" src="{{ asset('images/'.$post->image) }}"
                                         class="card-img-top" alt="...">
                                    <a href="{{url('posts/'.$post->id)}}" class="click">المزيد</a>
                                </div>
                                <a href="#" class="favourite">
                                    <i class="far fa-heart"></i>
                                </a>
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
                <h2>Donation requests</h2>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <form class="row filter">
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" id="exampleInputBloodType" name="blood_type_id">
                                    <option selected disabled hidden value="">فصيلة الدم</option>
                                    @foreach(BloodType::all() as $bloodType)
                                        <option value="{{$bloodType->name}}">{{$bloodType->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 city">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" id="cities" name="city_id">
                                    <option selected disabled hidden value="">المدينة</option>
                                    @foreach(City::all() as $city)
                                        <option value="1">{{$city->name}}</option>
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
                    @foreach(\App\Models\DonationRequest::take(4)->latest()->get() as $donationRequest)
                    <div class="details">
                        <div class="blood-type">
                            <h2 dir="ltr">{{$donationRequest->bloodType->name}}</h2>
                        </div>
                        <ul>
                            <li><span>Patient name:</span>{{$donationRequest->patient_name}}</li>
                            <li><span>Hospital:</span>{{$donationRequest->hospital}}</li>
                            <li><span>City:</span> {{$donationRequest->city->name}}</li>
                        </ul>
                        <a href="{{route('donation-request-details')}}">Details</a>
                    </div>
                    @endforeach
                </div>
                <div class="more">
                    <a href="donation-requests-ltr.html">More</a>
                </div>
            </div>
        </div>
    </div>

    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>Contact us</h3>
                </div>
                <p class="text">You can contact us to inquire about information and you will be answered</p>
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
                    <h3>Blood bank app</h3>
                    <p>{{$settings->promoting_text_en}}</p>
                    <div class="download">
                        <h4>Available on</h4>
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

    <!--footer-->
@endsection
