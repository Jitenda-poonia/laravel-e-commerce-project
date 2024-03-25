@extends('layouts.admin')
@push('title')
    <title> Admin | Enquiry list</title>
@endpush
@section('content')
    <section class="content-header">
        <h1>
            Enquiry List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Enquiry</li>

        </ol>
    </section>
    <div class="col-md-10">
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
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enquires as $key => $enquiry)
                            <tr>
                                <td>{{ ++$key . '.' }}</td>
                                <td>{{ $enquiry->name }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->phone }}</td>
                                <td>{{ $enquiry->message }}</td>
                                <td id="status_id{{ $enquiry->id }}">
                                    @if ($enquiry->status == 1)
                                        <button data-id="{{ $enquiry->id }}"
                                            class="btn btn-danger status_unred">Unread</button>
                                    @else
                                        <button class="btn btn-success">Read</button>
                                    @endif
                                </td>
                                <td>

                                    @can('enquiry')
                                        <form action="{{ route('enquiry.destroy', $enquiry->id) }}" method="post">
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
    <script>
        $(document).ready(function() {
            $(".status_unred").click(function() {
                enqId = $(this).attr('data-id');

                $.ajax({
                    url: '{{ route('enquiry.status') }}',
                    type: 'POST',
                    data: {
                        enqueryId: enqId,
                        "_token": "{{ csrf_token() }}"
                    },

                    success: function(resutl) {
                        // console.log(resutl);
                        // alert(resutl);
                        $("#status_id" + enqId).html(resutl);
                        // window.location.reload();     // Autometic refresh n ho to

                    },
                    error: function(er) {
                        alert(er);
                    }
                });
            });
        });
    </script>
@endsection
