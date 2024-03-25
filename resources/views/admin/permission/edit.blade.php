@extends('layouts.admin')
@push('title')
    <title> Admin |edit permission</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Edit Permission
            {{-- <small>Preview</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Permission</li>
            @can('manage_permission')
                <li><a href="{{ route('permission.create') }}"><i
                            class="fa fa-unlock"></i> permission</a></li>
                <li><a href="{{ route('permission.index') }}"><i
                            class="fa fa-tasks"></i> permission List</a></li>
            @endcan
            <li class="active">Edit Permission </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Permission</h3>
                    </div>
                    <form role="form" action="{{ route('permission.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="box-body">
                            <label for="exampleInputEmail1">Permission Name</label>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" class="form-control" name="name" value="{{ $permission->name }}"
                                    id="exampleInputEmail1" placeholder="Enter permission">
                                @error('name')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
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
@endsection
