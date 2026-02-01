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
                        <h4 class="mb-sm-0">Edit Blog Category</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blogs</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog_category.index') }}">Blog Categories</a></li>
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
                            <h4 class="card-title mb-0">Edit Category: {{ $category->title }}</h4>
                        </div>
                        <div class="card-body">
                            <form id="editForm" method="POST" action="{{ route('blog_category.update', $category->id) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title-field" class="form-label">Title</label>
                                            <input type="text" id="title-field" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title" value="{{ old('title', $category->title) }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    <div class="mb-3">
        <label for="status-field" class="form-label">Status</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="status-field" name="status" value="1" {{ old('status', $category->status) == 1 ? 'checked' : '' }}>
            <input type="hidden" value="0">
            <label class="form-check-label" for="status-field">Active</label>
        </div>
        @error('status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description-field" class="form-label">Description</label>
                                            <textarea id="description-field" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description" rows="4">{{ old('description', $category->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image-field" class="form-label">Category Image</label>
                                            <input type="file" id="image-field" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                            @if($category->image && file_exists(public_path('storage/' . $category->image)))
                                                <img id="image-preview" src="{{ asset('storage/' . $category->image) }}" alt="Category Image" style="max-width: 100px; max-height: 100px; display: block; margin-top: 10px;">
                                            @else
                                                <img id="image-preview" src="" alt="Category Image" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                            @endif
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="seo-image-field" class="form-label">SEO Image</label>
                                            <input type="file" id="seo-image-field" name="seo_image" class="form-control @error('seo_image') is-invalid @enderror" accept="image/*">
                                            @if($category->seo_image && file_exists(public_path('storage/' . $category->seo_image)))
                                                <img id="seo-image-preview" src="{{ asset('storage/' . $category->seo_image) }}" alt="SEO Image" style="max-width: 100px; max-height: 100px; display: block; margin-top: 10px;">
                                            @else
                                                <img id="seo-image-preview" src="" alt="SEO Image" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                            @endif
                                            @error('seo_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="seo-title-field" class="form-label">SEO Title</label>
                                            <input type="text" id="seo-title-field" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror" placeholder="Enter SEO Title" value="{{ old('seo_title', $category->seo_title) }}">
                                            @error('seo_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="seo-keywords-field" class="form-label">SEO Keywords</label>
                                            <input type="text" id="seo-keywords-field" class="form-control" placeholder="Enter SEO Keywords">
                                            <input type="hidden" id="seo-keywords-hidden" name="seo_keywords" value="{{ old('seo_keywords', $category->seo_keywords) }}">
                                            @error('seo_keywords')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="seo-description-field" class="form-label">SEO Description</label>
                                            <textarea id="seo-description-field" name="seo_description" class="form-control @error('seo_description') is-invalid @enderror" placeholder="Enter SEO Description" rows="4">{{ old('seo_description', $category->seo_description) }}</textarea>
                                            @error('seo_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('blog_category.index') }}" class="btn btn-light">Cancel</a>
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
        // Initialize Tagify
        const tagifyInput = document.querySelector('#seo-keywords-field');
        const hiddenInput = document.querySelector('#seo-keywords-hidden');

        const tagify = new Tagify(tagifyInput, {
            duplicates: false,
            trim: true,
            placeholder: 'Enter SEO Keywords',
            enforceWhitelist: false,
            maxTags: 10,
            dropdown: {
                enabled: 0,
                maxItems: 20,
                classname: 'tagify__dropdown',
                closeOnSelect: false
            }
        });

        // Load existing keywords
        @if($category->seo_keywords)
            const keywords = "{{ $category->seo_keywords }}".split(',').map(keyword => keyword.trim()).filter(keyword => keyword.length > 0);
            tagify.addTags(keywords);
        @endif

        // Sync tags with hidden input
        tagify.on('add remove', function() {
            const tags = tagify.value.map(tag => tag.value);
            hiddenInput.value = tags.join(',');
        });

        // Image preview for category image
        const imageField = document.querySelector('#image-field');
        const imagePreview = document.querySelector('#image-preview');
        imageField.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            }
        });

        // Image preview for SEO image
        const seoImageField = document.querySelector('#seo-image-field');
        const seoImagePreview = document.querySelector('#seo-image-preview');
        seoImageField.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    seoImagePreview.src = e.target.result;
                    seoImagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                seoImagePreview.src = '';
                seoImagePreview.style.display = 'none';
            }
        });
    });
</script>
@endsection