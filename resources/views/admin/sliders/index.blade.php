@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sliders</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Sliders</a></li>
                                <li class="breadcrumb-item active">Slider List</li>
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
                            <h4 class="card-title mb-0">Manage Sliders</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary add-btn"><i class="ri-add-line align-bottom me-1"></i> Add</a>
                                            <button class="btn btn-soft-danger" id="delete-multiple-btn"><i class="ri-delete-bin-2-line"></i></button>
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
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="title">Title</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($sliders as $slider)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="chk_child" value="{{ $slider->id }}">
                                                        </div>
                                                    </th>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">{{ $slider->id }}</a></td>
                                                    <td class="title">{{ $slider->title ?? 'N/A' }}</td>
                                                    <td class="status">
                                                        <form action="{{ route('admin.sliders.toggle_status', $slider->id) }}" method="POST" class="status-form">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="form-check form-switch">
                                                                <input type="hidden" name="status" value="0">
                                                                <input class="form-check-input status-toggle" type="checkbox"
                                                                       role="switch"
                                                                       id="status-{{ $slider->id }}"
                                                                       name="status"
                                                                       value="1"
                                                                       {{ $slider->status ? 'checked' : '' }}
                                                                       onchange="this.form.submit();">
                                                                <label class="form-check-label" style="padding-left:40px;" for="status-{{ $slider->id }}">
                                                                    {{ $slider->status ? 'Active' : 'Inactive' }}
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="delete-form" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this slider?')">Remove</button>
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
                                            <p class="text-muted mb-0">No sliders found for your search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev {{ $sliders->previousPageUrl() ? '' : 'disabled' }}" href="{{ $sliders->previousPageUrl() }}">Previous</a>
                                        <ul class="pagination listjs-pagination mb-0">
                                            @for ($i = 1; $i <= $sliders->lastPage(); $i++)
                                                <li class="page-item {{ $sliders->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $sliders->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                        <a class="page-item pagination-next {{ $sliders->nextPageUrl() ? '' : 'disabled' }}" href="{{ $sliders->nextPageUrl() }}">Next</a>
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
        document.querySelector('#delete-multiple-btn').addEventListener('click', function () {
            const checkedIds = Array.from(document.querySelectorAll('input[name="chk_child"]:checked')).map(input => input.value);
            if (checkedIds.length === 0) {
                alert('Please select at least one slider to delete.');
                return;
            }
            if (confirm(`Are you sure you want to delete ${checkedIds.length} slider(s)?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.sliders.bulk_destroy") }}';
                form.innerHTML = `
                    @csrf
                    <input type="hidden" name="ids" value="${checkedIds.join(',')}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });

        // Handle search (client-side filtering)
        document.querySelector('#search-input').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#customerTable tbody tr');
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

        // Handle check all checkbox
        document.querySelector('#checkAll').addEventListener('change', function () {
            document.querySelectorAll('input[name="chk_child"]').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Handle status toggle
        document.querySelectorAll('.status-toggle').forEach(toggle => {
            toggle.addEventListener('change', function () {
                if (this.checked) {
                    // Uncheck all other toggles on the frontend
                    document.querySelectorAll('.status-toggle').forEach(otherToggle => {
                        if (otherToggle !== this) {
                            otherToggle.checked = false;
                            const otherLabel = otherToggle.parentElement.querySelector('.form-check-label');
                            otherLabel.textContent = 'Inactive';
                        }
                    });
                    this.parentElement.querySelector('.form-check-label').textContent = 'Active';
                } else {
                    this.parentElement.querySelector('.form-check-label').textContent = 'Inactive';
                }
            });
        });
    });
</script>
@endsection