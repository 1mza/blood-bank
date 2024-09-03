@extends('layouts.appAdmin')
@inject('contactus_record','App\Models\ContactUs')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('contact-us')}}">Contact Us</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Contact US
@endsection

@section('small_title')
    <br>
    Index-Overview
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fas fa-phone"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Contact Us</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    Details of Contact Us
                </h3>
                @can('posts-create')
                    @if($contact_us->count() < 1)
                        <a href="{{ route('contact-us.create') }}" class="btn btn-primary">
                            Add Contact Us
                        </a>
                    @endif
                @endcan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @can('contact-us-lists')
                        <table class="table table-bordered table-hover w-100 m-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Facebook-link</th>
                                <th scope="col">X-link</th>
                                <th scope="col">Youtube-link</th>
                                <th scope="col">instagram-link</th>
                                <th scope="col">google-link</th>
                                <th scope="col">Whatsapp-link</th>
                                <th scope="col">Android app link</th>
                                <th scope="col">Apple app link</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contact_us as $contact)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$contact->facebook_link}}</td>
                                    <td>{{$contact->x_link}}</td>
                                    <td>{{$contact->youtube_link}}</td>
                                    <td>{{$contact->instagram_link}}</td>
                                    <td>{{$contact->google_link}}</td>
                                    <td>{{$contact->whatsapp_link}}</td>
                                    <td>{{$contact->android_app_link}}</td>
                                    <td>{{$contact->apple_app_link}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>
                                        @can('contact-us-edit')
                                            <a href="{{route('contact-us.edit',$contact->id)}}"
                                               class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can('contact-us-delete')
                                            <form action="{{route('contact-us.destroy',$contact->id)}}" method="post"
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
