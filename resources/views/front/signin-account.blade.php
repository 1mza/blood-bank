@if(!auth('web-clients')->check())
    @extends('front.master')
    @section('content')
        @section('classname')
            signin-account
        @endsection

        <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                        </ol>
                    </nav>
                </div>
                <div class="signin-form">

                    <form method="post" id="my_form" action="{{route('sign-in')}}">
                        @csrf
                        @method('POST')
                        <div class="logo">
                            <img src="{{asset('front/imgs/logo.png')}}">
                        </div>
                        @if(session()->has('alert-danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('alert-danger') }}
                            </div>
                        @elseif(session()->has('alert-success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('alert-success') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" placeholder="الجوال">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                   placeholder="كلمة المرور">
                        </div>
                        <div class="row options">
                            <div class="col-md-6 remember">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="remember_token" class="form-check-input"
                                           id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                                </div>
                            </div>
                            <div class="col-md-6 forgot">
                                <img src="{{asset('front/imgs/complain.png')}}">
                                <a href="#">هل نسيت كلمة المرور</a>
                            </div>
                        </div>
                        <div class="row buttons">
{{--                            <div class="col-md-6 right">--}}
{{--                                <input type="submit" value="دخول">--}}
{{--                            </div>--}}
                                                        <div class="col-md-6 right">
                                                            <a  onclick="document.getElementById('my_form').submit();">دخول</a>
                                                        </div>
                            <div class="col-md-6 left">
                                <a href="/v-sign-up">انشاء حساب جديد</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endsection
@else
    {{abort(404)}}
@endif

