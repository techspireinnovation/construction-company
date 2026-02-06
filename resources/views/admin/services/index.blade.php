@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Include the _message.blade.php partial -->
            @include('_message')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Services</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
                                <li class="breadcrumb-item active">Services List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Manage Services</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="serviceList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('admin.services.create') }}" class="btn btn-primary add-btn"><i class="ri-add-line align-bottom me-1"></i> Add</a>
                                            <button
                                            class="btn btn-soft-danger js-bulk-delete"
                                            id="delete-multiple-btn"
                                            disabled
                                            data-action="{{ route('admin.services.bulk-destroy') }}"
                                            data-csrf="{{ csrf_token() }}"
                                            data-checkbox=".chk-child">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>

                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search..." id="search-input">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="serviceTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="title">Title</th>
                                                <th class="sort" data-sort="short_description">Short description</th>
                                                <th class="sort" data-sort="image">Image</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($services as $service)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input chk-child" type="checkbox" name="chk_child" value="{{ $service->id }}">
                                                        </div>
                                                    </th>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">{{ $service->id }}</a></td>
                                                    <td class="title">{{ $service->title }}</td>
                                                    <td class="short_description">{{ Str::limit($service->short_description, 50) }}</td>
                                                    <td class="image">
                                                        @if($service->image)
                                                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" style="max-width: 50px; max-height: 50px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>
                                                    <td class="status">
                                                        <form action="{{ route('admin.services.toggle-status', $service->id) }}" method="POST">
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input status-toggle" type="checkbox" role="switch" id="status-{{ $service->id }}" {{ $service->status ? 'checked' : '' }} name="status" value="1" onchange="this.form.submit();">
                                                                <label class="form-check-label" style="padding-left:40px;" for="status-{{ $service->id }}">{{ $service->status ? 'Active' : 'Inactive' }}</label>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger js-single-delete"
                                                                    data-message="Are you sure you want to delete this service?">
                                                                    Remove
                                                                </button>
                                                            </form>
                                                                                                                        </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">No services found for your search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev {{ $services->previousPageUrl() ? '' : 'disabled' }}" href="{{ $services->previousPageUrl() }}">Previous</a>
                                        <ul class="pagination listjs-pagination mb-0">
                                            @for ($i = 1; $i <= $services->lastPage(); $i++)
                                                <li class="page-item {{ $services->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $services->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                        <a class="page-item pagination-next {{ $services->nextPageUrl() ? '' : 'disabled' }}" href="{{ $services->nextPageUrl() }}">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- Delete Confirmation Modal (Single + Bulk) -->

@include('components.delete-confirm-modal')

@endsection

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.css" />
<style>
    .invalid-feedback:empty { display: none; }
</style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.min.js"></script>
<script src="{{ asset('js/delete-handler.js') }}"></script>
<script src="{{ asset('js/page-handler.js') }}"></script>



@endsection