@extends('layouts.appAdmin')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('users')}}">Users</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Users
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">{{$users->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    List of Users
                </h3>
{{--                @can('users-create')--}}
                <a href="{{route('users.create')}}" class="btn btn-primary">
                    Add New User
                </a>
{{--                    @endcan--}}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
{{--                    @can('users-lists')--}}
                    <table class="table table-bordered table-hover w-100 m-0">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr >
                                <th >{{$loop->iteration}}</th>
                                <th ><a class="row-link" href="{{route('users.show',$user->id)}}">{{$user->name}}</a></th>
                                <th >{{$user->email}}</th>
                                <td > @foreach($user->getRoleNames() as $rolename)
                                          <label class="badge badge-primary mx-1">{{$rolename}}</label>
                                @endforeach
                                </td>
                                <td>
{{--                                    @can('users-edit')--}}
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">Edit</a>
{{--                                    @endcan--}}
{{--                                        @can('users-delete')--}}

                                        <form action="{{route('users.destroy',$user->id)}}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                                    </form>
{{--                                            @endcan--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
{{--                        @endcan--}}
                </div>
            </div>
        </div>
    </div>

    <!-- /.card -->

@endsection
