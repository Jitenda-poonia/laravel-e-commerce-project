@extends('layouts.admin')
@push('title')
    <title> Admin | User Profile</title>
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

    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    @if (auth()->user()->hasMedia('image'))
                        <img src="{{ auth()->user()->getFirstMediaUrl('image') }}" class="user-image" alt="User Image"
                            style="border-radius: 70%; width: 50px; height: 50px;">
                    @else
                    <div class="user-icon-placeholder" style="background-color: #ccc; border-radius: 70%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                       Na<i class="fa fa-user-circle user-icon" style="font-size: 30px; color: #666;"></i>
                    </div>
                    @endif
                </div>
                <a href="{{ route('user.edit', Auth::user()->id) }}">
                    <i class="fa fa-edit"></i>
                    <h3 class="box-title">Edit Profile</h3>
                </a>
            </div>

            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name :</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email :</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Designation :</th>
                        <td>{{ $user->designation }}</td>
                    </tr>
                    <tr>
                        <th>Member Since:</th>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d,M. Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
