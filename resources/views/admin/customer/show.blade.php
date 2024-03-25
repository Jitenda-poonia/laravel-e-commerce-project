@extends('layouts.admin')
@push('title')
    <title> Admin | show Customer </title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Customer Order List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Customer</li>

            <li>
                <a href="{{ route('customer.index') }}"><i class="fa fa-list"></i> Customer List</a>
            </li>
            <li class="active">Customer Order List </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Customer Order List</h3>
                        <a href="{{ route('customer.index') }}" class="btn btn-primary fa fa-reply"
                            style="float: right;">Back</a>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <table id="myTable" class="table table-bordered display" style="overflow: auto;display:block;" id="myTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Order Date</th>
                                    <th>view Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $order->order_increment_id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->created_at }}</td>
                                       <td><a href="{{ route('order.show', $order->id) }}"
                                            class="btn btn-primary btn-success fa fa-eye">view</a></td>
                                    </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </section>
    <!-- Datatable initialization script -->
<script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
  </script>
@endsection
