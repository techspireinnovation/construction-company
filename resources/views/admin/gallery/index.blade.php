@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Include the _message.blade.php partial -->
            

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Gallery</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
                                <li class="breadcrumb-item active">Gallery List</li>
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
                            <h4 class="card-title mb-0">Manage Gallery</h4>
                        </div>
                        <div class="card-body">
                            <div class="listjs-table" id="galleryList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary add-btn"><i class="ri-add-line align-bottom me-1"></i> Add</a>
                                            <button class="btn btn-soft-danger" id="delete-multiple-btn" disabled><i class="ri-delete-bin-2-line"></i> </button>
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
                                    <table class="table align-middle table-nowrap" id="galleryTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="title">Title</th>
                                                <th class="sort" data-sort="images">Images</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($galleries as $gallery)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input chk-child" type="checkbox" name="chk_child" value="{{ $gallery->id }}">
                                                        </div>
                                                    </th>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">{{ $gallery->id }}</a></td>
                                                    <td class="title">{{ $gallery->title ?? 'N/A' }}</td>
                                                    <td class="images">
                                                        @if($gallery->images)
                                                            @foreach(json_decode($gallery->images, true) as $image)
                                                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" style="max-width: 50px; max-height: 50px; margin-right: 5px;">
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">No Images</span>
                                                        @endif
                                                    </td>
                                                    <td class="status">
                                                        <form action="{{ route('admin.gallery.toggle-status', $gallery->id) }}" method="POST">
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input status-toggle" type="checkbox" role="switch" id="status-{{ $gallery->id }}" {{ $gallery->status ? 'checked' : '' }} name="status" value="1" onchange="this.form.submit();">
                                                                <label class="form-check-label" style="padding-left:40px;" for="status-{{ $gallery->id }}">{{ $gallery->status ? 'Active' : 'Inactive' }}</label>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="delete-form" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this gallery item?')">Remove</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="{{ asset('public/msoeawqm.json') }}" trigger="loop" colors="primary:#25a0e2,secondary:#00bd9d" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">No gallery items found for your search.</p>
                                        </div>
                                    </div>
                                </div>

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
@endsection

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.css" />
<style>
    .invalid-feedback:empty { display: none; }
</style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle multiple delete
        const deleteMultipleBtn = document.querySelector('#delete-multiple-btn');
        const checkboxes = document.querySelectorAll('input[name="chk_child"]');
        const checkAll = document.querySelector('#checkAll');

        // Update delete button state
        function updateDeleteButtonState() {
            const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
            deleteMultipleBtn.disabled = checkedCount === 0;
            deleteMultipleBtn.title = checkedCount === 0 ? 'Select at least one gallery item to delete' : 'Delete selected gallery items';
        }

        // Initial state
        updateDeleteButtonState();

        // Update button state on checkbox change
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButtonState);
        });

        // Handle check all checkbox
        checkAll.addEventListener('change', function () {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateDeleteButtonState();
        });

        // Handle multiple delete
        deleteMultipleBtn.addEventListener('click', function () {
            const checkedIds = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
            if (checkedIds.length === 0) {
                alert('Please select at least one gallery item to delete.');
                return;
            }
            if (confirm(`Are you sure you want to delete ${checkedIds.length} gallery item(s)?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.gallery.bulk-destroy") }}';
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="ids" value="${checkedIds.join(',')}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });

        // Handle search (client-side filtering)
        document.querySelector('#search-input').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#galleryTable tbody tr');
            let hasResults = false;

            rows.forEach(row => {
                const title = row.querySelector('.title').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    row.style.display = '';
                    hasResults = true;
                } else {
                    row.style.display = 'none';
                }
            });

            document.querySelector('.noresult').style.display = hasResults ? 'none' : 'block';
        });
    });
</script>
@endsection