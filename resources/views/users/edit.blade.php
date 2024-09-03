@extends('layouts.appAdmin')
@inject('users','App\Models\City')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('users')}}">Users</a></li>
            <li class="breadcrumb-item active"><a href="{{route('users.show',$user->id)}}">{{$user->name}}</a></li>

        </ol>
    </div>
@endsection
@section('page_title')
    Edit user page
@endsection

@section('small_title')
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">User</span>
                <span class="info-box-number">{{$user->name}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Edit form
            </h3>

        </div>
        <div class="card-body">
            <form action="{{ route('users.update',$user->id) }}" method="post">
                @include('partials.validation_errors')
                @csrf
                @method('PUT')
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Confirm Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <input type="text" value="{{ $user->name }}" name="name" class="form-control"
                                   placeholder="Name">
                        </td>
                        <td>
                            <input type="email" name="email" readonly value="{{ $user->email }}" class="form-control"
                                   placeholder="Email">                        </td>
                        <td>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Password">
                        </td>
                        <td>
                            <input type="password" name="confirm-password" class="form-control"
                                   placeholder="Confirm Password">
                        </td>
                        <td>
                            <select class=" js-example-basic-multiple form-control multiple" multiple name="roles[]">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : ''}}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success">Save</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>



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
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
