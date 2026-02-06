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
                        <h4 class="mb-sm-0">Edit Page SEO</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
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
                            <h4 class="card-title mb-0">Page SEO Information</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <!-- Page Type -->
                                    <div class="col-md-6">
                                        <label class="form-label">Page</label>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $types[$page->type] ?? 'Unknown' }}"
                                               disabled>

                                        <input type="hidden" name="type" value="{{ $page->type }}">
                                    </div>


                                    <!-- Banner Image -->
                                    <div class="col-md-6">
                                        <x-image-upload
                                            name="banner_image"
                                            label="Banner Image"
                                            value="{{ $page->banner_image ?? '' }}"
                                            inputId="page-banner-image-input"
                                            previewId="page-banner-image-preview"
                                            containerId="page-banner-image-preview-container"
                                            removeBtnId="remove-page-banner-image"
                                            maxWidth="1200"
                                            maxHeight="400"
                                            :required="false"
                                            :error="$errors->first('banner_image')"
                                            helpText="Upload banner image. Recommended size: 1200x400px. Max size: 5MB."
                                        />
                                    </div>
                                </div>

                                <hr>

                                <h5 class="mb-3">SEO Details</h5>

                                <x-seo-fields :seo="$page->seoDetail ?? null" />

                                <!-- Status Switch -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="status" value="1"
                                                {{ old('status', $page->status) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="hstack gap-2 justify-content-end mt-4">
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Page SEO</button>
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
<style>
    .invalid-feedback:empty { display: none; }
</style>
@endsection
