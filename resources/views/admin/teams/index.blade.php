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
                        <h4 class="mb-sm-0">Team Members</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.teams.index') }}">Team</a>
                                </li>
                                <li class="breadcrumb-item active">Team List</li>
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
                            <h4 class="card-title mb-0">Manage Team</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="teamList">

                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
                                            <i class="ri-add-line align-bottom me-1"></i> Add
                                        </a>

                                        <button
                                            class="btn btn-soft-danger js-bulk-delete"
                                            id="delete-multiple-btn"
                                            disabled
                                            data-action="{{ route('admin.teams.bulk-destroy') }}"
                                            data-csrf="{{ csrf_token() }}"
                                            data-checkbox=".chk-child">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>
                                    </div>

                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text"
                                                       class="form-control search"
                                                       placeholder="Search..."
                                                       id="search-input">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="teamTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                                    </div>
                                                </th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <!-- IMPORTANT: sortable tbody -->
                                        <tbody class="list form-check-all sortable-tbody">
                                            @foreach ($teams as $team)
                                                <tr data-id="{{ $team->id }}">
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input chk-child"
                                                                   type="checkbox"
                                                                   value="{{ $team->id }}">
                                                        </div>
                                                    </td>

                                                    <td class="name">{{ $team->name }}</td>
                                                    <td class="designation">{{ $team->designation }}</td>

                                                    <td>
                                                        @if($team->image)
                                                            <img src="{{ asset('storage/'.$team->image) }}"
                                                                 alt="{{ $team->name }}"
                                                                 style="max-width:50px;max-height:50px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <form action="{{ route('admin.teams.toggle-status', $team->id) }}" method="POST">
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input"
                                                                       type="checkbox"
                                                                       role="switch"
                                                                       {{ $team->status ? 'checked' : '' }}
                                                                       onchange="this.form.submit()">
                                                                <label class="form-check-label ms-2">
                                                                    {{ $team->status ? 'Active' : 'Inactive' }}
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.teams.edit', $team->id) }}"
                                                               class="btn btn-sm btn-primary">
                                                                Edit
                                                            </a>

                                                            <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                        class="btn btn-sm btn-danger js-single-delete"
                                                                        data-message="Are you sure you want to delete this team member?">
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
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">No team members found.</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Pagination (OK to keep, but sorting best without pagination) --}}
                                <div class="d-flex justify-content-end">
                                    {{ $teams->links() }}
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
    .sortable-tbody tr { cursor: move; }
</style>
@endsection

@section('script')
<script src="{{ asset('js/delete-handler.js') }}"></script>
<script src="{{ asset('js/page-handler.js') }}"></script>

<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Table manager (unchanged)
    window.tableManager = TableManager.init({
        tableId: 'teamTable',
        searchInputId: 'search-input',
        childCheckboxClass: '.chk-child',
        bulkDeleteBtnId: 'delete-multiple-btn',
        checkAllId: 'checkAll',
        noResultClass: 'noresult',
        rowSelector: 'tbody tr',
        searchColumns: ['.name', '.designation'],
        showCountOnButton: false
    });

    DeleteHandler.init();

    // Drag & drop ordering (NO UI change)
    new Sortable(document.querySelector('.sortable-tbody'), {
        animation: 150,
        onEnd: function () {
            let order = [];

            document.querySelectorAll('.sortable-tbody tr').forEach((row, index) => {
                order.push({
                    id: row.dataset.id,
                    position: index + 1
                });
            });

            fetch("{{ route('admin.teams.update-order') }}", {
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
