@extends('layouts.admin')
@push('title')
    <title> Admin | show attribute </title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Attribute information
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage attribute</li>
            <li>
                @can('attribute_create')
                    <a href="{{ route('attribute.create') }}"><i class="fa fa-plus-square"></i> Attribute</a>
                @endcan
            </li>
            <li>
                @can('attribute_index')
                    <a href="{{ route('attribute.index') }}"><i class="fa fa-list"></i> Attribute List</a>
                @endcan

            </li>
            <li class="active">Attribute information </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Attribute information</h3>
                        <a href="{{ route('attribute.index') }}" class="btn btn-primary fa fa-reply"
                            style="float: right;">Back</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">

                            <tr>
                                <th>Name</th>
                                <td>{{ $attribute->name }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>{{ $attribute->status == 1 ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th>Variant</th>
                                <td>{{ $attribute->variant == 1 ? 'Yes' : 'No' }}</td>
                            </tr>

                            <tr>
                                <th>Name Key</th>
                                <td>{{ $attribute->name_key }}</td>
                            </tr>
                            <tr>
                                <th>Attribute Value</th>

                                <td>
                                    {{ implode(', ', $attribute->atrValues->pluck('name')->toArray()) }}
                                </td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </section>
@endsection
