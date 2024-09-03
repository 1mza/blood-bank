@extends('layouts.appAdmin')
{{--@inject('clients','App\Models\Client')--}}
{{--@inject('donationRequests','App\Models\DonationRequest')--}}
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('donation-requests')}}">Donation Requests</a></li>
            <li class="breadcrumb-item active"><a
                    href="{{route('donation-requests.show',$donation_request->id)}}">{{$donation_request->patient_name}}</a>
            </li>

        </ol>
    </div>
@endsection
@section('page_title')
    show donation requests page
@endsection
@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-paper-plane"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Donation Request</span>
                <span class="info-box-number">{{$donation_request->patient_name}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Donation Request Info
            </h3>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                @include('flash::message')
                <table class="table table-bordered table-hover w-100 m-0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Patient Phone</th>
                        <th scope="col">Patient Age</th>
                        <th scope="col">Blood Type</th>
                        <th scope="col">Client Email</th>
                        <th scope="col">City</th>
                        <th scope="col">hospital</th>
                        <th scope="col">hospital Address</th>
                        <th scope="col">Bags Number</th>
                        <th scope="col">Details</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">Date/Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>{{ $donation_request->id }}</th>
                        <td>{{ $donation_request->patient_name }}</td>
                        <td>{{ $donation_request->patient_phone }}</td>
                        <td>{{ $donation_request->patient_age }}</td>
                        <td>{{ optional($donation_request->bloodType)->name }}</td>
                        <td>{{ optional($donation_request->client)->email }}</td>
                        <td>{{ optional($donation_request->city)->name }}</td>
                        <td>{{ $donation_request->hospital }}</td>
                        <td>{{ $donation_request->hospital_address }}</td>
                        <td>{{ $donation_request->bags_num }}</td>
                        <td>{{ $donation_request->details }}</td>
                        <td>{{ $donation_request->latitude }}</td>
                        <td>{{ $donation_request->longitude }}</td>
                        <td>{{ $donation_request->created_at->format('Y-m-d H:i') }}</td>

                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
