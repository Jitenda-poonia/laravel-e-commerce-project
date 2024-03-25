@extends('layouts.admin')
@push('title')
    <title> Admin | Category list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Category List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Category</li>
            <li>
                @can('category_create')
                    <a href="{{ route('category.create') }}"><i class="fa fa-plus-square"></i>Category</a>
                @endcan
            </li>
            <li class="active">Category List</li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box">

            @if (session()->has('success'))
                <div class="form-group has-success">
                    <label class="control-label" for="">
                        {{ session()->get('success') }}
                    </label>
                </div>
            @endif
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover display" id="myTable">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th style="width: 40px">Status</th>
                            <th style="width: 40px">Show In Manu </th>
                            <th>Products</th>
                            <th style="width: 40px">Action</th>
                            <th style="width: 40px">View Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->status == 1)
                                        <button class="btn btn-block btn-success btn-sm">Active</button>
                                    @else
                                        <button class="btn btn-block btn-danger btn-sm">Inactive</button>
                                    @endif
                                </td>

                                <td>
                                    @if ($category->show_in_menu == 1)
                                        <button class="btn btn-block btn-info btn-sm">Yes</button>
                                    @else
                                        <button class="btn btn-block btn-warning btn-sm">No</button>
                                    @endif
                                </td>
                                <td>{{implode(' ,',$category->products()->pluck('name')->toArray())}}</td>

                                <td>
                                    @can('category_edit')
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-block btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                    @endcan
                                    @can('category_delete')
                                        <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-block btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                        </form>
                                    @endcan

                                </td>
                                <td>
                                    @can('category_show')
                                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-block btn-info"><i
                                                class="fa fa-eye"></i>View Detail</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>


    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
