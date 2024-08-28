@extends('layouts.admin')

@push('title')
    <title>Admin | User Profile</title>
@endpush

@section('content')
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> User Profile
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage User</li>
            <li>
                @can('user_create')
                    <a href="{{ route('user.create') }}"><i class="fa fa-user"></i>Add User</a>
                @endcan
            </li>
            <li>
                @can('user_index')
                    <a href="{{ route('user.index') }}"><i class="fa fa-users"></i>User List</a>
                @endcan
            </li>
            <li class="active">User Profile</li>
        </ol>
    </section>

    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    @if ($user->hasMedia('image'))
                        <img src="{{ $user->getFirstMediaUrl('image') }}" class="user-image" alt="User Image"
                            style="border-radius: 70%; width: 50px; height: 50px;">
                    @else
                        <div class="user-icon-placeholder"
                            style="background-color: #ccc; border-radius: 70%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-user-circle user-icon" style="font-size: 30px; color: #666;"></i>
                        </div>
                    @endif
                </div>
                <div class="pull-right">

                    <a href="{{ route('user.edit', $user->id) }}">
                        <i class="fa fa-edit"></i>
                        <h3 class="box-title">Edit Profile</h3>
                    </a>
                </div>
            </div>

            <div class="box-body">
                <p><strong>Name:</strong>  {{ $user->name }}</p>
                <p><strong>Email:</strong>  {{ $user->email }}</p>
                <p><strong>Designation:</strong>  {{ $user->designation }}</p>
                <p><strong>Member Since:</strong>  {{ $user->created_at->format('d, M. Y') }}</p>

            </div>
        </div>
    </div>
@endsection
