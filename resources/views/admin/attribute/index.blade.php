@extends('layouts.admin')
@push('title')
    <title> Admin | attribute list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Attribute List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Attribute</li>
            <li>
                @can('attribute_create')
                    <a href="{{ route('attribute.create') }}"><i class="fa fa-plus-square"></i>Attribute</a>
                @endcan
            </li>
            <li class="active">Attribute List</li>
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
                            <th style="width: 40px">Variant</th>
                            <th>Name key</th>
                            <th>Attribute Value</th>
                            <th style="width: 40px">Action</th>
                            <th style="width: 40px">view Detail</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributes as $key => $attribute)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>
                                    @if ($attribute->status == 1)
                                        <button class="btn btn-block btn-success btn-sm">Active</button>
                                    @else
                                        <button class="btn btn-block btn-danger btn-sm">Inactive</button>
                                    @endif
                                </td>

                                <td>
                                    @if ($attribute->is_variant == 1)
                                        <button class="btn btn-block btn-info btn-sm">Yes</button>
                                    @else
                                        <button class="btn btn-block btn-warning btn-sm">No</button>
                                    @endif
                                </td>
                                <td>{{ $attribute->name_key }}</td>
                                {{-- attributeValue -> Attribute MOdel se --}}
                                <td>{{implode(', ',$attribute->attributeValue->pluck('name')->toArray())}}</td> 
                                <td>
                                    @can('attribute_edit')
                                        <a href="{{ route('attribute.edit', $attribute->id) }}"
                                            class="btn btn-block btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                    @endcan
                                    @can('attribute_delete')
                                        <form action="{{ route('attribute.destroy', $attribute->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-block btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                        </form>
                                    @endcan

                                </td>
                               <td>
                                @can('attribute_show')
                                        <a href="{{ route('attribute.show', $attribute->id) }}"
                                            class="btn btn-block btn-primary"><i class="fa fa-eye"></i>View Detail</a>
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
