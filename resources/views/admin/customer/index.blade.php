@extends('layouts.admin')
@push('title')
    <title> Admin | Customer list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Customer List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Customer</li>

            <li class="active">Customer List</li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Customer List</h3>
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
                            <th style="width: 40px">View Detail</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('customer.show', $user->id) }}" class="btn btn-block btn-primary"><i
                                            class="fa fa-eye"></i> view</a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>


    </div>
    <!-- Datatable initialization script -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
