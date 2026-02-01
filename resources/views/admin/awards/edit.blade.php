@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Award</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.awards.index') }}">Awards</a></li>
                                <li class="breadcrumb-item active">Edit</li>
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
                            <h4 class="card-title mb-0">Edit Award</h4>
                        </div>
                        <div class="card-body">
                            <form id="editForm" method="POST" action="{{ route('admin.awards.update', $award->id) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title-field" class="form-label">Title</label>
                                            <input type="text" id="title-field" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Award Title" value="{{ old('title', $award->title) }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company-name-field" class="form-label">Company Name</label>
                                            <input type="text" id="company-name-field" name="Company_name" class="form-control @error('Company_name') is-invalid @enderror" placeholder="Enter Company Name" value="{{ old('Company_name', $award->Company_name) }}">
                                            @error('Company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description-field" class="form-label">Description</label>
                                            <textarea id="description-field" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Award Description" rows="5">{{ old('description', $award->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company-logo-field" class="form-label">Company Logo</label>
                                            <input type="file" id="company-logo-field" name="Company_logo" class="form-control @error('Company_logo') is-invalid @enderror" accept="image/*">
                                            @if($award->Company_logo)
                                                <img id="logo-preview" src="{{ asset('storage/' . $award->Company_logo) }}" alt="Company Logo" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                            @else
                                                <img id="logo-preview" src="" alt="Company Logo" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                            @endif
                                            @error('Company_logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-left:40px;">
                                        <div class="mb-3">
                                            <label for="status-field" class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="status-field" name="status" value="1" {{ old('status', $award->status) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status-field">Active</label>
                                            </div>
                                            @error('status')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="images-field" class="form-label">Award Images</label>
                                            <input type="file" id="images-field" name="images[]" class="form-control @error('images') is-invalid @enderror" accept="image/*" multiple>
                                            <div id="images-preview" class="mt-2" style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                @if($award->images)
                                                    @foreach(json_decode($award->images, true) as $image)
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Award Image" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                                    @endforeach
                                                @endif
                                            </div>
                                            @error('images')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.awards.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Award</button>
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
        // Image preview for company logo
        document.querySelector('#company-logo-field').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.querySelector('#logo-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Image preview for multiple award images
        document.querySelector('#images-field').addEventListener('change', function (event) {
            const files = event.target.files;
            const previewContainer = document.querySelector('#images-preview');
            previewContainer.innerHTML = ''; // Clear previous previews
            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100px';
                        img.style.maxHeight = '100px';
                        img.style.marginTop = '10px';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endsection