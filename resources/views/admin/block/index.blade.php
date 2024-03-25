@extends('layouts.admin')
@push('title')
    <title> Admin | Block list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Block List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Block</li>
            <li>
                @can('block_create')
                    <a href="{{ route('block.create') }}"><i class="fa fa-plus-square"></i>Block</a>
                @endcan
            </li>
            <li class="active">Block List</li>
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
                            <th>Ordering</th>
                            <th>Identifier</th>
                            <th>Status</th>
                            <th style="width: 40px">Image</th>
                            @if (Gate::allows('block_edit') or Gate::allows('block_delete'))
                                <th style="width: 40px">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blocks as $key => $block)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $block->title }}</td>
                                <td>{{ $block->heading }}</td>
                                <td>{{ $block->ordering }}</td>
                                <td>{{ $block->identifier }}</td>
                                <td>{{ $block->status == 1 ? 'Enable' : 'Disable' }}</td>
                                <td>
                                    <img src="{{ $block->getFirstMediaUrl('image', 'thumb') }}" / width="60px">

                                </td>
                                @if (Gate::allows('block_edit') or Gate::allows('block_delete'))
                                    <td>
                                        @can('block_edit')
                                             <a href="{{ route('block.edit', $block->id) }}"
                                                class="btn btn-block btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('block_delete')
                                            <form action="{{ route('block.destroy', $block->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-block btn-danger"
                                                    onclick="return confirm('Are you sure ? you want to delete this block')"><i
                                                        class="fa fa-trash"></i>Delete</button>

                                            </form>
                                        @endcan

                                    </td>
                                @endif
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
