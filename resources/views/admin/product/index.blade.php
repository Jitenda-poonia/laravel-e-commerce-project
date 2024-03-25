@extends('layouts.admin')
@push('title')
    <title> Admin | Product list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Product List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Product</li>
            <li>
                @can('product_create')
                <a href="{{ route('product.create') }}"><i class="fa fa-plus-square"></i> Product</a>
                @endcan
            </li>
            <li class="active">Product List</li>
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
                <table class="table table-striped table-bordered table-hover display" id="myTable">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Is Featured</th>
                            <th>SKU</th>
                            <th>QTY</th>
                            <th>Stock Status</th>
                            <th>Weight</th>
                            <th>Price</th>
                            <th>Special Price</th>
                            <th>Category</th>
                            <th style="width: 40px">Action</th>
                            <th  style="width: 40px">view Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                   @if ($product->status ==1 )
                                   <button class="btn btn-block btn-success btn-sm">Active</button>
                                   @else
                                   <button class="btn btn-block btn-danger btn-sm">Inactive</button>
                                   
                                   @endif
                                </td>
                                <td>{{ $product->is_featured == 1 ? 'Yes' : 'No' }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>
                                @if ($product->stock_status ==1 )
                                <button class="btn btn-block btn-info btn-sm">In stock</button>
                                @else
                                <button class="btn btn-block btn-warning btn-sm">Out of stock</button>
                                
                                @endif
                                </td>

                                <td>{{ $product->weight }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->special_price }}</td>
                                
                                <td>{{ implode(', ', $product->categories()->pluck('name')->toArray()) }}</td>
                                <td>
                                    @can('product_edit')
                                        <a href="{{ route('product.edit', $product->id) }}"
                                            class="btn btn-block btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                    @endcan
                                    @can('product_delete')
                                        <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-block btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                        </form>
                                    @endcan

                                </td>
                                <td>
                                    @can('product_show')
                                    <a href="{{ route('product.show', $product->id) }}"
                                    class="btn btn-block btn-info"><i class="fa fa-eye"></i>view</a>
                                    @endcan
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
