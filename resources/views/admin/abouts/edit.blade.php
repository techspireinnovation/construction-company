@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('components.toaster')

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-header bg-primary bg-opacity-10 border-bottom-0">
                            <h4 class="card-title mb-0 text-primary">
                                <i class="ri-edit-box-line align-middle me-2"></i>Edit About Section
                            </h4>
                            <p class="text-muted mb-0 mt-1">Update your company information below</p>
                        </div>

                        <div class="card-body">
                            @php
                                $missions = json_decode($about->mission, true) ?? [['image'=>'','content'=>'']];
                                $visions = json_decode($about->vision, true) ?? [['image'=>'','content'=>'']];
                                $stats = json_decode($about->stats, true) ?? [];
                            @endphp

                            <form action="{{ route('admin.abouts.update') }}" method="POST" enctype="multipart/form-data" id="about-form">
                                @csrf
                                @method('PUT')

                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $about->title) }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $about->description) }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Mission -->
                                    <div class="col-md-6 mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Mission Image</label>

                                            @if(!empty($missions[0]['image']))
                                                <!-- Show existing image -->
                                                <div class="existing-image mb-2">
                                                    <img src="{{ asset('storage/' . $missions[0]['image']) }}" alt="Existing Mission Image" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                                    <div class="mt-2">
                                                        <input type="hidden" name="mission[0][existing_image]" value="{{ $missions[0]['image'] }}">
                                                        <span class="text-muted">Current image: {{ basename($missions[0]['image']) }}</span>
                                                    </div>

                                                </div>
                                                <p class="text-muted small">Upload new image to replace current one</p>
                                            @endif

                                            <input type="file" name="mission[0][image]" id="mission_image_input"
                                                   class="form-control image-input @error('mission.0.image') is-invalid @enderror"
                                                   accept="image/*">

                                            @error('mission.0.image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <!-- Image Preview Container -->
                                            <div class="image-preview-container mt-2" id="mission_image_preview_container" style="display: none;">
                                                <div class="preview-wrapper d-flex align-items-center">
                                                    <img class="preview-image img-thumbnail" id="mission_image_preview" src="" alt="Preview" style="max-width: 150px; max-height: 150px;">
                                                    <button type="button" class="btn btn-sm btn-danger ms-2 remove-preview" data-target="mission">
                                                        <i class="ri-delete-bin-line"></i> Remove Preview
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-text">Upload mission image. Max size: 5MB.</div>
                                        </div>

                                        <label for="mission_content" class="form-label mt-2">Mission Content <span class="text-danger">*</span></label>
                                        <textarea name="mission[0][content]" class="form-control" rows="3">{{ old('mission.0.content', $missions[0]['content']) }}</textarea>
                                        @error('mission.0.content')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Vision -->
                                    <div class="col-md-6 mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Vision Image</label>

                                            @if(!empty($visions[0]['image']))
                                                <!-- Show existing image -->
                                                <div class="existing-image mb-2">
                                                    <img src="{{ asset('storage/' . $visions[0]['image']) }}" alt="Existing Vision Image" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                                    <div class="mt-2">
                                                        <input type="hidden" name="vision[0][existing_image]" value="{{ $visions[0]['image'] }}">
                                                        <span class="text-muted">Current image: {{ basename($visions[0]['image']) }}</span>
                                                    </div>
                                                   
                                                </div>
                                                <p class="text-muted small">Upload new image to replace current one</p>
                                            @endif

                                            <input type="file" name="vision[0][image]" id="vision_image_input"
                                                   class="form-control image-input @error('vision.0.image') is-invalid @enderror"
                                                   accept="image/*">

                                            @error('vision.0.image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <!-- Image Preview Container -->
                                            <div class="image-preview-container mt-2" id="vision_image_preview_container" style="display: none;">
                                                <div class="preview-wrapper d-flex align-items-center">
                                                    <img class="preview-image img-thumbnail" id="vision_image_preview" src="" alt="Preview" style="max-width: 150px; max-height: 150px;">
                                                    <button type="button" class="btn btn-sm btn-danger ms-2 remove-preview" data-target="vision">
                                                        <i class="ri-delete-bin-line"></i> Remove Preview
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-text">Upload vision image. Max size: 5MB.</div>
                                        </div>

                                        <label for="vision_content" class="form-label mt-2">Vision Content <span class="text-danger">*</span></label>
                                        <textarea name="vision[0][content]" class="form-control" rows="3">{{ old('vision.0.content', $visions[0]['content']) }}</textarea>
                                        @error('vision.0.content')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="row mt-3">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Years of Experience <span class="text-danger">*</span></label>
                                        <input type="number" name="stats[years_of_experience]" class="form-control" value="{{ old('stats.years_of_experience', $stats['years_of_experience'] ?? '') }}">
                                        @error('stats.years_of_experience')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">No. of Projects <span class="text-danger">*</span></label>
                                        <input type="number" name="stats[no_of_projects]" class="form-control" value="{{ old('stats.no_of_projects', $stats['no_of_projects'] ?? '') }}">
                                        @error('stats.no_of_projects')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">No. of Employees <span class="text-danger">*</span></label>
                                        <input type="number" name="stats[no_of_employees]" class="form-control" value="{{ old('stats.no_of_employees', $stats['no_of_employees'] ?? '') }}">
                                        @error('stats.no_of_employees')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">No. of Satisfied Clients <span class="text-danger">*</span></label>
                                        <input type="number" name="stats[no_of_satisfied_clients]" class="form-control" value="{{ old('stats.no_of_satisfied_clients', $stats['no_of_satisfied_clients'] ?? '') }}">
                                        @error('stats.no_of_satisfied_clients')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success mt-3">
                                    <i class="ri-save-3-line align-middle me-1"></i> Update About
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality for mission
    const missionImageInput = document.getElementById('mission_image_input');
    const missionPreviewContainer = document.getElementById('mission_image_preview_container');
    const missionPreview = document.getElementById('mission_image_preview');

    if (missionImageInput) {
        missionImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    missionPreview.src = e.target.result;
                    missionPreviewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Image preview functionality for vision
    const visionImageInput = document.getElementById('vision_image_input');
    const visionPreviewContainer = document.getElementById('vision_image_preview_container');
    const visionPreview = document.getElementById('vision_image_preview');

    if (visionImageInput) {
        visionImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    visionPreview.src = e.target.result;
                    visionPreviewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Remove preview buttons
    document.querySelectorAll('.remove-preview').forEach(btn => {
        btn.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            if (target === 'mission') {
                missionPreviewContainer.style.display = 'none';
                missionPreview.src = '';
                missionImageInput.value = '';
            } else if (target === 'vision') {
                visionPreviewContainer.style.display = 'none';
                visionPreview.src = '';
                visionImageInput.value = '';
            }
        });
    });

    // Handle remove image checkbox
    document.querySelectorAll('.remove-image-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const isMission = this.id === 'remove-mission-image';
            const existingImageInput = isMission
                ? document.querySelector('input[name="mission[0][existing_image]"]')
                : document.querySelector('input[name="vision[0][existing_image]"]');

            if (this.checked) {
                // If remove is checked, clear the existing image value
                if (existingImageInput) {
                    existingImageInput.value = '';
                }
            } else {
                // If remove is unchecked, restore the original value from data attribute
                if (existingImageInput && existingImageInput.dataset.original) {
                    existingImageInput.value = existingImageInput.dataset.original;
                }
            }
        });
    });

    // Initialize existing image data attributes
    document.querySelectorAll('input[name*="existing_image"]').forEach(input => {
        if (!input.dataset.original) {
            input.dataset.original = input.value;
        }
    });
});
</script>
@endpush