@extends('layouts.admin')
@push('title')
    <title> Admin |edit role</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Edit Role
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Role</li>

            @can('manage_role')
                <li>
                    <a href="{{ route('role.create') }}"><i class="fa fa-plus-square"></i> Role</a>
                </li>
                <li>
                    <a href="{{ route('role.index') }}"><i class="fa fa-list"></i> Role List</a>
                </li>
            @endcan
            <li class="active">Edit Role</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-9">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Product
                            @include('includes.alert-message')

                        </h3>
                    </div>
                    <form role="form" action="{{ route('role.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <label>Role Name</label>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" class="form-control" name="name" value="{{ $role->name }}"
                                    placeholder="Enter Role Name">
                                @error('name')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="box-body">
                            <label>Permissions:-</label>
                            <div class="radio" style="float: right;">
                                <label><input type="radio" id="select_all">
                                    Sellect All
                                </label>
                            </div>
                            <div class="form-group @error('name') has-error @enderror">
                                @error('permissions')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="checkbox">
                                <label>
                                    @foreach ($permissions as $permission)
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            {{ in_array($permission->name, $slctdPrmsn) ? 'checked' : '' }}>{{ ucwords(str_replace('_',' ',$permission->name)) }}
                                    @endforeach

                                </label>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $('#select_all').click(function(){
                $(".checkbox input[type = 'checkbox']").prop('checked', true);

            });
        });
    </script>
@endsection
