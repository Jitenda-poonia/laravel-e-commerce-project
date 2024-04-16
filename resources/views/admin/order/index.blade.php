@extends('layouts.admin')
@push('title')
    <title> Admin | Order list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Order List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Order List</li>

        </ol>
    </section>
    <div class="col-md-12">
        <div class="box">

            @if (session()->has('success'))
                <div class="callout callout-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            {{-- table start --}}
            <div class="box-body">
                <table id="myTable" class="table table-bordered display" style="overflow: auto;display:block;">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            {{-- <th>Country</th> --}}
                            <th>Pincode</th>
                            {{-- <th>Subtotal</th>
                            <th>Coupon</th>
                            <th>Coupon Discount</th>
                            <th>Shipping Cost</th> --}}
                            <th>Total Amount</th>
                            {{-- <th>Payment Method</th> --}}
                            {{-- <th>Shipping Method</th> --}}
                            <th>Order Date</th>
                            <th>view Detail</th>
                            <th><i class="fa fa-download"></i> Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $order->order_increment_id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->city }}</td>
                                <td>{{ $order->state }}</td>
                                {{-- <td>{{ $order->country }}</td> --}}
                                <td>{{ $order->pincode }}</td>
                                {{-- <td>{{ $order->subtotal }}</td>
                                <td>{{ $order->coupon ?? 'No' }}</td>
                                <td>{{ $order->coupon_discount }}</td>
                                <td>{{ $order->shipping_cost }}</td> --}}
                                <td>₹{{ $order->total }}</td>
                                {{-- <td>{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</td> --}}
                                {{-- <td>{{ ucwords(str_replace('_', ' ', $order->shipping_method)) }}</td> --}}
                                <td>{{ $order->created_at }}</td>

                                <!-- Add any action buttons or links here -->
                                <td><a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-success fa fa-eye">View</a></td>

                                <td>
                                    <a href="{{ route('order.invoice', $order->id) }}" class="btn btn-success fa fa-print"> Invoice</a>
                                  </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            {{-- table end --}}

        </div>


    </div>
    <!-- Datatable initialization script -->

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
