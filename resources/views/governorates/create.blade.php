@extends('layouts.appAdmin')
@inject('governorates','App\Models\Governorate')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('governorates')}}">Governorates</a></li>
            <li class="breadcrumb-item active"><a href="{{route('governorates.create')}}">Create</a></li>

        </ol>
    </div>
@endsection
@section('page_title')
    Create governorates page
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-city"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Governorate</span>
                <span class="info-box-number">{{$governorates->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Create form
            </h3>

        </div>
        <div class="card-body">
            {{html()->modelForm($governorates,'POST')->class('form')->route('governorates.store')->open()}}
            @include('partials.validation_errors')
            @include('governorates.form')
            {{html()->closeModelForm()}}

            {{--            <form action="{{route('governorates.store')}}" method="post">--}}
{{--                @csrf--}}
{{--                @method('POST')--}}
{{--                <table class="table">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">Name</th>--}}
{{--                        <th scope="col">Action</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            <input  type="text" name="name" placeholder="إسم المحافظة" class="form-control">--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <button class="btn btn-success">Create</button>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </form>--}}

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection
