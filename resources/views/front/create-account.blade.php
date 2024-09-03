@use('App\Models\Governorate','Governorate')
@use('App\Models\BloodType','BloodType')
@use('App\Models\City','City')
@if(!auth('web-clients')->check())
    @extends('front.master')
    @section('content')
        @section('classname')
            create
        @endsection
        <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    <form method="post" action="{{route('sign-up')}}">
                        @csrf
                        @method('POST')
                        <input type="text" name="name" class="form-control" id="exampleInputName1"
                               aria-describedby="nameHelp"
                               placeholder="الإسم">

                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="البريد الإلكترونى">

                        <input placeholder="تاريخ الميلاد" name="d_o_b" class="form-control" type="text"
                               onfocus="(this.type='date')"
                               id="date">

                        <select class="form-control" id="exampleInputBloodType" name="blood_type_id">
                            <option selected disabled hidden value="">فصيلة الدم</option>
                            @foreach(BloodType::all() as $bloodType)
                                <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                            @endforeach
                        </select>

                        <livewire:dropdowns/>


                        <input type="text" class="form-control" name="phone" id="exampleInputPhone"
                               aria-describedby="phoneHelp"
                               placeholder="رقم الهاتف">

                        <input placeholder="آخر تاريخ تبرع" name="last_donation_date" class="form-control" type="text"
                               onfocus="(this.type='date')"
                               id="date">

                        <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                               placeholder="كلمة المرور">

                        <input type="password" class="form-control" name="password_confirmation"
                               id="exampleInputPasswordConfirmation"
                               placeholder="تأكيد كلمة المرور">

                        <div class="create-btn">
                            <input type="submit" value="إنشاء">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endsection
@else
    {{abort(404)}}
@endif
