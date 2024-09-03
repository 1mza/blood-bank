@extends('layouts.appAdmin')
@inject('roles','Spatie\Permission\Models\Role')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('homeAdmin')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('roles')}}">Roles</a></li>
            <li class="breadcrumb-item active"><a href="{{url('roles/'.$role->id.'/give-permission',)}}">{{$role->name}}
                    [ permissions ]</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Edit role permissions page
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon far fa-address-book"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Role</span>
                <span class="info-box-number">{{$role->name}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                Edit role permissions form
            </h3>
        </div>
        <?php $options = []; ?>
        <div class="card-body">
            <form action="{{ url('roles/'.$role->id.'/give-permission') }}" method="post">
                @csrf
                @method('PUT')
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Role</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{ $role->id }}</th>
                        <td>
                            {{ $role->name }}
                        </td>
                        <td>
                            <label class="form-check-label" for="selectall">
                                <input type="checkbox" onClick="toggle(this)" id="selectall"/><b>Select All</b><br/>
                            </label>
                            @foreach($permissions as $permission)
                                    <?php $isChecked = $role->permissions->contains($permission->id); ?>
                                <div class="form-check">
                                    <label class="form-check-label" for="{{ $permission->id }}">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="permissions[]"
                                               id="{{ $permission->id }}"
                                               value="{{$permission->name }}"
                                            {{in_array($permission->id,$rolePermissions) ? 'checked' : ''}}
                                        />
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success">Save</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection
<script language="JavaScript">
    function toggle(source) {
        let checkboxes = document.getElementsByName('permissions[]');
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
