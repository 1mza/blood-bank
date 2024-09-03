@extends('front.master')
@section('content')
    @section('classname')
        contact-us
    @endsection

    <!--contact-us-->
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                    </ol>
                </nav>
            </div>
            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>اتصل بنا</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="{{asset('front/imgs/logo.png')}}">
                            </div>
                            <div class="details">
                                <ul>
                                    <li class="phone" ><span >الجوال:</span><span dir="ltr">{{$contact_us->phone}}</span></li>
{{--                                    <li><span>فاكس:</span> 234234234</li>--}}
                                    <li><span>البريد الإلكترونى:</span>{{$contact_us->email}}</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>تواصل معنا</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="{{$contact_us->facebook_link}}"><img src="{{asset('front/imgs/001-facebook.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$contact_us->x_link}}"><img src="{{asset('front/imgs/002-twitter.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$contact_us->youtube_link}}"><img src="{{asset('front/imgs/003-youtube.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$contact_us->instagram_link}}"><img src="{{asset('front/imgs/004-instagram.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$contact_us->whatsapp_link}}"><img src="{{asset('front/imgs/005-whatsapp.svg')}}"></a>
                                    </div>
{{--                                    <div class="out-icon">--}}
{{--                                        <a href="#"><img src="imgs/006-google-plus.svg"></a>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4>تواصل معنا</h4>
                        </div>
                        <div class="fields">
                            <form method="post" action="{{route('send-contacts')}}">
                                @if(session()->has('alert-danger'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('alert-danger') }}
                                    </div>
                                @elseif(session()->has('alert-success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('alert-success') }}
                                    </div>
                                @endif
                                @csrf
                                @method('POST')
                                <input type="text"  class="form-control" id="exampleFormControlInput1"
                                       placeholder="الإسم" name="name">
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                       placeholder="البريد الإلكترونى" name="email">
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                       placeholder="الجوال" name="phone">
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                       placeholder="عنوان الرسالة" name="subject">
                                <textarea placeholder="نص الرسالة" class="form-control" id="exampleFormControlTextarea1"
                                          rows="3" name="message"></textarea>
                                <button type="submit">ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
