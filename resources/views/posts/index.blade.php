@extends('layouts.appAdmin')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('posts')}}">Posts</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Posts
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
                <span class="info-box-text">Posts</span>
                <span class="info-box-number">{{$posts->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    List of Posts
                </h3>
                @can('posts-create')
                    <a href="{{route('posts.create')}}" class="btn btn-primary">
                        Add New Post
                    </a>
                @endcan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @can('posts-lists')
                        <table class="table table-bordered table-hover w-100 m-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Detailed Title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Content</th>
                                <th scope="col">Category</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>
                                        <a class="row-link"
                                           href="{{route('posts.show',$post->id)}}">{{$post->title}}
                                        </a>
                                    </td>
                                    <td>{{$post->detailed_title}}</td>

                                    <td>
                                        <img width="650" height="600" src="{{asset('images/'.$post->image)}}" alt="Image">
                                    </td>
                                    <td>{{$post->content}}</td>
                                    <td>
                                        <a class="row-link"
                                           href="{{route('categories.show',$post->category_id)}}">{{$post->category->name}}
                                        </a>
                                    </td>
                                    <td>
                                        @can('posts-edit')
                                            <a href="{{route('posts.edit',$post->id)}}"
                                               class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can('posts-delete')
                                            <form action="{{route('posts.destroy',$post->id)}}" method="post"
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
