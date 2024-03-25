@extends('layouts.admin')
@section('content')
    @push('title')
        <title> Admin |permission list</title>
    @endpush
    <section class="content-header">
        <h1>
            Permission List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Manage Permission</a></li>
            <li>
                @can('manage_permission')
                    <a href="{{ route('permission.create') }}" class="text bg-olive"><i class="fa fa-unlock"></i>Add Permission</a>
                @endcan
            </li>
            <li class="active">Permission List</li>
        </ol>
    </section>
    <div class="col-md-6">
        <div class="box">
            @if (session()->has('success'))
                <div class="callout callout-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover display" id="myTable">

                    <thead>
                        <tr>
                            <th style="width: 30px">#</th>
                            <th>Name</th>
                            <th style="width: 40px">Edit</th>
                            <th style="width: 40px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $permission->name }}</td>
                                @can('manage_permission')
                                    <td>
                                        <a href="{{ route('permission.edit', $permission->id) }}"
                                            class="btn btn-block btn-primary"><i class="fa fa-edit"></i> Edit</a>

                                    </td>
                                    <td>
                                        <form action="{{ route('permission.destroy', $permission->id) }}" method="post">
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
