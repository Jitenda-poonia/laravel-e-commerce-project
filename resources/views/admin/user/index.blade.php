@extends('layouts.admin')
@push('title')
    <title> Admin | user list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            User List
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
            <li class="active">User List</li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User List</h3>
            </div>

            @if (session()->has('success'))
                <div class="callout callout-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover display" id="myTable">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th>Image</th>
                            <th  style="width: 40px">Role</th>
                            @if (Gate::allows('user_edit') or Gate::allows('user_delete'))
                                <th style="width: 40px">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->designation }}</td>
                                <td>
                                    <img src="{{ $user->getFirstMediaUrl('image', 'thumb') }}" / height="100px" width="100px" >

                                </td>
                                <td>{{ implode(',', $user->Roles->pluck('name')->toArray()) }}</td>
                                @if (Gate::allows('user_edit') or Gate::allows('user_delete'))
                                    <td>
                                        @can('user_edit')
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-block btn-primary"><i
                                                    class="fa fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('user_delete')
                                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-block btn-danger"><i
                                                        class="fa fa-trash"></i>Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div><!-- /.box-body -->

        </div><!-- /.box -->


    </div>
    <!-- Datatable initialization script -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
