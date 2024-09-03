@extends('layouts.appAdmin')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('governorates')}}">Governorates</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Governorates
@endsection

@section('small_title')
    <br>
    Index-Overview
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-city"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Governorates</span>
                <span class="info-box-number">{{$records->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    List of Governorates
                </h3>
                @can('governorates-create')
                <a href="{{route('governorates.create')}}" class="btn btn-primary">
                    Add New Governorate
                </a>
                @endcan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @can('governorates-lists')
                    <table class="table table-bordered table-hover w-100 m-0">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <th><a class="row-link"
                                       href="{{route('governorates.show',$record)}}">{{$record->name}}</a></th>
                                <td>
                                    @can('governorates-edit')
                                        <a href="{{route('governorates.edit',$record)}}"
                                           class="btn btn-warning">Edit</a>
                                    @endcan
                                    @can('governorates-delete')
                                        <form action="{{route('governorates.destroy',$record)}}" method="post"
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
