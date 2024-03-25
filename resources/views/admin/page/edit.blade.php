@extends('layouts.admin')
@push('title')
    <title> Admin | edit Page</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Edit Page
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Page</li>
            <li> 
                @can('page_create')
                <a href="{{ route('page.create') }}"><i class="fa fa-plus-square"></i> Page</a>
                @endcan
            </li>
            <li> 
                @can('page_index')
                <a href="{{ route('page.index') }}"><i class="fa fa-tasks"></i> Page List</a>
                @endcan

            </li>
            <li class="active">Edit Page</li>
        </ol>
    </section>
   
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                  
                    <form action="{{ route('page.update' ,$page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label>Menu Page</label>
                                <select class="form-control" name="parent_id">
                                    <option  value="">Select</option>
                                    @foreach ($pages as $prntPage)
                                        <option value="{{$prntPage->id}}">{{$prntPage->title}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title"
                                    value="{{ $page->title }}">
                                 <p class="help-block" style="color: red">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Heading</label>
                                <input type="text" name="heading" class="form-control" placeholder="Enter heading"
                                    value="{{ $page->heading}}">
                                <p class="help-block" style="color: red">
                                    @error('heading')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Ordering</label>
                                <input type="number" name="ordering" class="form-control" placeholder="ordering"
                                    value="{{ $page->ordering}}">
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
                                    <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>Enable</option>
                                    <option value="2" {{ $page->status == 2 ? 'selected' : '' }}>Disable</option>
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


                                <textarea id="editor1" name="description">
                                    {{$page->description}}
                                  </textarea>

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