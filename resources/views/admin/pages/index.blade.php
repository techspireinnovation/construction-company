@extends('layouts.backend.master')

@section('title')
    {{ env('APP_NAME') }} | Pages
@endsection

@push('css')
<style>
    .row-id {
        display: none;
    }
    .td-flex {
        display: inline-flex;
    }
    .page-type-select {
        min-width: 150px;
    }
</style>
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pages</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Pages</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">ARE YOU SURE?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you really want to delete this item?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.pages.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" id="id" name="id">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">NO</button>
                                            <button type="submit" class="btn btn-primary">YES</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 col-6">
                                    <input type="text" class="form-control" id="page-search"
                                        placeholder="Search Page" style="width: 100%;">
                                </div>
                                <div class="col-lg-2 col-6">
                                    <div>
                                        <a href="{{ route('admin.pages.create') }}">
                                            <button type="button" class="btn btn-success" style="width: 100%;">
                                                <i class="fa fa-plus"></i> Create
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div> <br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover dataTable dtr-inline" id="page-table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Page Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!--end table -->
                        </div><!-- end card body -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @push('js')
        <script>
            $(document).ready(function() {
                var datatable = $('#page-table').DataTable({
                    searching: false,
                    stripeClasses: ['odd-row', 'even-row'],
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    deferLoading: 10,
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                    },
                    dom: 'Bfrtip',
                    buttons: ['copyHtml5', 'csvHtml5', 'excelHtml5', 'print', 'pdfHtml5'],
                    ajax: {
                        url: "{{ route('admin.pages.search') }}",
                        data: function(d) {
                            d.keyword = $('#page-search').val();
                        }
                    },
                    columns: [
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return '<div class="row-id">' + row.id + '</div>' + row.sn;
                            }
                        },
                        {
                            data: 'title'
                        },
                        {
                            data: 'slug'
                        },
                        {
                            data: 'page_type_id',
                            render: function(data, type, row) {
                                var select = '<select class="page-type-select" data-id="' + row.id + '">';
                                @foreach (App\Models\PageType::where('status', 1)->get() as $pageType)
                                    select += '<option value="{{ $pageType->id }}" ' + (data == {{ $pageType->id }} ? 'selected' : '') + '>{{ $pageType->name }}</option>';
                                @endforeach
                                select += '</select>';
                                return select;
                            }
                        },
                        {
                            data: 'action',
                            render: function(data, type, row) {
                                var edit = "{{ url('backend/pages/edit') }}" + '/' + row.id;
                                return '<div class="td-flex">' +
                                    '<a href="' + edit + '"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>' +
                                    '&nbsp;' +
                                    '<button type="button" class="btn btn-danger" id="delete" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash"></i></button>' +
                                    '</div>';
                            }
                        }
                    ],
                    bLengthChange: false
                }).on('xhr.dt', function(e, settings, json, xhr) {
                });

                $('body').on('keyup', '#page-search', function() {
                    setTimeout(function() {
                        datatable.ajax.reload();
                    }, 1);
                });

                $('body').on('click', '#delete', function() {
                    var id = $(this).parents('tr').find('.row-id').text();
                    $('#id').val(id);
                });

                $('body').on('change', '.page-type-select', function() {
                    var pageId = $(this).data('id');
                    var pageTypeId = $(this).val();
                    $.ajax({
                        url: "{{ route('admin.pages.updatePageType') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: pageId,
                            page_type_id: pageTypeId
                        },
                        success: function(response) {
                            if (response.success) {
                                datatable.ajax.reload();
                                alert('Page type updated successfully! Other pages with this type have been set to Default and Draft.');
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Failed to update page type: ' + (xhr.responseJSON.message || 'Unknown error'));
                        }
                    });
                });

                datatable.ajax.reload();
            });
        </script>
    @endpush
@endsection