@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('components.toaster')

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Portfolio Category</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.portfolio-categories.index') }}">Portfolio Categories</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Category</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.portfolio-categories.update', $category->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $category->title) }}" required>
                                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', $category->status) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="hstack gap-2 justify-content-end mt-4">
                                    <a href="{{ route('admin.portfolio-categories.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Category</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
