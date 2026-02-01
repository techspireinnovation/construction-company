@extends('layouts.backend.master')

@section('title')
    {{ env('APP_NAME') }} | Page Types
@endsection

@push('css')
<style>
    .row-id {
        display: none;
    }
    .td-flex {
        display: inline-flex;
    }
</style>
@endpush

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Page Types</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Page Types</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="modal fade" id="deleteModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">ARE YOU SURE?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you really want to delete this page type?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form id="deleteForm" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" id="delete-id" name="id">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">NO</button>
                                            <button type="submit" class="btn btn-primary">YES</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="row">
                                <div class="col-lg-10 col-6">
                                    <input type="text" class="form-control" id="page-type-search"
                                        placeholder="Search Page Type" style="width: 100%;">
                                </div>
                                <div class="col-lg-2 col-6">
                                    <a href="{{ route('admin.page_types.create') }}">
                                        <button type="button" class="btn btn-success" style="width: 100%;">
                                            <i class="fa fa-plus"></i> Create
                                        </button>
                                    </a>
                                </div>
                            </div> <br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover dataTable dtr-inline" id="page-type-table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('js')
    <script>
        $(document).ready(function() {
            var datatable = $('#page-type-table').DataTable({
                searching: false,
                stripeClasses: ['odd-row', 'even-row'],
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                },
                dom: 'Bfrtip',
                buttons: ['copyHtml5', 'csvHtml5', 'excelHtml5', 'print', 'pdfHtml5'],
                ajax: {
                    url: "{{ route('admin.page_types.search') }}",
                    data: function(d) {
                        d.keyword = $('#page-type-search').val();
                        console.log('Sending keyword:', d.keyword);
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTable AJAX error:', error, thrown);
                        alert('Error loading data. Please check the console for details.');
                    }
                },
                columns: [
                    {
                        data: 'sn',
                        render: function(data, type, row) {
                            return '<div class="row-id">' + row.id + '</div>' + data;
                        }
                    },
                    { data: 'name' },
                    { data: 'status' },
                    { data: 'action' }
                ],
                bLengthChange: false
            }).on('xhr.dt', function(e, settings, json, xhr) {
                console.log('DataTable response:', json);
            });

            $('body').on('keyup', '#page-type-search', function() {
                setTimeout(function() {
                    datatable.ajax.reload();
                }, 1);
            });

            $('body').on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                $('#delete-id').val(id);
                $('#deleteForm').attr('action', "{{ url('backend/page_types') }}/" + id);
            });
        });
    </script>
@endpush
@endsection