@extends('layouts.appAdmin')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('contacts')}}">Contacts</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Contacts
@endsection

@section('small_title')
    <br>
    Index-Overview
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fas fa-envelope"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Contacts</span>
                <span class="info-box-number">{{$contacts->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    List of Contacts
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @can('contacts-lists')
                        <table class="table table-bordered table-hover w-100 m-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>
                                        <a class="row-link"
                                           href="{{route('contacts.show',$contact->id)}}">{{$contact->subject}}
                                        </a>
                                    </td>
                                    <td>{{$contact->message}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->name}}</td>
                                    <td>
                                        @can('contacts-delete')
                                            <form action="{{route('contacts.destroy',$contact->id)}}" method="post"
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
