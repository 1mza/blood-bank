@extends('layouts.appAdmin')
{{--@inject('clients','App\Models\Client')--}}
{{--@inject('donationRequests','App\Models\DonationRequest')--}}
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('clients')}}">Clients</a></li>
            <li class="breadcrumb-item active"><a href="{{route('clients.show',$client->id)}}">{{$client->email}}</a></li>

        </ol>
    </div>
@endsection
@section('page_title')
    show clients page
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-clipboard"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Client</span>
                <span class="info-box-number">{{$client->name}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Client Info
            </h3>

        </div>
        <div class="card-body">
            @include('flash::message')


            <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Governorate</th>
                        <th scope="col">City</th>
                        <th scope="col">Blood Type</th>
                        <th scope="col">last Donation Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{$client->id}}</th>
                        <td>
                            {{$client->name}}
                        </td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->phone}}</td>
                        <td>{{$client->d_o_b}}</td>
                        <td>
                            {{ $client->mainGovernorate->name }}

                        </td>
                        <td>
                                {{ $client->city->name }}
                        </td>

                        <td>
                            {{ $client->mainBloodType->name }}

                        </td>
                        <td>{{$client->last_donation_date}}</td>
                    </tr>
                    </tbody>
                </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
