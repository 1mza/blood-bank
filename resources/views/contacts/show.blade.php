@extends('layouts.appAdmin')
{{--@inject('clients','App\Models\Client')--}}
{{--@inject('donationRequests','App\Models\DonationRequest')--}}
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('contacts')}}">Contacts</a></li>
            <li class="breadcrumb-item active"><a href="{{route('contacts.show',$contact->id)}}">{{$contact->subject}}</a></li>

        </ol>
    </div>
@endsection
@section('page_title')
    show contacts page
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fas fa-envelope"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Contact</span>
                <span class="info-box-number">{{$contact->name}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Contact Info
            </h3>

        </div>
        <div class="card-body">
            @include('flash::message')


            <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{$contact->id}}</th>
                        <td>{{$contact->subject}}</td>

                        <td>{{$contact->message}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->name}}</td>
                    </tr>
                    </tbody>
                </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
