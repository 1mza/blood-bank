@extends('layouts.appAdmin')
{{--@inject('clients','App\Models\Client')--}}
{{--@inject('cities','App\Models\City')--}}
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('roles')}}">Roles</a></li>
            <li class="breadcrumb-item active"><a href="{{route('roles.show',$role->id)}}">{{$role->name}}</a></li>

        </ol>
    </div>
@endsection
@section('page_title')
    Edit role page
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon far fa-address-book"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Role</span>
                <span class="info-box-number">{{$role->name}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Edit form
            </h3>

        </div>
        <div class="card-body">
            {{html()->modelForm($role,'PUT')->class('form')->route('roles.update',$role->id)->open()}}
            @include('partials.validation_errors')
            @include('roles-permissions.roles.form')
            {{html()->closeModelForm()}}

            {{--            <form action="{{route('governorates.update',$governorate)}}" method="post">--}}
{{--                @csrf--}}
{{--                @method('PUT')--}}
{{--                <table class="table">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">#ID</th>--}}
{{--                        <th scope="col">Name</th>--}}
{{--                        <th scope="col">Actions</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <th scope="row">{{$governorate->id}}</th>--}}
{{--                        <td>--}}
{{--                            <input required type="text" name="name" placeholder="إسم المحافظة" class="form-control"--}}
{{--                                   value="{{$governorate->name}}">--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <button class="btn btn-success">Save</button>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </form>--}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
