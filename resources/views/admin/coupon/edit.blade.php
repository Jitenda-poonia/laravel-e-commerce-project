@extends('layouts.admin')
@push('title')
    <title> Admin |edit coupon</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Edit Coupon
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Coupon</li>

            <li>
                @can('coupon_create')
                    <a href="{{ route('coupon.create') }}"><i class="fa fa-pluse"></i>Add Coupon</a>
                @endcan

            </li>
            <li>
                @can('coupon_index')
                    <a href="{{ route('coupon.index') }}"><i class="fa fa-list"></i>Coupon List</a>
                @endcan

            </li>
            <li class="active">Edit Coupon</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Coupon

                            @if (session()->has('success'))
                                <div class="form-group has-success">
                                    <label class="control-label" for="">
                                        {{ session()->get('success') }}
                                    </label>
                                </div>
                            @endif
                        </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title"
                                    value="{{ $coupon->title }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Coupon Code</label>
                                <input type="text" class="form-control" name="coupon_code"
                                    placeholder="Enter coupon code" value="{{ $coupon->coupon_code }}">
                                @error('coupon_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select status</option>
                                    <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Enable</option>
                                    <option value="2" {{ $coupon->status == 2 ? 'selected' : '' }}>Disable</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Valid From</label>
                                <input type="datetime-local" class="form-control" name="valid_from"
                                    value="{{ $coupon->valid_from }}">
                                @error('valid_from')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Valid To</label>
                                <input type="datetime-local" class="form-control" name="valid_to"
                                    value="{{ $coupon->valid_to }}">
                                @error('valid_to')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Discount Amount</label>
                                <input type="number" class="form-control" name="discount_amount" step="0.01"
                                    placeholder="Enter discount amount" value="{{ $coupon->discount_amount }}">
                                @error('discount_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
