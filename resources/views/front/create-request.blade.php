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
                        <li class="breadcrumb-item"><a href="/donation-requests">طلبات التبرع</a></li>
                        <li class="breadcrumb-item active" aria-current="page">إنشاء طلب تبرع</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <form method="post" id="my_form" action="{{route('storeRequest')}}">
                    @if(session()->has('alert-danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('alert-danger') }}
                        </div>
                    @elseif(session()->has('alert-success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('alert-success') }}
                        </div>
                    @endif
                    @method('POST')
                    @csrf
                    <div class="person">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>الإسم</p>
                                        </div>
                                        <div class="light">
                                            <input type="text" name="patient_name" class="form-control"
                                                   placeholder="الإسم">
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
                                            <select class="form-control" name="blood_type_id" required>
                                                <option selected disabled hidden value="">اختر فصيلة الدم</option>
                                                @foreach(App\Models\BloodType::all() as $bloodType)
                                                    <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>العمر</p>
                                        </div>
                                        <div class="light">
                                            <input placeholder="العمر" name="patient_age"
                                                   class="form-control"
                                                   type="number"
                                                   id="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>عدد الأكياس </p>
                                        </div>
                                        <div class="light">
                                            <input placeholder="ادخل العدد" name="bags_num"
                                                   class="form-control"
                                                   type="number"
                                                   id="bags_num">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>المديتة</p>
                                        </div>
                                        <div class="light">
                                            <select class="form-control" id="exampleInputBloodType"
                                                    name="city_id">
                                                <option selected disabled hidden value="">اختر المدينة</option>
                                                @foreach(App\Models\City::all() as $city)
                                                    <option value="{{$city->id}}">
                                                        {{$city->name}}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                            <p>المستشفي</p>
                                        </div>
                                        <div class="light">
                                            <input placeholder="اسم المستشفي" name="hospital"
                                                   class="form-control"
                                                   type="text"
                                                   id="hospital">
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
                                            <input placeholder="رقم الهاتف المحمول" name="patient_phone"
                                                   class="form-control"
                                                   type="text"
                                                   id="phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="inside">
                                    <div class="info">
                                        <div class="special-dark dark">
                                            <p>عنوان المستشفي</p>
                                        </div>
                                        <div class="special-light light">
                                            <textarea placeholder="ادخل العنوان بالتفصيل" name="hospital_address"
                                                      class="form-control"
                                                      type="text"
                                                      id="phone"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="inside">
                                    <div class="info">
                                        <div class="special-dark dark">
                                            <p>تفاصيل إضافية</p>
                                        </div>
                                        <div class="special-light light">
                                            <textarea name="details" class="form-control" placeholder="أدخل التفاصيل"
                                                      required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>الموقع</p>
                                        </div>
                                        {{--                                        <div class="light">--}}

                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input placeholder="ادخل احداثيات خط الطول" name="longitude"
                                   class="form-control" type="hidden" id="longitude">
                            {{--                                <div class="inside">--}}
                            {{--                                    <div class="info">--}}
                            {{--                                        <div class="dark">--}}
                            {{--                                            <p>خط العرض</p>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="light">--}}
                            <input placeholder="ادخل احداثيات خط العرض" name="latitude"
                                   class="form-control" type="hidden" id="latitude">
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                        </div>
                    </div>
                    <div class="location">
                        <iframe
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB3o0HWRf167JZwR4LnAeAWXZio5up5674&q=?,?&region=EG"
                            height="400" frameborder="0" style="border:0;" allowfullscreen=""
                            aria-hidden="false"
                            tabindex="0"></iframe>

                    </div>
                    <div class="details-button">
                        <a onclick="document.getElementById('my_form').submit();"> إنشاء</a>
                    </div>
            </div>
            <div class="text">
                <p></p>
            </div>
        </div>
    </div>
    </form>
    </div>
    </div>
    </div>
@endsection


