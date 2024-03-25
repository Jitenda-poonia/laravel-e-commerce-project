@extends('layouts.admin')
@push('title')
    <title> Admin |add block</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Add Block
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Block</li>
            <li class="active">Add Block</li>
            <li>
                @can('block_index')
                <a href="{{ route('block.index') }}"><i class="fa fa-tasks"></i>Block List</a>
                @endcan
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                   
                    <form action="{{ route('block.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title"
                                    value="{{ old('title') }}">
                                <p class="help-block" style="color: red">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Heading</label>
                                <input type="text" name="heading" class="form-control" placeholder="Enter heading"
                                    value="{{ old('heading') }}">
                                <p class="help-block" style="color: red">
                                    @error('heading')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Ordering</label>
                                <input type="number" name="ordering" class="form-control" placeholder="ordering"
                                    value="{{ old('ordering') }}">
                                <p class="help-block" style="color: red">
                                    @error('ordering')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Identifier</label>
                                <input type="text" name="identifier" class="form-control" placeholder="identifier"
                                    value="{{ old('identifier') }}">
                                <p class="help-block" style="color: red">
                                    @error('identifier')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option selected disabled value="">Select</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable</option>
                                    <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disable</option>
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
                                    {{old('description')}}
                                  </textarea>
                                  <p class="help-block" style="color: red">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </p>
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