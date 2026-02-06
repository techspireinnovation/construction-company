@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            {{-- Toaster Component --}}
            @include('components.toaster')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Service</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
                                <li class="breadcrumb-item active">Add</li>
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
                            <h4 class="card-title mb-0">Add New Service</h4>
                        </div>

                        <div class="card-body">
                            <form id="createForm" method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="row">

                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" id="title-field" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Service Title" value="{{ old('title') }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 ps-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Short Description</label>
                                            <textarea id="description-field" name="short_description" class="form-control @error('short_description') is-invalid @enderror" placeholder="Enter Short Description" rows="3">{{ old('short_description') }}</textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Long Description using reusable component -->
                                    <div class="col-md-12">
                                        <x-rich-text-editor
                                            name="description"
                                            value="{{ old('description') }}"
                                            label="Long Description"
                                            height="300"
                                            :required="false"
                                            :error="$errors->first('description')"
                                        />
                                    </div>

                                    <!-- Service Image using reusable component -->
                                    <div class="col-md-6">
                                        <x-image-upload
                                            name="image"
                                            label="Service Image"
                                            value="{{ old('image') }}"
                                            inputId="service-image-input"
                                            previewId="service-image-preview"
                                            containerId="service-image-preview-container"
                                            removeBtnId="remove-service-image"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('image')"
                                            helpText="Upload service image. Recommended size: 800x600px. Max size: 5MB."
                                        />
                                    </div>

                                    <!-- Banner Image using reusable component -->
                                    <div class="col-md-6">
                                        <x-image-upload
                                            name="banner_image"
                                            label="Banner Image"
                                            value="{{ old('banner_image') }}"
                                            inputId="banner-image-input"
                                            previewId="banner-image-preview"
                                            containerId="banner-image-preview-container"
                                            removeBtnId="remove-banner-image"
                                            maxWidth="200"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('banner_image')"
                                            helpText="Upload banner image. Recommended size: 1200x400px. Max size: 5MB."
                                        />
                                    </div>

                                    <!-- Include SEO Fields Component -->
                                    <x-seo-fields :seo="null" />

                                </div>

                                <!-- Actions -->
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.services.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Add Service</button>
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
<!-- Include the services -->
<script src="{{ asset('js/imagePreviewService.js') }}"></script>
<script src="{{ asset('js/richTextEditor.js') }}"></script>

@endsection
