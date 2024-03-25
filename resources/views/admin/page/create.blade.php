@extends('layouts.admin')
@push('title')
    <title> Admin |add Page</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Add Page
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Page</li>
            <li class="active">Add Page</li>
            <li>
                @can('page_index')
                    <a href="{{ route('page.index') }}"><i class="fa fa-list"></i> Page List</a>
                @endcan
            </li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-header">

                        <form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Menu Page</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="">Select</option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                        value="{{ old('title') }}">

                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" placeholder="Enter heading"
                                        value="{{ old('heading') }}">

                                    @error('heading')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Ordering</label>
                                    <input type="number" name="ordering" class="form-control" placeholder="ordering"
                                        value="{{ old('ordering') }}">

                                    @error('ordering')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Url Key</label>
                                    <input type="text" name="url_key" class="form-control" placeholder="url key"
                                        value="{{ old('url_key') }}">

                                    @error('url_key')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option selected disabled value="">Select</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable</option>
                                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disable</option>
                                    </select>

                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">image upload</label>
                                    <input type="file" id="exampleInputFile" name="image">

                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class='box-body pad'>
                                    <label>Description</label>


                                    <textarea id="editor1" name="description">
                                    {{ old('description') }}
                                </textarea>

                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
