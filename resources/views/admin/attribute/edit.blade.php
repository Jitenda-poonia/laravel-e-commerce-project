@extends('layouts.admin')
@push('title')
    <title> Admin |edit attribute</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Edit Attribute
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage Attribute</li>

            <li>
                @can('attribute_create')
                    <a href="{{ route('attribute.create') }}"><i class="fa fa-plus-square"></i> Attribute </a>
                @endcan
            </li>
            <li>
                @can('attribute_index')
                    <a href="{{ route('attribute.index') }}"><i class="fa fa-list"></i>Attribute List</a>
                @endcan
            </li>
            <li class="active">Edit Attribute</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Attribute

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
                    <form role="form" action="{{ route('attribute.update', $attribute->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Attribute name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $attribute->name }}" placeholder="Enter attribute name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1" {{ $attribute->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2" {{ $attribute->status == 2 ? 'selected' : '' }}>Inactive
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
                                            <option value="1" {{ $attribute->is_variant == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2" {{ $attribute->is_variant == 2 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('is_variant')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Attribute Value :-</label>
                                        <div class="box-body">
                                            <table class="table table-bordered table-data">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>
                                                        <button type="button" class="btn btn-primary add_more">+</button>
                                                    </th>
                                                </tr>
                                                @foreach ($attribute->attributeValue as $atrValue)
                                                    <tr>
                                                        <input type="hidden" name="atrvalueId[]"
                                                            value="{{ $atrValue->id }}">
                                                        <td>
                                                            <input type="text" name="atrName[]"
                                                                value="{{ $atrValue->name }}" class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="atrStatus[]" class="form-control">
                                                                <option value="">Select Status</option>
                                                                <option value="1"
                                                                    {{ $atrValue->status == 1 ? 'selected' : '' }}>Enable
                                                                </option>
                                                                <option value="2"
                                                                    {{ $atrValue->status == 2 ? 'selected' : '' }}>Disable
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td><button type="button" class="remove btn btn-danger">X</button>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>


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
