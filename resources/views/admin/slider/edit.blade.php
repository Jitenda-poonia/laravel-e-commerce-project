@extends('layouts.admin')
@push('title')
    <title> Admin | edit slider</title>
@endpush
@section('content')

    @extends('layouts.admin')
    @push('title')
        <title> Admin |Edit slider</title>
    @endpush
@section('content')
    <section class="content-header">
        <h1>
            Edit Slider
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>
                @can('slider_create')
                    <a href="{{ route('slider.create') }}"><i class="fa fa-sliders"></i>Add Slider</a>
                @endcan
            </li>
            <li>
                @can('slider_index')
                    <a href="{{ route('slider.index') }}"><i class="fa fa-sliders"></i> slider List</a>
                @endcan
            </li>
            <li class="active">Edit Slider</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">

                <div class="box box-primary">
                    
                    <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title"
                                    value="{{ $slider->title }}">
                                <p class="help-block" style="color: red">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Ordering</label>
                                <input type="number" name="ordering" class="form-control" placeholder="ordering"
                                    value="{{ $slider->ordering }}">
                                <p class="help-block" style="color: red">
                                    @error('ordering')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option selected disabled value="">Select</option>
                                    <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Enable</option>
                                    <option value="2" {{ $slider->status == 2 ? 'selected' : '' }}>Disable</option>
                                </select>
                                <p class="help-block" style="color: red">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image Upload</label>
                                <input type="file" id="exampleInputFile" name="image"
                                    value='{{ $slider->getFirstMediaUrl('image') }}'>

                                <p class="help-block" style="color: red">
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </p>

                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@endsection
