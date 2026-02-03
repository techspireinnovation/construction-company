@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @include('components.toaster')

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Gallery</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.galleries.index') }}">Galleries</a></li>
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
                            <h4 class="card-title mb-0">Edit Gallery</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('admin.galleries.update', $gallery->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <!-- Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text"
                                               name="title"
                                               class="form-control @error('title') is-invalid @enderror"
                                               value="{{ old('title', $gallery->title) }}"
                                               required>
                                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="status"
                                                   value="1"
                                                   {{ old('status', $gallery->status) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>

                                    <!-- Existing Images -->
                                    @if(!empty($gallery->images) && count($gallery->images))
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Existing Images</label>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($gallery->images as $image)
                                                    <div class="position-relative border rounded p-1" style="width:150px">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                             class="rounded w-100"
                                                             style="height:120px;object-fit:cover;">
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-image"
                                                                data-image="{{ $image }}">
                                                            &times;
                                                        </button>
                                                        <input type="hidden"
                                                               name="existing_images[]"
                                                               value="{{ $image }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <!-- New Images -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Add More Images</label>
                                        <input type="file"
                                               id="gallery-images-input"
                                               name="images[]"
                                               class="form-control @error('images') is-invalid @enderror"
                                               multiple
                                               accept="image/*">

                                        @error('images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                        <small class="text-muted">
                                            Upload multiple images (jpeg, png, webp)
                                        </small>
                                    </div>

                                    <!-- New Preview -->
                                    <div class="col-md-12">
                                        <div id="gallery-preview-container"
                                             class="d-flex flex-wrap gap-2 mt-2"
                                             style="display:none;">
                                        </div>
                                    </div>

                                </div>

                                <!-- Buttons -->
                                <div class="hstack gap-2 justify-content-end mt-3">
                                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Gallery</button>
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
@section('script')

{{-- Reusable multi image uploader --}}
<script src="{{ asset('js/multi-image-uploader.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* Remove existing images (soft remove via hidden input removal) */
    document.querySelectorAll('.remove-existing-image').forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.position-relative').remove();
        });
    });

    /* Reusable new image uploader */
    new MultiImageUploader({
        input: '#gallery-images-input',
        preview: '#gallery-preview-container'
    });

});
</script>

@endsection
