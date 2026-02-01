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
                        <h4 class="mb-sm-0">Blog Categories</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blogs</a></li>
                                <li class="breadcrumb-item active">Blog Category List</li>
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
                            <h4 class="card-title mb-0">Manage Blog Categories</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('blog_category.create') }}" class="btn btn-primary add-btn"><i class="ri-add-line align-bottom me-1"></i> Add</a>
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
                                                <th class="sort" data-sort="description">Description</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="chk_child" value="{{ $category->id }}">
                                                        </div>
                                                    </th>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">{{ $category->id }}</a></td>
                                                    <td class="title">{{ $category->title }}</td>
                                                    <td class="description">{{ $category->description }}</td>
                                                    <td class="status">
    <form action="{{ route('blog_category.toggle_status', $category->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch" id="status-{{ $category->id }}" {{ $category->status ? 'checked' : '' }} name="status" value="1" onchange="this.form.submit();">
            <input type="hidden" value="0">
            <label class="form-check-label" style="padding-left:40px;" for="status-{{ $category->id }}">{{ $category->status ? 'Active' : 'Inactive' }}</label>
        </div>
    </form>
</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('blog_category.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                            <form action="{{ route('blog_category.destroy', $category->id) }}" method="POST" class="delete-form" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Remove</button>
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
                                            <p class="text-muted mb-0">No categories found for your search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev {{ $categories->previousPageUrl() ? '' : 'disabled' }}" href="{{ $categories->previousPageUrl() }}">Previous</a>
                                        <ul class="pagination listjs-pagination mb-0">
                                            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                                <li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                        <a class="page-item pagination-next {{ $categories->nextPageUrl() ? '' : 'disabled' }}" href="{{ $categories->nextPageUrl() }}">Next</a>
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
                alert('Please select at least one category to delete.');
                return;
            }
            if (confirm(`Are you sure you want to delete ${checkedIds.length} category(ies)?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("blog_category.bulk_destroy") }}';
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
                const description = row.querySelector('.description').textContent.toLowerCase();
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
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
    });
</script>
@endsection