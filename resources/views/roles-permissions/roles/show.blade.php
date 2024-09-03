@extends('layouts.appAdmin')
{{--@inject('clients','App\Models\Client')--}}
{{--@inject('donationRequests','App\Models\DonationRequest')--}}
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('roles')}}">roles</a></li>
            <li class="breadcrumb-item active"><a href="{{route('roles.show',$role->id)}}">{{$role->name}}</a></li>

        </ol>
    </div>
@endsection
@section('page_title')
    show role page
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
                Role Info
            </h3>

        </div>
        <div class="card-body">
            @include('flash::message')


            <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Permissions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{$role->id}}</th>
                        <td>{{$role->name}}</td>
                        <td>
                            @foreach($role->permissions->pluck('name') as $role)
                                <label class="badge badge-primary mx-1">{{$role}}</label>
                            @endforeach
{{--                            {{$role->permissions->pluck('name')}}</td>--}}
                    </tr>
                    </tbody>
                </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
