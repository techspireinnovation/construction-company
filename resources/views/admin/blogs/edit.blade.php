@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            {{-- Toaster Component --}}
            @include('components.toaster')

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Blog</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Blog</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('admin.blogs.update', $blog->id) }}"
                                  enctype="multipart/form-data"
                                  autocomplete="off">
                                @csrf
                                @method('PATCH')

                                <div class="row">

                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   value="{{ old('title', $blog->title) }}"
                                                   required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select name="blog_category_id"
                                                    class="form-select @error('blog_category_id') is-invalid @enderror"
                                                    required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('blog_category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Blog Image -->
                                    <div class="col-md-6">
                                        <x-image-upload
                                            name="image"
                                            label="Blog Image"
                                            value="{{ $blog->image }}"
                                            inputId="blog-image-input"
                                            previewId="blog-image-preview"
                                            containerId="blog-image-preview-container"
                                            removeBtnId="remove-blog-image"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('image')"
                                            helpText="Upload blog image. Recommended size: 800x600px. Max size: 5MB."
                                        />
                                    </div>

                                    <!-- Banner Image -->
                                    <div class="col-md-6">
                                        <x-image-upload
                                            name="banner_image"
                                            label="Banner Image"
                                            value="{{ $blog->banner_image }}"
                                            inputId="blog-banner-image-input"
                                            previewId="blog-banner-image-preview"
                                            containerId="blog-banner-image-preview-container"
                                            removeBtnId="remove-blog-banner-image"
                                            maxWidth="200"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('banner_image')"
                                            helpText="Upload banner image. Recommended size: 1200x400px. Max size: 5MB."
                                        />
                                    </div>

                                    <!-- Written By -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Written By</label>
                                            <input type="text"
                                                   name="written_by"
                                                   class="form-control @error('written_by') is-invalid @enderror"
                                                   value="{{ old('written_by', $blog->written_by) }}">
                                            @error('written_by')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="status"
                                                       value="1"
                                                       {{ old('status', $blog->status) ? 'checked' : '' }}>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Short Description</label>
                                            <textarea name="short_description"
                                                      class="form-control @error('short_description') is-invalid @enderror"
                                                      rows="3">{{ old('short_description', $blog->short_description) }}</textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Long Description using Rich Text Editor -->
                                    <div class="col-md-12">
                                        <x-rich-text-editor
                                            name="description"
                                            value="{{ old('description', $blog->description) }}"
                                            label="Description"
                                            height="300"
                                            :required="false"
                                            :error="$errors->first('description')"
                                        />
                                    </div>

                                    <!-- SEO Fields -->
                                    <x-seo-fields :seo="$blog->seo ?? null" />

                                </div>

                                <!-- Actions -->
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Blog</button>
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
<script src="{{ asset('js/imagePreviewService.js') }}"></script>
<script src="{{ asset('js/richTextEditor.js') }}"></script>
@endsection