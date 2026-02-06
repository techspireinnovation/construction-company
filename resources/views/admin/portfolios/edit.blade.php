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
                        <h4 class="mb-sm-0">Edit Portfolio</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.portfolios.index') }}">Portfolios</a></li>
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
                            <h4 class="card-title mb-0">Edit Portfolio</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('admin.portfolios.update', $portfolio->id) }}"
                                  enctype="multipart/form-data"
                                  autocomplete="off">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   value="{{ old('title', $portfolio->title) }}"
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
                                                    <option value="{{ $category->id }}"
                                                        {{ old('portfolio_category_id', $portfolio->portfolio_category_id) == $category->id ? 'selected' : '' }}>
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
                                                    <option value="{{ $partner->id }}"
                                                        {{ old('partner_id', $portfolio->partner_id) == $partner->id ? 'selected' : '' }}>
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
                                            value="{{ old('banner_image', $portfolio->banner_image) }}"
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
                                             class="d-flex flex-wrap gap-2 mt-2">
                                            @php
                                                $images = is_array($portfolio->images) ? $portfolio->images : json_decode($portfolio->images, true) ?? [];
                                            @endphp
                                            @foreach($images as $img)
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/'.$img) }}" width="80" height="80" class="rounded">
                                                    <button type="button" class="btn-close position-absolute top-0 end-0 remove-image-btn" data-image="{{ $img }}"></button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Project Status -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Project Status</label>
                                            <select name="project_status"
                                                    class="form-select @error('project_status') is-invalid @enderror"
                                                    required>
                                                <option value="0" {{ old('project_status', $portfolio->project_status) == 0 ? 'selected' : '' }}>Completed</option>
                                                <option value="1" {{ old('project_status', $portfolio->project_status) == 1 ? 'selected' : '' }}>Ongoing</option>
                                                <option value="2" {{ old('project_status', $portfolio->project_status) == 2 ? 'selected' : '' }}>Upcoming</option>
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
                                                       {{ old('status', $portfolio->status) ? 'checked' : '' }}>
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
                                                      rows="3">{{ old('short_description', $portfolio->short_description) }}</textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12">
                                        <x-rich-text-editor
                                            name="description"
                                            value="{{ old('description', $portfolio->description) }}"
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
                                                   value="{{ old('start_date', $portfolio->start_date?->format('Y-m-d')) }}"
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
                                                   value="{{ old('end_date', $portfolio->end_date?->format('Y-m-d')) }}"
                                                   required>
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- SEO Fields -->
                                    <x-seo-fields :seo="$portfolio->seo" />

                                </div>

                                <!-- Actions -->
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.portfolios.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Portfolio</button>
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
.position-relative { display: inline-block; }
.remove-image-btn { cursor: pointer; }
</style>
@endsection

@section('script')
<script src="{{ asset('js/multi-image-uploader.js') }}"></script>
<script src="{{ asset('js/richTextEditor.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Multi Image Uploader
    new MultiImageUploader({
        input: '#portfolio-images-input',
        preview: '#portfolio-images-preview-container'
    });

    // Remove existing images
    document.querySelectorAll('.remove-image-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const imgDiv = this.closest('div.position-relative');
            imgDiv.remove();
        });
    });
});
</script>
@endsection
