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
                        <h4 class="mb-sm-0">Edit Career</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.careers.index') }}">Careers</a></li>
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
                            <h4 class="card-title mb-0">Edit Career</h4>
                        </div>

                        <div class="card-body">
                            <form id="editCareerForm" method="POST" action="{{ route('admin.careers.update', $career->id) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <!-- Job Title -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Job Title</label>
                                            <input type="text" name="job_title" class="form-control @error('job_title') is-invalid @enderror" placeholder="Enter Job Title" value="{{ old('job_title', $career->job_title) }}" required>
                                            @error('job_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 ps-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', $career->status) ? 'checked' : '' }}>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Employment Type -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Employment Type</label>
                                            <select name="employment_type" class="form-select mb-3 @error('employment_type') is-invalid @enderror" aria-label="Employment Type">
                                                <option value="" {{ old('employment_type', $career->employment_type) === '' ? 'selected' : '' }}>Select Employment Type</option>
                                                <option value="0" {{ old('employment_type', $career->employment_type) == '0' ? 'selected' : '' }}>Full-time</option>
                                                <option value="1" {{ old('employment_type', $career->employment_type) == '1' ? 'selected' : '' }}>Part-time</option>
                                            </select>
                                            @error('employment_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Experience Required -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Experience Required</label>
                                            <input type="text" name="experience_required" class="form-control @error('experience_required') is-invalid @enderror" placeholder="e.g., 2-5 years" value="{{ old('experience_required', $career->experience_required) }}">
                                            @error('experience_required')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Education Level -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Education Level</label>
                                            <select name="education_level" class="form-select mb-3 @error('education_level') is-invalid @enderror" aria-label="Education Level">
                                                <option value="" {{ old('education_level', $career->education_level) === '' ? 'selected' : '' }}>Select Education Level</option>
                                                <option value="0" {{ old('education_level', $career->education_level) == '0' ? 'selected' : '' }}>No formal education</option>
                                                <option value="1" {{ old('education_level', $career->education_level) == '1' ? 'selected' : '' }}>Basic (Up to Grade 8)</option>
                                                <option value="2" {{ old('education_level', $career->education_level) == '2' ? 'selected' : '' }}>SEE/SLC</option>
                                                <option value="3" {{ old('education_level', $career->education_level) == '3' ? 'selected' : '' }}>+2</option>
                                                <option value="4" {{ old('education_level', $career->education_level) == '4' ? 'selected' : '' }}>Diploma</option>
                                                <option value="5" {{ old('education_level', $career->education_level) == '5' ? 'selected' : '' }}>Graduate (Bachelor)</option>
                                                <option value="6" {{ old('education_level', $career->education_level) == '6' ? 'selected' : '' }}>Postgraduate (Master)</option>
                                                <option value="7" {{ old('education_level', $career->education_level) == '7' ? 'selected' : '' }}>PhD</option>
                                            </select>
                                            @error('education_level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Salary Range -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Salary Range</label>
                                            <input type="text" name="salary_range" class="form-control @error('salary_range') is-invalid @enderror" placeholder="e.g., $50k - $60k" value="{{ old('salary_range', $career->salary_range) }}" required>
                                            @error('salary_range')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Shift Duration -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Shift Duration</label>
                                            <input type="text" name="shift_duration" class="form-control @error('shift_duration') is-invalid @enderror" placeholder="e.g., 9am - 5pm" value="{{ old('shift_duration', $career->shift_duration) }}" required>
                                            @error('shift_duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Short Summary -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Short Summary</label>
                                            <textarea name="short_summery" class="form-control @error('short_summery') is-invalid @enderror" rows="3">{{ old('short_summery', $career->short_summery) }}</textarea>
                                            @error('short_summery')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Long Description -->
                                    <div class="col-md-12">
                                        <x-rich-text-editor
                                            name="description"
                                            value="{{ old('description', $career->description) }}"
                                            label="Description"
                                            height="200"
                                            :required="false"
                                            :error="$errors->first('description')"
                                        />
                                    </div>
                                    <div class="col-md-12">

                                    <x-long-sentence-tags
                                    name="requirements"
                                    label="Requirements"
                                    :value="old('requirements', $career->requirements ? $career->requirements : [])"
                                    placeholder="Type requirement and press Enter"
                                    :error="$errors->first('requirements')"
                                />
</div>
<div class="col-md-12">

                                <x-long-sentence-tags
                                    name="responsibilities"
                                    label="Responsibilities"
                                    :value="old('responsibilities', $career->responsibilities ? $career->responsibilities : [])"
                                    placeholder="Type responsibility and press Enter"
                                    :error="$errors->first('responsibilities')"
                                />
                                </div>

                                    <!-- Application Deadline -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Application Deadline</label>
                                            <input type="date" name="application_deadline" class="form-control @error('application_deadline') is-invalid @enderror" value="{{ old('application_deadline', $career->application_deadline ? \Carbon\Carbon::parse($career->application_deadline)->format('Y-m-d') : '') }}" required>
                                            @error('application_deadline')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Banner Image -->
                                    <div class="col-md-6">
                                        <x-image-upload
                                            name="banner_image"
                                            label="Banner Image"
                                            value="{{ old('banner_image', $career->banner_image) }}"
                                            inputId="banner-image-input"
                                            previewId="banner-image-preview"
                                            containerId="banner-image-preview-container"
                                            removeBtnId="remove-banner-image"
                                            maxWidth="400"
                                            maxHeight="200"
                                            :required="false"
                                            :error="$errors->first('banner_image')"
                                            helpText="Upload banner image. Recommended size: 1200x400px. Max size: 5MB."
                                            previewWidth="100"
                                            previewHeight="50"
                                        />
                                    </div>

                                    <!-- SEO Fields -->
                                    <x-seo-fields :seo="$career->seoDetail" />


                                </div>

                                <!-- Actions -->
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.careers.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Career</button>
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
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.min.js"></script>
<script src="{{ asset('js/imagePreviewService.js') }}"></script>
<script src="{{ asset('js/richTextEditor.js') }}"></script>
<script>

</script>
@endsection