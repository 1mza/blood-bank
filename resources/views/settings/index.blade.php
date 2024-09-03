@extends('layouts.appAdmin')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('settings')}}">Settings</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Settings
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
                <span class="info-box-text">Settings</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    List of settings data
                </h3>
                @can('settings-create')
                    @if($settings->count() < 1)
                        <a href="{{ route('settings.create') }}" class="btn btn-primary">
                            Add Setting Texts
                        </a>
                    @endif
                @endcan
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    @can('settings-lists')
                        <table class="table table-bordered table-hover w-100 m-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Notification Settings Text</th>
                                <th scope="col">About App AR</th>
                                <th scope="col">Intro Text AR 1</th>
                                <th scope="col">Intro Text AR 2</th>
                                <th scope="col">Intro Text AR 3</th>
                                <th scope="col">About App EN</th>
                                <th scope="col">Intro Text EN 1</th>
                                <th scope="col">Intro Text EN 2</th>
                                <th scope="col">Intro Text EN 3</th>
                                <th scope="col">Promoting Text AR</th>
                                <th scope="col">Promoting Text EN</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>
                                        {{$setting->notification_settings_text}}
                                    </td>
                                    <td>
                                        {{$setting->about_app_ar}}
                                    </td>
                                    <td>
                                        {{$setting->intro_text_ar_1}}
                                    </td>
                                    <td>
                                        {{$setting->intro_text_ar_2}}
                                    </td>
                                    <td>
                                        {{$setting->intro_text_ar_3}}
                                    </td>
                                    <td>
                                        {{$setting->about_app_en}}
                                    </td>
                                    <td>
                                        {{$setting->intro_text_en_1}}
                                    </td>
                                    <td>
                                        {{$setting->intro_text_en_2}}
                                    </td>
                                    <td>
                                        {{$setting->intro_text_en_3}}
                                    </td>
                                    <td>
                                        {{$setting->promoting_text_ar}}
                                    </td>
                                    <td>
                                        {{$setting->promoting_text_en}}
                                    </td>

                                    <td>
                                        @can('settings-edit')
                                            <a href="{{route('settings.edit',$setting->id)}}"
                                               class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can('settings-delete')
                                            <form action="{{route('settings.destroy',$setting->id)}}" method="post"
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
