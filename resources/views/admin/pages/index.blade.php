@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Include messages -->
            @include('_message')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Pages SEO</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
                                <li class="breadcrumb-item active">SEO List</li>
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
                            <h4 class="card-title mb-0">Manage Page SEO</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="pageList">

                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                                            <i class="ri-add-line align-bottom me-1"></i> Add
                                        </a>


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
                                    <table class="table align-middle table-nowrap" id="pageTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                                    </div>
                                                </th>
                                                <th>Page</th>
                                                <th>SEO Title</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <!-- IMPORTANT: sortable tbody -->
                                        <tbody class="list form-check-all sortable-tbody">
                                            @foreach ($pages as $page)
                                                <tr data-id="{{ $page->id }}">
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input chk-child" type="checkbox" value="{{ $page->id }}">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        @php
                                                        $types = [
                                                            1 => 'Home',
                                                            2 => 'About Us',
                                                            3 => 'Services',
                                                            4 => 'Team',
                                                            5 => 'Testimonial',
                                                            6 => 'Gallery',
                                                            7 => 'Portfolio',
                                                            8 => 'Blog',
                                                            9 => 'Career',
                                                            10 => 'Contact'
                                                        ];
                                                    @endphp

                                                        {{ $types[$page->type] ?? 'Unknown' }}
                                                    </td>

                                                    <td>{{ $page->seoDetail->seo_title ?? '-' }}</td>

                                                    <td>
                                                        <form action="{{ route('admin.pages.toggle-status', $page->id) }}" method="POST">
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" {{ $page->status ? 'checked' : '' }} onchange="this.form.submit()">
                                                                <label class="form-check-label ms-2">{{ $page->status ? 'Active' : 'Inactive' }}</label>
                                                            </div>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="noresult" style="display:none">
                                        <div class="text-center">
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">No pages found.</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- No pagination for drag-and-drop --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('style')
<style>
    .invalid-feedback:empty { display: none; }
    .sortable-tbody tr { cursor: move; }
</style>
@endsection

@section('script')
<script src="{{ asset('js/page-handler.js') }}"></script>

<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Table manager
    window.tableManager = TableManager.init({
        tableId: 'pageTable',
        searchInputId: 'search-input',
        childCheckboxClass: '.chk-child',
        bulkDeleteBtnId: 'delete-multiple-btn',
        checkAllId: 'checkAll',
        noResultClass: 'noresult',
        rowSelector: 'tbody tr',
        searchColumns: ['td:nth-child(2)', 'td:nth-child(3)'],
        showCountOnButton: false
    });

    DeleteHandler.init();

    // Drag & Drop Ordering
    new Sortable(document.querySelector('.sortable-tbody'), {
        animation: 150,
        onEnd: function () {
            let order = [];
            document.querySelectorAll('.sortable-tbody tr').forEach((row, index) => {
                order.push({ id: row.dataset.id, position: index + 1 });
            });

            fetch("{{ route('admin.pages.update-order') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ order })
            });
        }
    });

});
</script>
@endsection
