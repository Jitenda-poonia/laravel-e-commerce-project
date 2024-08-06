@extends('layouts.admin')
@push('title')
    <title> Admin | Order List</title>
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
<<<<<<< HEAD
=======
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
>>>>>>> origin/main
                            <th>Order Date</th>
                            <th>Update Status</th>
                            <th>View Detail</th>
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
                                <td>
                                    @if ($order->user_id == 0)
                                        {{ 'user not registered' }}
                                    @else
                                        {{ $order->user_id }}
                                    @endif

                                </td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
<<<<<<< HEAD
=======
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
>>>>>>> origin/main
                                <td>{{ $order->created_at }}</td>

                                <td>
                                    <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <select name="status" id="status-{{ $order->id }}" class="form-control"
                                                onchange="this.form.submit()">
                                                <option value="pending"
                                                    {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="item_booked"
                                                    {{ $order->status == 'item_booked' ? 'selected' : '' }}>Booked
                                                </option>
                                                <option value="on_the_way"
                                                    {{ $order->status == 'on_the_way' ? 'selected' : '' }}>On The Way
                                                </option>
                                                <option value="delivered"
                                                    {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                                </option>
                                                <option value="cancelled"
                                                    {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                </option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td><a href="{{ route('order.show', $order->id) }}"
                                        class="btn btn-primary btn-success fa fa-eye">View</a></td>
                                <td>
                                    <a href="{{ route('order.invoice', $order->id) }}" class="btn btn-success fa fa-print">
                                        Invoice</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
