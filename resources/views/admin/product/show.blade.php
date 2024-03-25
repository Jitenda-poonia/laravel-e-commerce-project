@extends('layouts.admin')

@section('content')

<section class="content-header">
    <h1>
        Product information
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Manage Product</li>
        <li>
            <a href="{{ route('product.create') }}"><i class="fa fa-plus-square"></i> Product</a>
        </li>
        <li>
            <a href="{{ route('product.index') }}"><i class="fa fa-list"></i> Product List</a>
        </li>
        <li class="active">Product information </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Product information</h3>
                <a href="{{ route('product.index') }}" class="btn btn-primary" style="float: right;">Back</a>
              </div><!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered">
                  <tr>
                      <th>Product name</th>
                      <td>{{ $product->name }}</td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>{{ ($product->status==1) ? 'Enable':'Disable' }}</td>
                  </tr>
                  <tr>
                    <th>Is Featured</th>
                    <td>{{ ($product->is_featured==1) ? 'YES':'NO' }}</td>
                  </tr>

                  <tr>
                    <th>SKU (Stock Keeping Unit)</th>
                    <td>{{ $product->sku }}</td>
                  </tr>

                  <tr>
                    <th>QTY (Quantity)</th>
                    <td>{{ $product->qty }}</td>
                  </tr>

                  <tr>
                    <th>Stock Status</th>
                    <td>{{ ($product->stock_status==1) ? 'In Stock': 'Out of Stock' }}</td>
                  </tr>

                  <tr>
                    <th>Weight</th>
                    <td>{{ $product->weight }}</td>
                  </tr>

                  <tr>
                    <th>Price</th>
                    <td>{{ $product->price }}</td>
                  </tr>

                  <tr>
                    <th>Special Price</th>
                    <td>{{ $product->special_price }}</td>
                  </tr>

                  <tr>
                    <th>Special Price From</th>
                    <td>{{ $product->special_price_from }}</td>
                  </tr>

                  <tr>
                    <th>Special Price To</th>
                    <td>{{ $product->special_price_to }}</td>
                  </tr>

                  <tr>
                    <th>Short Description</th>
                    <td>{{ $product->short_description }}</td>
                  </tr>

                  <tr>
                    <th>Related Product</th>
                    <td>{{ $product->related_product }}</td>
                  </tr>

                  <tr>
                    <th>URL Key</th>
                    <td>{{ $product->url_key }}</td>
                  </tr>

                  <tr>
                    <th>Meta Tag</th>
                    <td>{{ $product->meta_tag }}</td>
                  </tr>

                  <tr>
                    <th>Meta Title</th>
                    <td>{{ $product->meta_title }}</td>
                  </tr>

                  <tr>
                    <th>Meta Description</th>
                    <td>{{ $product->meta_description }}</td>
                  </tr>

                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
    </div>
</section>


@endsection