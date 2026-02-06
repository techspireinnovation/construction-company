@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @include('_message')

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Galleries</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.galleries.index') }}">Galleries</a>
                                </li>
                                <li class="breadcrumb-item active">Gallery List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Manage Galleries</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="galleryList">

                                <!-- Actions -->
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                                            <i class="ri-add-line me-1"></i> Add
                                        </a>

                                        <button
                                            class="btn btn-soft-danger js-bulk-delete"
                                            id="delete-multiple-btn"
                                            disabled
                                            data-action="{{ route('admin.galleries.bulk-destroy') }}"
                                            data-csrf="{{ csrf_token() }}"
                                            data-checkbox=".chk-child">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>
                                    </div>

                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" id="search-input" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="galleryTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="50">
                                                    <input type="checkbox" id="checkAll" class="form-check-input">
                                                </th>
                                                <th class="sort" data-sort="title">Title</th>
                                                <th>Images</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="list form-check-all">
                                            @foreach($galleries as $gallery)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input chk-child" value="{{ $gallery->id }}">
                                                    </td>

                                                    <td class="title">{{ $gallery->title }}</td>

                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            @foreach(array_slice($gallery->images ?? [], 0, 3) as $img)
                                                                <img src="{{ asset('storage/'.$img) }}" width="40" height="40" class="rounded">
                                                            @endforeach
                                                            @if(count($gallery->images ?? []) > 3)
                                                                <span class="badge bg-secondary">+{{ count($gallery->images) - 3 }}</span>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <form method="POST" action="{{ route('admin.galleries.toggle-status', $gallery->id) }}">
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <input
                                                                    class="form-check-input"
                                                                    type="checkbox"
                                                                    onchange="this.form.submit()"
                                                                    {{ $gallery->status ? 'checked' : '' }}>
                                                            </div>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger js-single-delete"
                                                                    data-message="Delete this gallery?">
                                                                    Remove
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="noresult" style="display:none">
                                        <div class="text-center">
                                            <h5>No Result Found</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev {{ $galleries->previousPageUrl() ? '' : 'disabled' }}" href="{{ $galleries->previousPageUrl() }}">Previous</a>
                                        <ul class="pagination listjs-pagination mb-0">
                                            @for ($i = 1; $i <= $galleries->lastPage(); $i++)
                                                <li class="page-item {{ $galleries->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $galleries->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                        <a class="page-item pagination-next {{ $galleries->nextPageUrl() ? '' : 'disabled' }}" href="{{ $galleries->nextPageUrl() }}">Next</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('components.delete-confirm-modal')
@endsection

@section('script')
<script src="{{ asset('js/delete-handler.js') }}"></script>
<script src="{{ asset('js/page-handler.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    TableManager.init({
        tableId: 'galleryTable',
        searchInputId: 'search-input',
        childCheckboxClass: '.chk-child',
        bulkDeleteBtnId: 'delete-multiple-btn',
        checkAllId: 'checkAll',
        searchColumns: ['.title']
    });

    DeleteHandler.init();
});
</script>
@endsection
