@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('_message')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Partners</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partners</a></li>
                                <li class="breadcrumb-item active">Partner List</li>
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
                            <h4 class="card-title mb-0">Manage Partners</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="partnerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('admin.partners.create') }}" class="btn btn-primary add-btn">
                                                <i class="ri-add-line align-bottom me-1"></i> Add
                                            </a>
                                            <button
                                                class="btn btn-soft-danger js-bulk-delete"
                                                id="delete-multiple-btn"
                                                disabled
                                                data-action="{{ route('admin.partners.bulk-destroy') }}"
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
                                    <table class="table align-middle table-nowrap" id="partnerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="name">Name</th>
                                                <th class="sort" data-sort="image">Image</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($partners as $partner)
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input class="form-check-input chk-child" type="checkbox" name="chk_child" value="{{ $partner->id }}">
                                                        </div>
                                                    </th>
                                                    <td class="name">{{ $partner->name }}</td>
                                                    <td class="image">
                                                        @if($partner->image)
                                                            <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}" style="max-width:50px; max-height:50px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>
                                                    <td class="status">
                                                        <form action="{{ route('admin.partners.toggle-status', $partner->id) }}" method="POST">
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input status-toggle" type="checkbox" role="switch" id="status-{{ $partner->id }}" {{ $partner->status ? 'checked' : '' }} onchange="this.form.submit()">
                                                                <label class="form-check-label" style="padding-left:40px;" for="status-{{ $partner->id }}">{{ $partner->status ? 'Active' : 'Inactive' }}</label>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                            <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-sm btn-danger js-single-delete" data-message="Are you sure you want to delete this partner?">Remove</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="noresult" style="display:none">
                                        <div class="text-center">
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">No partners found for your search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev {{ $partners->previousPageUrl() ? '' : 'disabled' }}" href="{{ $partners->previousPageUrl() }}">Previous</a>
                                        <ul class="pagination listjs-pagination mb-0">
                                            @for ($i = 1; $i <= $partners->lastPage(); $i++)
                                                <li class="page-item {{ $partners->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $partners->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                        <a class="page-item pagination-next {{ $partners->nextPageUrl() ? '' : 'disabled' }}" href="{{ $partners->nextPageUrl() }}">Next</a>
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

@section('style')
<style>
    .invalid-feedback:empty { display: none; }
</style>
@endsection

@section('script')
<script src="{{ asset('js/delete-handler.js') }}"></script>
<script src="{{ asset('js/page-handler.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    window.tableManager = TableManager.init({
        tableId: 'partnerTable',
        searchInputId: 'search-input',
        childCheckboxClass: '.chk-child',
        bulkDeleteBtnId: 'delete-multiple-btn',
        checkAllId: 'checkAll',
        noResultClass: 'noresult',
        rowSelector: 'tbody tr',
        searchColumns: ['.name'],
        showCountOnButton: false
    });

    DeleteHandler.init();
});
</script>
@endsection
