@extends('layouts.appAdmin')
{{--@inject('clients','App\Models\Client')--}}
@inject('donationRequests','App\Models\City')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('donation-requests')}}">Donation Requests</a></li>
            <li class="breadcrumb-item active"><a href="{{route('donation-requests.show',$donation_request->id)}}">{{$donation_request->name}}</a></li>

        </ol>
    </div>
@endsection
@section('page_title')
    Edit donation requests page
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-map-marker"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Donation Requests</span>
                <span class="info-box-number">{{$donation_request->name}}</span>
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
            {{html()->modelForm($donationRequests,'PUT')->class('form')->route('donation-requests.update',$donation_request->id)->open()}}
            @include('partials.validation_errors')
            @include('donation-requests.form')
            {{html()->closeModelForm()}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
