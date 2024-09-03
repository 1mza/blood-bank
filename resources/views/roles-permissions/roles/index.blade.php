@extends('layouts.appAdmin')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('roles')}}">Roles</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Roles
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon far fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Roles</span>
                <span class="info-box-number">{{$roles->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    List of roles
                </h3>
                @can('roles-create')
                    <a href="{{route('roles.create')}}" class="btn btn-primary">
                        Add New Role
                    </a>
                @endcan
            </div>
            @include('flash::message')
            <div class="card-body p-0">
                <div class="table-responsive">
                    @can('roles-lists')
                        <table class="table table-bordered table-hover w-100 m-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th><a class="row-link" href="{{route('roles.show',$role->id)}}">{{$role->name}}</a>
                                    </th>
                                    <td>
                                        @can('roles-edit')
                                            <a href="{{url('roles/'.$role->id.'/give-permission',)}}"
                                               class="btn btn-info">Add or Edit permissions</a>
                                            <a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can('roles-delete')
                                            <form action="{{route('roles.destroy',$role->id)}}" method="post"
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
