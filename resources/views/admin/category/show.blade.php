@extends('layouts.admin')
@push('title')
    <title> Admin | show category</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Category information
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Category</li>
            <li>
                <a href="{{ route('category.create') }}"><i class="fa fa-plus-square"></i> Category</a>
            </li>
            <li>
                <a href="{{ route('category.index') }}"><i class="fa fa-list"></i> Category List</a>
            </li>
            <li class="active">Category information </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Category information</h3>
                        <a href="{{ route('category.index') }}" class="btn btn-primary fa fa-reply"
                            style="float: right;">Back</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">

                            <tr>
                                <th>Parent Category</th>
                                <td>{{ subCategoryName($category->category_parent_id) }}</td>
                            </tr>
                            <tr>
                                <th>Category name</th>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th>Show In Menu</th>
                                <td>{{ $category->show_in_menu == 1 ? 'Yes' : 'No' }}</td>
                            </tr>

                            <tr>
                                <th>Short Description</th>
                                <td>{{ $category->short_description }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{!! $category->description !!}</td>
                            </tr>

                            <tr>
                                <th>URL Key</th>
                                <td>{{ $category->url_key }}</td>
                            </tr>

                            <tr>
                                <th>Meta Tag</th>
                                <td>{{ $category->meta_tag ?? 'No'}}</td>
                            </tr>

                            <tr>
                                <th>Meta Title</th>
                                <td>{{ $category->meta_title ?? 'No'}}</td>
                            </tr>

                            <tr>
                                <th>Meta Description</th>
                                <td>{{ $category->meta_description ?? 'No' }}</td>
                            </tr>
                           
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </section>
@endsection
