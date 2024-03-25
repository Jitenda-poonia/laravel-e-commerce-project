@extends('layouts.admin')
@push('title')
    <title> Admin |add category</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Add Category
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Category</li>
            <li class="active">Add Category</li>
            <li>
                @can('category_index')
                    <a href="{{ route('category.index') }}"><i class="fa fa-list"></i>Category List</a>
                @endcan
            </li>

        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Catogry

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
                    <form role="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub Category</label>
                                        <select name="category_parent_id" class="form-control">
                                            <option value="">Select sub category</option>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach (categories() as $category)
                                                <option value="{{ $category->id }}">{{ $i . '.' }}{{ $category->name }}
                                                </option>
                                                @php
                                                    $j = 1;
                                                @endphp
                                                @foreach (SubCategories($category->id) as $subCategory)
                                                    <option value="{{ $subCategory->id }}">
                                                        {!! '&nbsp' !!}{{ $i . '.' . $j++ }}{{ $subCategory->name }}
                                                    </option>
                                                    @php
                                                        $k = 1;
                                                    @endphp
                                                    @foreach (subsubCategories($subCategory->id) as $subsubCategory)
                                                        <option value="{{ $subsubCategory->id }}">
                                                            {!! '&nbsp;&nbsp;&nbsp;&nbsp;' !!}{{ $i . '.' . $j++ . '.' . $k }}{{ $subsubCategory->name }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label>Category name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" placeholder="Enter category name">
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
                                        <label>Show In Menu</label>
                                        <select name="show_in_menu" class="form-control">
                                            <option value="">Select Menu</option>
                                            <option value="1" {{ old('show_in_menu') == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="0" {{ old('show_in_menu') == 1 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('show_in_menu')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>





                                    <div class="form-group">
                                        <label>URL Key</label>
                                        <input type="text" name="url_key" class="form-control"
                                            value="{{ old('url_key') }}" placeholder="Product url key">

                                    </div>
                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                        <label>Products</label>
                                        <select name="products[]"  class="form-control" multiple>
                                            @foreach ($products as $_product)
                                                <option value="{{$_product->id}}">{{$_product->name}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label >image upload</label>
                                        <input type="file"  name="image" multiple>
    
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
    
                                    </div>
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
