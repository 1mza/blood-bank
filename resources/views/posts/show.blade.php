@extends('layouts.appAdmin')
{{--@inject('clients','App\Models\Client')--}}
{{--@inject('donationRequests','App\Models\DonationRequest')--}}
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('posts')}}">Posts</a></li>
            <li class="breadcrumb-item active"><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a></li>

        </ol>
    </div>
@endsection
@section('page_title')
    show posts page
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-clipboard"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Post</span>
                <span class="info-box-number">{{$post->name}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Post Info
            </h3>

        </div>
        <div class="card-body">
            @include('flash::message')


            <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Detailed Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Content</th>
                        <th scope="col">Category</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->detailed_title}}</td>
                        <td>
                            <img width="650" height="600" src="{{asset('images/'.$post->image)}}" alt="Image">

                        </td>
                        <td>{{$post->content}}</td>
                        <td>{{$post->category->name}}</td>
                    </tr>
                    </tbody>
                </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
