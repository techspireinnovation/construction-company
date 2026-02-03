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
                        <h4 class="mb-sm-0">Add Portfolio</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.portfolios.index') }}">Portfolios</a></li>
                                <li class="breadcrumb-item active">Add</li>
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
                            <h4 class="card-title mb-0">Add New Portfolio</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('admin.portfolios.store') }}"
                                  enctype="multipart/form-data"
                                  autocomplete="off">
                                @csrf

                                <div class="row">

                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   value="{{ old('title') }}"
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
                                            <select name="portfolio_category_id"
                                                    class="form-select @error('portfolio_category_id') is-invalid @enderror"
                                                    required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('portfolio_category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('portfolio_category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Partner -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Partner</label>
                                            <select name="partner_id"
                                                    class="form-select @error('partner_id') is-invalid @enderror"
                                                    required>
                                                <option value="">Select Partner</option>
                                                @foreach($partners as $partner)
                                                    <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                                                        {{ $partner->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('partner_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Banner Image -->
                                    <div class="col-md-6">
                                        <x-image-upload
                                            name="banner_image"
                                            label="Banner Image"
                                            value="{{ old('banner_image') }}"
                                            inputId="portfolio-banner-image-input"
                                            previewId="portfolio-banner-image-preview"
                                            containerId="portfolio-banner-image-preview-container"
                                            removeBtnId="remove-portfolio-banner-image"
                                            maxWidth="200"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('banner_image')"
                                            helpText="Upload banner image. Recommended size: 1200x400px. Max size: 5MB."
                                        />
                                    </div>

                                   <!-- Multiple Images -->
<div class="col-md-12 mb-3">
    <label class="form-label">Portfolio Images</label>

    <input type="file"
           id="portfolio-images-input"
           name="images[]"
           class="form-control @error('images') is-invalid @enderror"
           multiple
           accept="image/*">

    @error('images')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('images.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <small class="text-muted">
        Upload multiple images (jpeg, png, webp)
    </small>

    <div id="portfolio-images-preview-container"
         class="d-flex flex-wrap gap-2 mt-2"
         style="display:none;">
    </div>
</div>


                                    <!-- Project Status -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Project Status</label>
                                            <select name="project_status"
                                                    class="form-select @error('project_status') is-invalid @enderror"
                                                    required>
                                                <option value="0" {{ old('project_status') == 0 ? 'selected' : '' }}>Completed</option>
                                                <option value="1" {{ old('project_status') == 1 ? 'selected' : '' }}>Ongoing</option>
                                                <option value="2" {{ old('project_status') == 2 ? 'selected' : '' }}>Upcoming</option>
                                            </select>
                                            @error('project_status')
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
                                                       {{ old('status', 1) ? 'checked' : '' }}>
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
                                                      rows="3">{{ old('short_description') }}</textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12">
                                        <x-rich-text-editor
                                            name="description"
                                            value="{{ old('description') }}"
                                            label="Description"
                                            height="300"
                                            :required="false"
                                            :error="$errors->first('description')"
                                        />
                                    </div>

                                    <!-- Start & End Dates -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Start Date</label>
                                            <input type="date"
                                                   name="start_date"
                                                   class="form-control @error('start_date') is-invalid @enderror"
                                                   value="{{ old('start_date') }}"
                                                   required>
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">End Date</label>
                                            <input type="date"
                                                   name="end_date"
                                                   class="form-control @error('end_date') is-invalid @enderror"
                                                   value="{{ old('end_date') }}"
                                                   required>
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- SEO Fields -->
                                    <x-seo-fields :seo="null" />

                                </div>

                                <!-- Actions -->
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.portfolios.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Save Portfolio</button>
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

<script src="{{ asset('js/multi-image-uploader.js') }}"></script>
<script src="{{ asset('js/richTextEditor.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    new MultiImageUploader({
        input: '#portfolio-images-input',
        preview: '#portfolio-images-preview-container'
    });
});
</script>

@endsection
