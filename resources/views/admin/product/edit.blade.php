@extends('layouts.admin')
@push('title')
    <title> Admin |Edit prodect</title>
@endpush
@section('content')
<section class="content-header">
        <h1>
            Edit Prodect
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Prodect</li>
            <li>
                @can('product_create')
                    <a href="{{ route('product.create') }}"><i class="fa fa-plus-square"></i>Add Prodect</a>
                @endcan
            </li>
            <li>
                @can('product_index')
                    <a href="{{ route('product.index') }}"><i class="fa fa-list"></i>Prodect List</a>
                @endcan

            </li>
            <li class="active">Edit Prodect</li>

        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Edit Product</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="{{ route('product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $product->name }}" placeholder="Enter product name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Inactive
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
                                            <option value="1" {{ $product->is_featured == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2" {{ $product->is_featured == 2 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('is_featured')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Stock Keeping Unit(sku)</label>
                                        <input type="text" class="form-control" name="sku" step="any"
                                            value="{{ $product->sku }}" placeholder="Product sku">
                                        @error('sku')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity (qty)</label>
                                        <input type="number" class="form-control" step="any" name="qty"
                                            value="{{ $product->qty }}" placeholder="Product qty">
                                        @error('qty')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Stock status</label>
                                        <select name="stock_status" class="form-control">
                                            <option value="">Stock Status</option>
                                            <option value="1" {{ $product->stock_status == 1 ? 'selected' : '' }}>In
                                                Stock</option>
                                            <option value="2" {{ $product->stock_status == 2 ? 'selected' : '' }}>Out
                                                of Stock</option>
                                        </select>
                                        @error('stock_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="number" class="form-control" step="any"
                                            name="weight"value="{{ $product->weight }}" placeholder="Product weight">
                                        @error('weight')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" step="any" name="price"
                                            value="{{ $product->price }}" placeholder="Product price">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Special price</label>
                                        <input type="number" class="form-control" step="any" name="special_price"
                                            value="{{ $product->special_price }}" placeholder="Product special price">
                                    </div>

                                    <div class="form-group">
                                        <label>Special price from</label>
                                        <input type="datetime-local" class="form-control" name="special_price_from"
                                            value="{{ $product->special_price_from }}">
                                    </div>


                                    <div class="form-group">
                                        <label>Special price to</label>
                                        <input type="datetime-local" class="form-control" name="special_price_to"
                                            value="{{ $product->special_price_to }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            value="{{ $product->meta_tag }}" placeholder="Product meta tag">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ $product->meta_title }}" placeholder="Product meta title">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2">{{ $product->meta_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2">{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">



                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor1" class="form-control" cols="10" rows="4">{{ $product->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Related Product</label>
                                        <select name="related_product[]" class="form-control" multiple>
                                            <option value="">Selecte Related Product</option>
                                            @foreach ($relatedProducts as $relatedProduct)
                                                <option value="{{ $relatedProduct->id }}"
                                                    {{ in_array($relatedProduct->id, explode(', ', $product->related_product) ?? []) ? 'selected' : '' }}>
                                                    {{ $relatedProduct->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Categories</label>
                                        <select name="categories[]" class="form-control" multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, $product->categories->pluck('id')->toArray() ?? []) ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
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
                                        <label>Attributes</label><br>

                                        @foreach (getAttribute() as $key => $attribute)
                                            <div class="checkbox">
                                                <label style="font-weight: bold;">
                                                    {{ ++$key.'.'}}<input type="hidden"
                                                        value="{{ $attribute->id }}" name="attributes[]"
                                                        {{ in_array($attribute->id, $productAttributes->pluck('attribute_id')->toArray()) ? 'checked' : '' }}>
                                                    {{ $attribute->name }}
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                @foreach ($attribute->attributeValue as $attributeValue)
                                                    <label>
                                                        <input type="checkbox" value="{{ $attributeValue->id }}"
                                                            name="attribute_values[{{ $attribute->id }}][]"
                                                            {{ in_array($attributeValue->id, $productAttributes->pluck('attribute_value_id')->toArray() ?? []) ? 'checked' : '' }}>
                                                        {{ $attributeValue->name }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- @foreach (getAttribute() as $attribute)
                                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                        <input type="hidden" name="attributes[]" value="{{$attribute->id}}">
                                        <span style="color:red;">*</span>{{$attribute->name}}</label>
                                        <select class="form-control form-control-user @error('attribute_values') is-invalid @enderror" name="attribute_values[{{$attribute->id}}][]" multiple>
                                            @foreach ($attribute->attributeValue as $_attributeValue)
                                            <option value="{{$_attributeValue->id}}" {{in_array($_attributeValue->id, $productAttributes->pluck('attribute_value_id')->toArray() ?? [])? 'selected': ''}}>{{$_attributeValue->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('attribute_values')
                                        <span class="text-danger">{{$message}}</span>  
                                        @enderror
                                        
                                    </div>
                                    @endforeach --}}
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>

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
