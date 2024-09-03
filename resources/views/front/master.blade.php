<!doctype html>
<html lang="en" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
          integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="{{asset('front/imgs/Icon.png')}}">

    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{asset('front/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/owl.theme.default.min.css')}}">

    <!--style css-->
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
    <title>Blood Bank</title>
    @livewireStyles
</head>
<body class="@yield('classname')">
<!--upper-bar-->
<div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="language">
                    <a href="/" class="ar active">عربى</a>
                    <a href="/en" class="en inactive">EN</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="social">
                    <div class="icons">
                        <a href="{{$contact_us->facebook_link}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{$contact_us->instagram_link}}" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="{{$contact_us->x_link}}" class="twitter"><i class="fab fa-x-twitter"></i></a>
                        <a href="{{$contact_us->whatsapp_link}}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            @if(!auth('web-clients')->check())
                <div class="col-lg-4">
                    <div class="info" dir="ltr">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                            <p>{{$contact_us->phone}}</p>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                            <p>{{$contact_us->email}}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-4">
                    <div class="member">
                        <p class="welcome">مرحباً بك</p>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth('web-clients')->user()->name }}
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/">
                                    <i class="fas fa-home"></i> الرئيسية
                                </a>
                                <a class="dropdown-item" href="{{route('profile')}}">
                                    <i class="far fa-user"></i> معلوماتى
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-bell"></i> اعدادات الاشعارات
                                </a>
                                <a class="dropdown-item" href="{{route('favorites')}}">
                                    <i class="far fa-heart"></i> المفضلة
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-comments"></i> ابلاغ
                                </a>
                                <a class="dropdown-item" href="{{url('/contact-us')}}">
                                    <i class="fas fa-phone-alt"></i> تواصل معنا
                                </a>
                                <form id="logout-form" action="{{ route('sign-out') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!--nav-->
<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{asset('front/imgs/logo.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{request()->is('/') ? 'active' : null}} ">
                        <a class="nav-link" href="/">الرئيسية <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">عن بنك الدم</a>
                    </li>
                    <li class="nav-item {{request()->is('articles') || request()->routeIs('article-details') ? 'active' : null}}">
                        <a class="nav-link" href="{{route('articles')}}">المقالات</a>
                    </li>
                    <li class="nav-item {{request()->routeIs('donation-requests') || request()->routeIs('DR-filter')|| request()->routeIs('donation-request-details') ? 'active' : null}}">
                        <a class="nav-link" href="{{route('donation-requests')}}">طلبات التبرع</a>
                    </li>
                    <li class="nav-item {{request()->is('about-us') ? 'active' : null}}">
                        <a class="nav-link" href="{{url('about-us')}}">من نحن</a>
                    </li>
                    <li class="nav-item {{request()->is('contact-us') ? 'active' : null}}">
                        <a class="nav-link" href="{{url('/contact-us')}}">اتصل بنا</a>
                    </li>
                </ul>
                @if(!auth('web-clients')->check())
                    <!--not a member-->
                    <div class="accounts">
                        <a href="{{url('/v-sign-up')}}" class="create">إنشاء حساب جديد</a>
                        <a href="{{url('v-sign-in')}}" class="signin">الدخول</a>
                    </div>

                @else
                    <a href="{{route('createRequest')}}" class="donate">
                        <img src="{{asset('front/imgs/transfusion.svg')}}">
                        <p>طلب تبرع</p>
                    </a>

                @endif

            </div>
        </div>
    </nav>
</div>

@yield('content')

<div class="footer">
    <div class="inside-footer">
        <div class="container">
            <div class="row">
                <div class="details col-md-4">
                    <img src="{{asset('front/imgs/logo.png')}}">
                    <h4>بنك الدم</h4>
                    <p>{{$settings->about_app_ar}}</p>
                </div>
                <div class="pages col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action {{request()->is('/') ? 'active' :null}}"
                           id="list-home-list" href="/"
                           role="tab" aria-controls="home">الرئيسية</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" href="#" role="tab"
                           aria-controls="profile">عن بنك الدم</a>
                        <a class="list-group-item list-group-item-action {{request()->is('articles') || request()->routeIs('article-details') ? 'active' :null}} ? 'active' : null}} "
                           id="list-messages-list" href="{{route('articles')}}" role="tab"
                           aria-controls="messages">المقالات</a>
                        <a class="list-group-item list-group-item-action {{request()->routeIs('donation-requests') || request()->routeIs('DR-filter')|| request()->routeIs('donation-request-details') ? 'active' :null}}"
                           id="list-settings-list"
                           href="{{route('donation-requests')}}" role="tab" aria-controls="settings">طلبات التبرع</a>
                        <a class="list-group-item list-group-item-action {{request()->is('about-us') ? 'active' :null}}"
                           id="list-settings-list" href="{{route('about-us')}}"
                           role="tab" aria-controls="settings">من نحن</a>
                        <a class="list-group-item list-group-item-action {{request()->is('contact-us') ? 'active' :null}}"
                           id="list-settings-list" href="{{route('contact-us')}}"
                           role="tab" aria-controls="settings">اتصل بنا</a>
                    </div>
                </div>
                <div class="stores col-md-4">
                    <div class="availabe">
                        <p>متوفر على</p>
                        <a href="{{$contact_us->android_app_link}}">
                            <img src="{{asset('front/imgs/google1.png')}}">
                        </a>
                        <a href="{{$contact_us->apple_app_link}}">
                            <img src="{{asset('front/imgs/ios1.png')}}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="other">
        <div class="container">
            <div class="row">
                <div class="social col-md-4">
                    <div class="icons">
                        <a href="{{$contact_us->facebook_link}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{$contact_us->instagram_link}}" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="{{$contact_us->x_link}}" class="twitter"><i class="fab fa-x-twitter"></i></a>
                        <a href="{{$contact_us->whatsapp_link}}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="rights col-md-8">
                    <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; {{date('Y')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('front/assets/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('front/assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k"
        crossorigin="anonymous"></script>

<script src="{{asset('front/assets/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('front/assets/js/main.js')}}"></script>


@livewireScripts
</body>
</html>
