@extends('front.master')
@section('content')
    @section('classname')
        inside-request
    @endsection
    <!--ask-donation-->
    <div class="ask-donation">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="/donation-requests">معلوماتي</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{auth('web-clients')->user()->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="person">
                    @if(session()->has('alert-danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('alert-danger') }}
                        </div>
                    @elseif(session()->has('alert-success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('alert-success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>الإسم</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ auth('web-clients')->user()->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>فصيلة الدم</p>
                                    </div>
                                    <div class="light">
                                        <p dir="ltr">{{ auth('web-clients')->user()->bloodTypes->first()->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>تاريخ الميلاد</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ auth('web-clients')->user()->d_o_b }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>تاريخ اخر عملية تبرع</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ auth('web-clients')->user()->last_donation_date }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>البريد الاكتروني</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ auth('web-clients')->user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>رقم الجوال</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ auth('web-clients')->user()->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>المحافظة</p>
                                    </div>
                                    <div class="light">
                                        <p dir="ltr">{{ auth('web-clients')->user()->mainGovernorate->name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>المدينة</p>
                                    </div>
                                    <div class="light">
                                        <p dir="ltr">{{ auth('web-clients')->user()->city->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="details-button">
                        <a href="{{route('update-profile')}}">تعديل الملف الشخصي</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
