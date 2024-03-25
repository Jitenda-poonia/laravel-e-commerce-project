@extends('layouts.admin')
@push('title')
    <title> Admin |role list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Role List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Role</li>
            <li>
                @can('manage_role')
                    <a href="{{ route('role.create') }}"><i class="fa fa-plus-square"></i> Role</a>
                @endcan
            </li>
            <li class="active">Role List</li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box">

            @if (session()->has('success'))
                <div class="callout callout-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="box-body">
                <table class="table table-bordered" id="myTable">
                    <thead>
                    <tr>
                        <th style="width: 30px">#</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th style="width: 40px">Edit</th>
                        <th style="width: 40px">Delete</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ implode(' ,', $role->permissions->pluck('name')->toArray()) }}</td>
                                @can('manage_role')
                                    <td>
                                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-block btn-primary"><i
                                                class="fa fa-edit"></i> Edit</a>

                                    </td>
                                    <td>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-block btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
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
