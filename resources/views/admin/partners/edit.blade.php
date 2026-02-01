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
                        <h4 class="mb-sm-0">Edit Partner</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partners</a></li>
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
                            <h4 class="card-title mb-0">Edit Partner</h4>
                        </div>
                        <div class="card-body">
                            <form id="editForm" method="POST" action="{{ route('admin.partners.update', $partner->id) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name-field" class="form-label">Name</label>
                                            <input type="text" id="name-field" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Partner Name" value="{{ old('name', $partner->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status-field" class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="status-field" name="status" value="1" {{ old('status', $partner->status) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status-field">Active</label>
                                            </div>
                                            @error('status')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image-field" class="form-label">Partner Image</label>
                                            <input type="file" id="image-field" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif">
                                            @if($partner->image)
                                                <img id="image-preview" src="{{ asset('storage/' . $partner->image) }}" alt="Partner Image" style="max-width: 50px; max-height: 50px; display: block; margin-top: 10px;" data-original-src="{{ asset('storage/' . $partner->image) }}">
                                            @else
                                                <img id="image-preview" src="" alt="Partner Image" style="max-width: 50px; max-height: 50px; display: none; margin-top: 10px;" data-original-src="">
                                            @endif
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.partners.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Partner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
        // Image preview
        const imageField = document.querySelector('#image-field');
        const imagePreview = document.querySelector('#image-preview');

        imageField.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = imagePreview.dataset.originalSrc;
                imagePreview.style.display = imagePreview.dataset.originalSrc ? 'block' : 'none';
            }
        });
    });
</script>
@endsection