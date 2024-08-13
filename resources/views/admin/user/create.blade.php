@extends('layouts.admin')
@push('title')
    <title> Admin |add user</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Add User
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage User</li>
            <li class="active">Add user</li>
            <li>
                @can('user_index')
                    <a href="{{ route('user.index') }}"><i class="fa fa-users"></i>User List</a>
                @endcan
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add User</h3>
                        @include('includes.alert-message')
                    </div>

                    <form role="form" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <label>Enter Name</label>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter name">

                                @error('name')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="box-body">
                            <label>Email address</label>
                            <div class="form-group @error('email') has-error @enderror">
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="Enter email">
                                @error('email')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="box-body">
                            <label>Designation</label>
                            <div class="form-group @error('designation') has-error @enderror">
                                <input type="text" class="form-control" name="designation"
                                    value="{{ old('designation') }}" placeholder="Enter designation">
                                @error('designation')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="box-body">
                            <label>Password</label>
                            <div class="form-group @error('password') has-error @enderror">
                                <div class="input-group"> <!-- Wrap the input and icon within an input-group -->
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password">
                                    <span class="input-group-addon toggle-password" onclick="togglePassword('password')">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="box-body">
                            <label>Re-enter Password</label>
                            <div class="form-group @error('confirm_password') has-error @enderror">
                                <div class="input-group"> <!-- Wrap the input and icon within an input-group -->
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confirm_password" placeholder="Re-enter Password">
                                    <span class="input-group-addon toggle-password"
                                        onclick="togglePassword('confirm_password')">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                @error('confirm_password')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>



                        <div class="box-body">
                            <label>Roles :-</label>
                            <div class="form-group @error('roles') has-error @enderror">
                                @error('roles')
                                    <label class="control-label" for="inputError"><i
                                            class="fa fa-times-circle-o"></i>{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    @foreach ($roles as $role)
                                        <label></label>
                                        <input type="checkbox" name ="roles[]"
                                            value="{{ $role->name }}">{{ $role->name }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">image upload</label>
                                <input type="file" id="exampleInputFile" name="image">

                            </div>
                        </div>

                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->



            </div>
        </div>
    </section>
   @isset($validator)
       {!! $validator !!}
   @endisset
    <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = document.querySelector('.toggle-password i');
            if (field.type === "password") {
                field.type = "text";
                icon.className = 'fa fa-eye-slash';
            } else {
                field.type = "password";
                icon.className = 'fa fa-eye';
            }
        }
    </script>
@endsection
