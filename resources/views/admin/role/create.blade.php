@extends('layouts.admin')
@push('title')
    <title> Admin | add role</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Add Role
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Role</li>
            <li class="active">Add Role</li>
            <li>
                @can('manage_role')
                <a href="{{ route('role.index') }}" ><i
                    class="fa fa-list"></i> Role List</a>
                @endcan
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-9">

                <div class="box box-primary">
                    
                    <form role="form" action="{{ route('role.store') }}" method="POST">
                        @csrf

                        <div class="box-body">
                            <label>Role Name</label>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
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
                            <div class="form-group @error('permissions') has-error @enderror">
                                @error('permissions')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="checkbox">
                                <label>
                                    @foreach ($permissions as $permissions)
                                        <input type="checkbox" name="permissions[]"
                                            value="{{ $permissions->name }}">{{ $permissions->name }}
                                    @endforeach

                                </label>
                            </div>
                        </div>
                        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
