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
                        <li class="breadcrumb-item"><a href="/donation-requests">تعديل معلوماتي</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{auth('web-clients')->user()->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <form method="post" id="my_form" action="{{route('store-update-profile')}}">
                    @method('POST')
                    @csrf
                    @if(session()->has('alert-danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('alert-danger') }}
                        </div>
                    @elseif(session()->has('alert-success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('alert-success') }}
                        </div>
                    @endif
                    <div class="person">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>البيرد الإلكتروني</p>
                                        </div>
                                        <div class="light">
                                            <input dir="ltr" disabled type="text" name="name" class="form-control"
                                                   id="exampleInputName1"
                                                   aria-describedby="nameHelp"
                                                   placeholder="الإسم" value="{{ auth('web-clients')->user()->email }}">
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
                                            <p>الإسم</p>
                                        </div>
                                        <div class="light">
                                            <input type="text" name="name" class="form-control"
                                                   id="exampleInputName1"
                                                   aria-describedby="nameHelp"
                                                   placeholder="الإسم" value="{{ auth('web-clients')->user()->name }}">
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
                                            <select dir="ltr" class="form-control" id="exampleInputBloodType"
                                                    name="blood_type_id">
                                                <option disabled hidden value="">فصيلة الدم</option>
                                                @foreach(App\Models\BloodType::all() as $bloodType)
                                                    <option value="{{$bloodType->id}}"
                                                        {{$bloodType->id == auth('web-clients')->user()->mainBloodType->id ? 'selected' : null}}>
                                                        {{$bloodType->name}}
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
                                            <p>تاريخ الميلاد</p>
                                        </div>
                                        <div class="light">
                                            <input dir="ltr" placeholder="تاريخ الميلاد" name="d_o_b"
                                                   class="form-control"
                                                   type="text"
                                                   onfocus="(this.type='date')"
                                                   id="date" value="{{ auth('web-clients')->user()->d_o_b }}">
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
                                        <div dir="ltr" class="light">
                                            <input placeholder="تاريخ الميلاد" name="d_o_b" class="form-control"
                                                   type="text"
                                                   onfocus="(this.type='date')"
                                                   id="date"
                                                   value="{{ auth('web-clients')->user()->last_donation_date }}">
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
                                            <p>المحافظة - المدينة</p>
                                        </div>
                                        <div class="light">
                                            <livewire:dropdowns/>
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
                                        <div dir="ltr" class="light">
                                            <input type="text" class="form-control" name="phone" id="exampleInputPhone"
                                                   aria-describedby="phoneHelp"
                                                   placeholder="رقم الهاتف"
                                                   value="{{ auth('web-clients')->user()->phone }}">
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
                                            <p>كلمة السر</p>
                                        </div>
                                        <div class="light">
                                            <input type="password" class="form-control" name="password"
                                                   id="exampleInputPhone"
                                                   aria-describedby="phoneHelp"
                                                   placeholder="كلمة السر">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>تأكيد كلمة السر</p>
                                        </div>
                                        <div class="light">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                   id="exampleInputPhone"
                                                   placeholder="تأكيد كلمة السر"
                                            >
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="details-button">
                            <a onclick="document.getElementById('my_form').submit();">حفظ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
