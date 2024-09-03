<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="imgs/Icon.png">

    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{asset('front/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/owl.theme.default.min.css')}}">

    <!--style css-->
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">

    <!--override on style css-->
    <link rel="stylesheet" href="{{asset('front/assets/css/style-ltr.css')}}">

    <title>Blood Bank</title>
</head>
<body>
<!--upper-bar-->
<div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="language">
                    <a href="/en" class="en active">EN</a>
                    <a href="/" class="ar inactive">عربى</a>
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
                        <p class="welcome">Welcome,</p>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth('web-clients')->user()->name }}
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/en">
                                    <i class="fas fa-home"></i> Home
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-bell"></i>Notification settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-heart"></i> Favourites
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-comments"></i> Report
                                </a>
                                <a class="dropdown-item" href="contact-us.html">
                                    <i class="fas fa-phone-alt"></i>Contact with us
                                </a>
                                <form id="logout-form" action="{{ route('sign-out') }}" method="POST" >
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i>logout
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
</div>


<!--nav-->
<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('front/imgs/logo-ltr.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{request()->is('en') ? 'active' : null}} ">
                        <a class="nav-link" href="/en">home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">about us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="donation-requests-ltr.html">donation requests</a>
                    </li>
                    <li class="nav-item {{request()->is('about') ? 'active' : null}}">
                        <a class="nav-link" href="/about">Who are us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-us-ltr.html">contact us</a>
                    </li>
                </ul>

                @if(!auth('web-clients')->check())
                    <div class="accounts">
                        <a href="signin-account-rtl.html" class="signin">sign in</a>
                        <a href="create-account-ltr.html" class="create">create new account</a>
                    </div>

                @else
                    <a href="#" class="donate">
                        <img src="{{asset('front/imgs/transfusion.svg')}}">
                        <p>Donation request</p>
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
                    <img src="imgs/logo-ltr.png">
                    <h4>Blood Bank</h4>
                    <p>
                        This text is an example of text that can be replaced in the same space, this text has been
                        generated from the Arabic text generator, where you can generate such text or many other.
                    </p>
                </div>
                <div class="pages col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                           href="index-ltr.html" role="tab" aria-controls="home">Home</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" href="#" role="tab"
                           aria-controls="profile">About us</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" href="#" role="tab"
                           aria-controls="messages">Articles</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                           href="donation-requests-ltr.html" role="tab" aria-controls="settings">Donation requests</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                           href="who-are-us-ltr.html" role="tab" aria-controls="settings">Who are us</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                           href="contact-us-ltr.html" role="tab" aria-controls="settings">Contact us</a>
                    </div>
                </div>
                <div class="stores col-md-4">
                    <div class="availabe">
                        <p>Available on</p>
                        <a href="#">
                            <img src="imgs/google1.png">
                        </a>
                        <a href="#">
                            <img src="imgs/ios1.png">
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
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="rights col-md-8">
                    <p>All rights reserved to <span>Blood Bank</span> &copy; 2019</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('front/assets/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('front/assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k"
        crossorigin="anonymous"></script>

<script src="{{asset('front/assets/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('front/assets/js/main.js')}}"></script>
</body>
</html>
