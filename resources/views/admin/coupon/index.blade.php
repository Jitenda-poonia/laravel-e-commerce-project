@extends('layouts.admin')
@push('title')
    <title> Admin | coupon list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Coupon List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage coupon</li>
            <li>
                @can('coupon_create')
                    <a href="{{ route('coupon.create') }}"><i class="fa fa-plus-square"></i>Coupon</a>
                @endcan
            </li>
            <li class="active">Coupon List</li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box">

            @if (session()->has('success'))
                <div class="form-group has-success">
                    <label class="control-label" for="">
                        {{ session()->get('success') }}
                    </label>
                </div>
            @endif
            <div class="box-body">
                <table id="myTable" class="table table-bordered display">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Coupon Code</th>
                            <th>Status</th>
                            <th>Valid From</th>
                            <th>Valid To</th>
                            <th>Discount Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->title }}</td>
                                <td>{{ $coupon->coupon_code }}</td>
                                <td>{{ $coupon->status ==1 ? 'Enable':'Disable' }}</td>
                                <td>{{ $coupon->valid_from }}</td>
                                <td>{{ $coupon->valid_to }}</td>
                                <td>{{ $coupon->discount_amount }}</td>
                                <td>
                                    <a href="{{ route('coupon.edit', $coupon->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this coupon?')">Delete</button>
                                    </form>
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
