@extends('layouts.admin')
@push('title')
    <title> Admin |add prodect</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Add Prodect
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Prodect</li>
            <li class="active">Add Prodect</li>
            <li>
                @can('product_index')
                    <a href="{{ route('product.index') }}"><i class="fa fa-list"></i>Prodect List</a>
                @endcan

            </li>

        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Product

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
                    <form role="form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" placeholder="Enter product name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Is featured</label>
                                        <select name="is_featured" class="form-control">
                                            <option value="">Select featured</option>
                                            <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2" {{ old('is_featured') == 2 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('is_featured')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Stock Keeping Unit(sku)</label>
                                        <input type="text" class="form-control" name="sku" step="any"
                                            value="{{ old('sku') }}" placeholder="Product sku">
                                        @error('sku')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity (qty)</label>
                                        <input type="number" class="form-control" step="any" name="qty"
                                            value="{{ old('qty') }}" placeholder="Product qty">
                                        @error('qty')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Stock status</label>
                                        <select name="stock_status" class="form-control">
                                            <option value="">Stock Status</option>
                                            <option value="1" {{ old('stock_status') == 1 ? 'selected' : '' }}>In
                                                Stock
                                            </option>
                                            <option value="2" {{ old('stock_status') == 2 ? 'selected' : '' }}>Out of
                                                Stock
                                            </option>
                                        </select>
                                        @error('stock_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="number" class="form-control" step="any" name="weight"
                                            value="{{ old('weight') }}" placeholder="Product weight">
                                        @error('weight')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" step="any" name="price"
                                            value="{{ old('price') }}" placeholder="Product price">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Special price</label>
                                        <input type="number" class="form-control" step="any" name="special_price"
                                            value="{{ old('special_price') }}" placeholder="Product special price">
                                    </div>

                                    <div class="form-group">
                                        <label>URL Key</label>
                                        <input type="text" name="url_key" class="form-control"
                                            value="{{ old('url_key') }}" placeholder="Product url key">

                                    </div>
                                    <div class="form-group">
                                        <label>Special price from</label>
                                        <input type="datetime-local" class="form-control" name="special_price_from"
                                            value="{{ old('special_price_from') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Special price to</label>
                                        <input type="datetime-local" class="form-control" name="special_price_to"
                                            value="{{ old('special_price_to') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            value="{{ old('meta_tag') }}" placeholder="Product meta tag">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ old('meta_title') }}" placeholder="Product meta title">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2">{{ old('meta_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor1" class="form-control" cols="10" rows="4">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Related Product</label>
                                        <select name="related_product[]" class="form-control" multiple>
                                            <option value="">Selecte Related Product</option>
                                            @foreach ($relatedProducts as $relatedProduct)
                                                <option value="{{ $relatedProduct->id }}">{{ $relatedProduct->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label>Categories</label>
                                        <select name="categories[]" class="form-control" multiple>
                                            @foreach ($categories as $_category)
                                                <option value="{{ $_category->id }}">{{ $_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label> Thumbnail image </label>
                                        <input type="file" name="thumbnail_image">

                                        @error('thumbnail_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>image upload</label>
                                        <input type="file" name="image[]" multiple>

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>Attribute:-</label>

                                        @foreach (getAttribute() as $key => $attribute)
                                            <div class="checkbox">
                                                <label style="font-weight: bold;">
                                                    {{++$key.'.'}}<input type="hidden" name = 'attributes[]'
                                                        value="{{ $attribute->id }}">{{ $attribute->name }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                @foreach ($attribute->attributeValue as $attributeValue)
                                                    <label>
                                                        <input type="checkbox"
                                                            name = 'attribute_values[{{ $attribute->id }}][]'
                                                            value="{{ $attributeValue->id }}">{{ $attributeValue->name }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endforeach

                                    </div>
                                    {{-- <div style="float:left;width:100%;margin-bottom:15px;">
                                        @foreach (getAttribute() as $attribute)
                                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                                <input type="hidden" name="attributes[]"
                                                    value="{{ $attribute->id }}">
                                                <label> <span style="color:red;">*</span>{{ $attribute->name }}</label>
                                                <select
                                                    class="form-control form-control-user @error('attribute_values') is-invalid @enderror"
                                                    name="attribute_values[{{ $attribute->id }}][]" multiple>
                                                    @foreach ($attribute->attributeValue as $_attValue)
                                                        <option value="{{ $_attValue->id }}">{{ $_attValue->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('attribute_values')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div> --}}
                                    <div class="box-footer">
                                        <input type="submit" name="save" class="btn btn-primary" value="Save">
                                        <input type="submit" name="save&new" class="btn btn-primary" value="Save&new">

                                    </div>

                                </div>
                            </div> <!-- row end -->

                        </div><!-- /.box-body -->


                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
