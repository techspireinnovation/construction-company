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
                        <h4 class="mb-sm-0">Add Gallery</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.galleries.index') }}">Galleries</a>
                                </li>
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
                            <h4 class="card-title mb-0">Add New Gallery</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('admin.galleries.store') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <!-- Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text"
                                               name="title"
                                               class="form-control @error('title') is-invalid @enderror"
                                               value="{{ old('title') }}"
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
                                                   {{ old('status',1) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>

                                    <!-- Multiple Images -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Gallery Images</label>
                                        <input type="file"
       id="gallery-images-input"
       name="images[]"
       class="form-control"
       multiple
       accept="image/*">

<div id="gallery-preview-container"
     class="d-flex flex-wrap gap-2 mt-2"
     style="display:none;"></div>


                                        @error('images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                        <small class="text-muted">
                                            Upload multiple images (jpeg, png, webp)
                                        </small>
                                    </div>

                                    <!-- Preview Container -->
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
                                    <button type="submit" class="btn btn-success">Add Gallery</button>
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
@section('script')
<script src="{{ asset('js/multi-image-uploader.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new MultiImageUploader({
        input: '#gallery-images-input',
        preview: '#gallery-preview-container'
    });
});
</script>
@endsection


@endsection
