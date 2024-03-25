@extends('layouts.admin')
@push('title')
    <title> Admin |add permission</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Add Permission
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Permission</li>
            <li class="active">Add Permission</li>
            <li>
                @can('manage_permission')
                    <a href="{{ route('permission.index') }}"><i class="fa fa-tasks"></i>Permission List</a>
                @endcan
            </li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Add Permission</h3>

                    </div>
                    <form role="form" action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        @if (session()->has('success'))
                            <div class="callout callout-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="box-body">
                            <label for="exampleInputEmail1">Permission Name</label>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                    placeholder="Enter permission">
                                @error('name')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" name="save" value="Save">
                            <input type="submit" class="btn btn-primary" name="save-new" value="Save & New">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
