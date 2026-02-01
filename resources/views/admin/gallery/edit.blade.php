@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Include the _message.blade.php partial -->
            @include('_message')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Gallery Item</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
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
                            <h4 class="card-title mb-0">Edit Gallery Item</h4>
                        </div>
                        <div class="card-body">
                            <form id="editForm" method="POST" action="{{ route('admin.gallery.update', $gallery->id) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title-field" class="form-label">Title</label>
                                            <input type="text" id="title-field" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Gallery Title" value="{{ old('title', $gallery->title) }}">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-left:30px;">
                                        <div class="mb-3">
                                            <label for="status-field" class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="status-field" name="status" value="1" {{ old('status', $gallery->status) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status-field">Active</label>
                                            </div>
                                            @error('status')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="content-field" class="form-label">Content</label>
                                            <textarea id="content-field" name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Enter Gallery Content" rows="5">{{ old('content', $gallery->content) }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="images-field" class="form-label">Images</label>
                                            <input type="file" id="images-field" name="images[]" class="form-control @error('images') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif" multiple>
                                            <div id="image-previews" style="display: flex; flex-wrap: wrap; margin-top: 10px;">
                                                @if($gallery->images)
                                                    @foreach(json_decode($gallery->images, true) as $index => $image)
                                                        <div class="image-preview-container" style="position: relative; margin-right: 10px; margin-bottom: 10px;">
                                                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" class="image-preview" data-original-src="{{ asset('storage/' . $image) }}">
                                                            <input type="checkbox" name="delete_images[]" value="{{ $image }}" class="delete-image-checkbox" style="position: absolute; top: 5px; right: 5px;">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <small class="text-muted">Upload new images to add to existing ones. Check images to delete them.</small>
                                            @error('images')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Gallery Item</button>
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
    .image-preview { max-width: 100px; max-height: 100px; }
    .image-preview-container { position: relative; }
    .delete-image-checkbox { cursor: pointer; }
</style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview for new images
        const imagesField = document.querySelector('#images-field');
        const imagePreviews = document.querySelector('#image-previews');

        imagesField.addEventListener('change', function (event) {
            const files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const container = document.createElement('div');
                        container.className = 'image-preview-container';
                        container.style.marginRight = '10px';
                        container.style.marginBottom = '10px';
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'image-preview';
                        container.appendChild(img);
                        imagePreviews.appendChild(container);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endsection
