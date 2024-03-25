@extends('layouts.admin')
@push('title')
    <title> Admin |slider list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Slider List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Slider</li>
            <li>
                @can('slider_create')
                    <a href="{{ route('slider.create') }}"><i class="fa fa-sliders"></i>Add Slider</a>
                @endcan
            </li>
            <li class="active">Slider List</li>
        </ol>
    </section>
    <div class="col-md-8">
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
                            <th>Ordering</th>
                            <th>Status</th>
                            <th style="width: 40px">Image</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $key => $slider)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->ordering }}</td>
                                <td>{{ $slider->status == 1 ? 'Enable' : 'Disable' }}</td>
                                <td>
                                    <img src="{{ $slider->getFirstMediaUrl('image', 'thumb') }}" / width="120px">

                                </td>
                                <td> 
                                    @can('slider_edit')
                                        <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-block btn-primary"><i
                                                class="fa fa-edit"></i> Edit</a>
                                    @endcan
                                    @can('slider_delete')
                                        <form action="{{ route('slider.destroy', $slider->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-block btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div><!-- /.box-body -->

        </div><!-- /.box -->


    </div>
    <!-- Datatable initialization script -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
