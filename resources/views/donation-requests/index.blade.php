@extends('layouts.appAdmin')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('donation-requests')}}">Donation Requests</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Donation Requests
@endsection

@section('small_title')
    <br>
    Index-Overview
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-map-marker"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Donation Requests</span>
                <span class="info-box-number">{{$donation_requests->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    List of Donation Requests
                </h3>
                @can('donation-requests-create')
                    <a href="{{route('donation-requests.create')}}" class="btn btn-primary">
                        Add New Donation Request
                    </a>
                @endcan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @can('donation-requests-lists')
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
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($donation_requests as $donation_request)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td><a href="{{route('donation-requests.show',$donation_request->id)}}"> {{ $donation_request->patient_name }}</a></td>
                                <td>{{ $donation_request->patient_phone }}</td>
                                <td>{{ $donation_request->patient_age }}</td>
                                <td>{{ optional($donation_request->bloodType)->name }}</td>
                                <td><a href="#">{{ optional($donation_request->client)->email}}</a></td>
                                <td><a href="#">{{ optional($donation_request->city)->name }}</a></td>
                                <td>{{ $donation_request->hospital }}</td>
                                <td>{{ $donation_request->hospital_address }}</td>
                                <td>{{ $donation_request->bags_num }}</td>
                                <td>{{ $donation_request->details }}</td>
                                <td>{{ $donation_request->latitude }}</td>
                                <td>{{ $donation_request->longitude }}</td>
                                <td>{{ $donation_request->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    @can('donation-requests-edit')
                                        <a href="{{route('donation-requests.edit',$donation_request->id)}}"
                                           class="btn btn-warning">Edit</a>
                                    @endcan
                                    @can('donation-requests-delete')
                                        <form action="{{route('donation-requests.destroy',$donation_request->id)}}" method="post"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="btn btn-danger">Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <!-- /.card -->

@endsection
