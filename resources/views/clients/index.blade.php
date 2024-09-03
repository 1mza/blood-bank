@extends('layouts.appAdmin')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('clients')}}">Clients</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Clients
@endsection

@section('small_title')
    <br>
    Index-Overview
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-clipboard"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Clients</span>
                <span class="info-box-number">{{$clients->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    List of Clients
                </h3>
                @can('clients-create')
                    <a href="{{route('clients.create')}}" class="btn btn-primary">
                        Add New Client
                    </a>
                @endcan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @can('clients-lists')
                        <table class="table table-bordered table-hover w-100 m-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Birth Date</th>
                                <th scope="col">Governorate</th>
                                <th scope="col">City</th>
                                <th scope="col">Blood Type</th>
                                <th scope="col">last Donation Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>
                                        {{$client->name}}
                                    </td>
                                    <td><a class="row-link"
                                           href="{{route('clients.show',$client->id)}}">{{$client->email}}
                                        </a>
                                    </td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->d_o_b}}</td>
                                    <td><a class="row-link"
                                           href="{{ route('governorates.show', $client->governorate_id) }}">
                                            {{ $client->mainGovernorate->name }}
                                        </a>
                                    </td>
                                    {{--                                        @foreach ($client->governorates as $governorate)--}}
                                    {{--                                            <a class="row-link" href="{{ route('governorates.show', $governorate->id) }}">--}}
                                    {{--                                                {{ $governorate->name }}--}}
                                    {{--                                            </a>--}}
                                    {{--                                        @endforeach--}}
                                    {{--                                    </td>--}}

                                    <td><a class="row-link" href="{{ route('cities.show', $client->city_id) }}">
                                            {{ $client->city->name }}
                                        </a></td>

                                    <td>
                                        {{ $client->mainBloodType->name }}
                                    </td>
                                    <td>{{$client->last_donation_date}}</td>
                                    <td>
                                        @can('clients-edit')
                                            <a href="{{route('clients.edit',$client->id)}}"
                                               class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can('clients-delete')
                                            <form action="{{route('clients.destroy',$client->id)}}" method="post"
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
