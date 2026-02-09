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
                        <h4 class="mb-sm-0">Portfolios</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.portfolios.index') }}">Portfolios</a></li>
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
                            <h4 class="card-title mb-0">Manage Portfolios</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="portfolioList">

                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary">
                                            <i class="ri-add-line me-1"></i> Add
                                        </a>

                                        <button
                                            class="btn btn-soft-danger js-bulk-delete"
                                            id="delete-multiple-btn"
                                            disabled
                                            data-action="{{ route('admin.portfolios.bulk-destroy') }}"
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
                                    <table class="table align-middle table-nowrap" id="portfolioTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                                    </div>
                                                </th>
                                                <th class="sort">Title</th>
                                                <th>Images</th>
                                                <th>Category</th>
                                                <th>Partner</th>
                                                <th>Project Status</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="list form-check-all">
                                            @foreach ($portfolios as $portfolio)
                                                <tr>
                                                    <th>
                                                        <input class="form-check-input chk-child" type="checkbox" value="{{ $portfolio->id }}">
                                                    </th>

                                                    <td class="title">{{ $portfolio->title }}</td>



                                                    <!-- Multiple Images -->
                                                    <td>
                                                        @php
                                                        $images = is_array($portfolio->images) ? $portfolio->images : json_decode($portfolio->images, true) ?? [];
                                                    @endphp

                                                    <div class="d-flex gap-1">
                                                        @foreach(array_slice($images, 0, 3) as $img)
                                                            <img src="{{ asset('storage/'.$img) }}" width="40" height="40" class="rounded">
                                                        @endforeach
                                                        @if(count($images) > 3)
                                                            <span class="badge bg-secondary">+{{ count($images) - 3 }}</span>
                                                        @endif
                                                    </div>

                                                    </td>


                                                    <td>{{ $portfolio->category->title ?? '-' }}</td>
                                                    <td>{{ $portfolio->partner->name ?? '-' }}</td>

                                                    <!-- Project Status -->
                                                    <td>
                                                        @php
                                                            $statusMap = [0 => 'Completed', 1 => 'Ongoing', 2 => 'Upcoming'];
                                                        @endphp
                                                        {{ $statusMap[$portfolio->project_status] ?? '-' }}
                                                    </td>

                                                    <!-- Status Toggle -->
                                                    <td>
                                                        <form action="{{ route('admin.portfolios.toggle-status', $portfolio->id) }}" method="POST">
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    {{ $portfolio->status ? 'checked' : '' }}
                                                                    onchange="this.form.submit()">
                                                                <label class="form-check-label">
                                                                    {{ $portfolio->status ? 'Active' : 'Inactive' }}
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </td>

                                                    <!-- Actions -->
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                            <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger js-single-delete"
                                                                    data-message="Delete this portfolio?">
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
                                            <p class="text-muted">No portfolios match your search.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev {{ $portfolios->previousPageUrl() ? '' : 'disabled' }}"
                                           href="{{ $portfolios->previousPageUrl() }}">
                                            Previous
                                        </a>

                                        <ul class="pagination listjs-pagination mb-0">
                                            @for ($i = 1; $i <= $portfolios->lastPage(); $i++)
                                                <li class="page-item {{ $portfolios->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $portfolios->url($i) }}">
                                                        {{ $i }}
                                                    </a>
                                                </li>
                                            @endfor
                                        </ul>

                                        <a class="page-item pagination-next {{ $portfolios->nextPageUrl() ? '' : 'disabled' }}"
                                           href="{{ $portfolios->nextPageUrl() }}">
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
        tableId: 'portfolioTable',
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
