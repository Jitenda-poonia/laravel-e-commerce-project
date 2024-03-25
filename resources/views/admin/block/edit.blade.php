@extends('layouts.admin')
@push('title')
    <title>
        Admin |Edit block</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Edit Block
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Block</li>
            <li>
                @can('block_create')
                    <a href="{{ route('block.create') }}"><i class="fa fa-plus-square"></i>Block</a>
                @endcan
            </li>
            <li>
                @can('block_index')
                    <a href="{{ route('block.index') }}"><i class="fa fa-tasks"></i>Block List</a>
                @endcan
            </li>
            <li class="active">Edit Block</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-header">
                        <form action="{{ route('block.update', $block->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                        value="{{ $block->title }}">
                                    <p class="help-block" style="color: red">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" placeholder="Enter heading"
                                        value="{{ $block->heading }}">
                                    <p class="help-block" style="color: red">
                                        @error('heading')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Ordering</label>
                                    <input type="number" name="ordering" class="form-control" placeholder="ordering"
                                        value="{{ $block->ordering }}">
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
                                        <option value="1" {{ $block->status == 1 ? 'selected' : '' }}>Enable</option>
                                        <option value="2" {{ $block->status == 2 ? 'selected' : '' }}>Disable</option>
                                    </select>
                                    <p class="help-block" style="color: red">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">image upload</label>
                                    <input type="file" id="exampleInputFile" name="image">
                                    <p class="help-block" style="color: red">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class='box-body pad'>
                                    <label>Description</label>
                                    <textarea id="editor1" name="description" rows="10" cols="80">
                                    {{ $block->description }}
                                  </textarea>
                                    <p class="help-block" style="color: red">
                                        @error('description')
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
