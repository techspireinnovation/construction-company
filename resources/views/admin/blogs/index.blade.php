@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @include('components.toaster')

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Blogs</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                                <li class="breadcrumb-item active">List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Manage Blogs</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="blogList">

                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                                            <i class="ri-add-line me-1"></i> Add
                                        </a>

                                        <button
                                            class="btn btn-soft-danger js-bulk-delete"
                                            id="delete-multiple-btn"
                                            disabled
                                            data-action="{{ route('admin.blogs.bulk-destroy') }}"
                                            data-csrf="{{ csrf_token() }}"
                                            data-checkbox=".chk-child">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>
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
                                    <table class="table align-middle table-nowrap" id="blogTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                                    </div>
                                                </th>
                                                <th class="sort">Title</th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="list form-check-all">
                                            @foreach ($blogs as $blog)
                                                <tr>
                                                    <th>
                                                        <input class="form-check-input chk-child" type="checkbox" value="{{ $blog->id }}">
                                                    </th>

                                                    <td class="title">{{ $blog->title }}</td>

                                                    <td>
                                                        @if($blog->image)
                                                            <img src="{{ asset('storage/'.$blog->image) }}" style="max-width:50px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>

                                                    <td>{{ $blog->category->title ?? '-' }}</td>

                                                    <td>
                                                        <form action="{{ route('admin.blogs.toggle-status', $blog->id) }}" method="POST">
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    {{ $blog->status ? 'checked' : '' }}
                                                                    onchange="this.form.submit()">
                                                                <label class="form-check-label">
                                                                    {{ $blog->status ? 'Active' : 'Inactive' }}
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger js-single-delete"
                                                                    data-message="Delete this blog?">
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
                                            <p class="text-muted">No blogs match your search.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev {{ $blogs->previousPageUrl() ? '' : 'disabled' }}"
                                           href="{{ $blogs->previousPageUrl() }}">
                                            Previous
                                        </a>

                                        <ul class="pagination listjs-pagination mb-0">
                                            @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                                <li class="page-item {{ $blogs->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $blogs->url($i) }}">
                                                        {{ $i }}
                                                    </a>
                                                </li>
                                            @endfor
                                        </ul>

                                        <a class="page-item pagination-next {{ $blogs->nextPageUrl() ? '' : 'disabled' }}"
                                           href="{{ $blogs->nextPageUrl() }}">
                                            Next
                                        </a>
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
document.addEventListener('DOMContentLoaded', function () {
    TableManager.init({
        tableId: 'blogTable',
        searchInputId: 'search-input',
        childCheckboxClass: '.chk-child',
        bulkDeleteBtnId: 'delete-multiple-btn',
        checkAllId: 'checkAll',
        noResultClass: 'noresult',
        rowSelector: 'tbody tr',
        searchColumns: ['.title'],
        showCountOnButton: false
    });

    DeleteHandler.init();
});
</script>
@endsection
