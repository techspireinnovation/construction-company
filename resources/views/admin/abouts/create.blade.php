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
                                <i class="ri-add-line align-middle me-2"></i>Create About Section
                            </h4>
                            <p class="text-muted mb-0 mt-1">Fill in your company information below</p>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.abouts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Mission -->
                                    <div class="col-md-6 mb-3">
                                        <x-image-upload
                                            name="mission[0][image]"
                                            label="Mission Image"
                                            value="{{ old('mission.0.image') }}"
                                            inputId="mission_image_input"
                                            previewId="mission_image_preview"
                                            containerId="mission_image_preview_container"
                                            removeBtnId="remove_mission_image"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('mission.0.image')"
                                            helpText="Upload mission image. Max size: 5MB."
                                        />

                                        <label for="mission_content" class="form-label mt-2">Mission Content</label>
                                        <textarea name="mission[0][content]" id="mission_content" class="form-control" rows="3">{{ old('mission.0.content') }}</textarea>
                                        @error('mission.0.content')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Vision -->
                                    <div class="col-md-6 mb-3">
                                        <x-image-upload
                                            name="vision[0][image]"
                                            label="Vision Image"
                                            value="{{ old('vision.0.image') }}"
                                            inputId="vision_image_input"
                                            previewId="vision_image_preview"
                                            containerId="vision_image_preview_container"
                                            removeBtnId="remove_vision_image"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('vision.0.image')"
                                            helpText="Upload vision image. Max size: 5MB."
                                        />

                                        <label for="vision_content" class="form-label mt-2">Vision Content</label>
                                        <textarea name="vision[0][content]" id="vision_content" class="form-control" rows="3">{{ old('vision.0.content') }}</textarea>
                                        @error('vision.0.content')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="row mt-3">
                                    <div class="col-md-3 mb-3">
                                        <label for="years_of_experience" class="form-label">Years of Experience</label>
                                        <input type="number" name="stats[years_of_experience]" class="form-control" value="{{ old('stats.years_of_experience') }}">
                                        @error('stats.years_of_experience')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="no_of_projects" class="form-label">No. of Projects</label>
                                        <input type="number" name="stats[no_of_projects]" class="form-control" value="{{ old('stats.no_of_projects') }}">
                                        @error('stats.no_of_projects')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="no_of_employees" class="form-label">No. of Employees</label>
                                        <input type="number" name="stats[no_of_employees]" class="form-control" value="{{ old('stats.no_of_employees') }}">
                                        @error('stats.no_of_employees')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="no_of_satisfied_clients" class="form-label">No. of Satisfied Clients</label>
                                        <input type="number" name="stats[no_of_satisfied_clients]" class="form-control" value="{{ old('stats.no_of_satisfied_clients') }}">
                                        @error('stats.no_of_satisfied_clients')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success mt-3">
                                    <i class="ri-save-3-line align-middle me-1"></i> Save About
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

@section('script')
<script src="{{ asset('js/imagePreviewService.js') }}"></script>
@endsection
