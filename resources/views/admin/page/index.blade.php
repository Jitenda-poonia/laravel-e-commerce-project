@extends('layouts.admin')
@push('title')
    <title> Admin | page list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Page List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Page</li>
            <li>
                @can('page_create')
                    <a href="{{ route('page.create') }}"><i class="fa fa-plus-square"></i> Page</a>
                @endcan
            </li>
            <li class="active">Page List</li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box">

            @if (session()->has('success'))
                <div class="callout callout-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover display" id="myTable">
                    <thead>
                        <tr>
                            <th style="width: 50px">Sr.No</th>
                            <th>Title</th>
                            <th>Heading</th>
                            <th>Url key</th>
                            <th>Ordering</th>
                            <th>Status</th>
                            <th style="width: 40px">Image</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $key => $page)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->heading }}</td>
                                <td>{{ $page->url_key }}</td>
                                <td>{{ $page->ordering }}</td>
                                <td>{{ $page->status == 1 ? 'Enable' : 'Disable' }}</td>
                                <td>
                                    <img src="{{ $page->getFirstMediaUrl('image', 'thumb') }}" / width="60px">

                                </td>
                                <td>
                                    @can('page_edit')
                                        <a href="{{ route('page.edit', $page->id) }}" class="btn btn-block btn-primary"><i
                                                class="fa fa-edit"></i> Edit</a>
                                    @endcan
                                    @can('page_delete')
                                        <form action="{{ route('page.destroy', $page->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-block btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                        </form>
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
