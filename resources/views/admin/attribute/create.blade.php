@extends('layouts.admin')
@push('title')
    <title>
        Admin |add attribute</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Add Attribute
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Attribute</li>
            <li class="active">Add Attribute</li>
            <li>
                @can('attribute_index')
                    <a href="{{ route('attribute.index') }}"><i class="fa fa-list"></i>Attribute List</a>
                @endcan
            </li>

        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Attribute

                            @if (session()->has('success'))
                                <div class="form-group has-success">
                                    <label class="control-label" for="">
                                        {{ session()->get('success') }}
                                    </label>
                                </div>
                            @endif
                        </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('attribute.store') }}" method="POST">
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Attribute name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" placeholder="Enter attribute name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Is Variant</label>
                                        <select name="is_variant" class="form-control">
                                            <option value="">Select Variant</option>
                                            <option value="1" {{ old('is_variant') == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2" {{ old('is_variant') == 2 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('is_variant')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Name Key</label>
                                        <input type="text" name="name_key" class="form-control"
                                            value="{{ old('url_key') }}" placeholder="attribute name key">

                                    </div>

                                    <div class="form-group">
                                        <label>Attribute Value :- </label>
                                        <div class="box-body">
                                            <table class="table table-bordered table-data">

                                                <tr>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>
                                                        <button type="button" class="btn btn-primary add_more">+</button>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="atrName[]" class="form-control">
                                                        @error('atrName.0')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select name="atrStatus[]" class="form-control">
                                                            <option value="">Select Status</option>
                                                            <option value="1">Enable</option>
                                                            <option value="2">Disable</option>
                                                        </select>
                                                        @error('atrStatus.0')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>


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

    <script>
        $(document).ready(function() {
            $(".add_more").click(function() {
                var tabaleRow = ` <tr>
                                <td>
                                    <input type="text" name="atrName[]" class="form-control">
                                </td>
                                <td>
                                    <select name="atrStatus[]" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="1">Enable</option>
                                        <option value="2">Disable</option>
                                    </select>
                                </td>
                                <td><button type="button" class="remove btn btn-danger">X</button></td>
                            </tr>`;
                $(".table-data").append(tabaleRow);


            });
            $('.table-data').delegate('.remove', 'click', function() {
                $(this).closest('tr').remove();


            });

        });
    </script>
@endsection
