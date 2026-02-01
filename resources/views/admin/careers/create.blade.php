@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Career</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.careers.index') }}">Careers</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add New Career</h4>
                        </div>
                        <div class="card-body">
                            <form id="createForm" method="POST" action="{{ route('admin.careers.store') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title-field" class="form-label">Title</label>
                                            <input type="text" id="title-field" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title" value="{{ old('title') }}">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_name-field" class="form-label">Company Name</label>
                                            <input type="text" id="company_name-field" name="company_name" class="form-control @error('company_name') is-invalid @enderror" placeholder="Enter Company Name" value="{{ old('company_name') }}">
                                            @error('company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_location-field" class="form-label">Company Location</label>
                                            <input type="text" id="company_location-field" name="company_location" class="form-control @error('company_location') is-invalid @enderror" placeholder="Enter Company Location" value="{{ old('company_location') }}">
                                            @error('company_location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="employment_type-field" class="form-label">Employment Type</label>
                                            <select id="employment_type-field" name="employment_type" class="form-control @error('employment_type') is-invalid @enderror">
                                                <option value="">Select Employment Type</option>
                                                <option value="Full-time" {{ old('employment_type') === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                                <option value="Part-time" {{ old('employment_type') === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                                <option value="Contract" {{ old('employment_type') === 'Contract' ? 'selected' : '' }}>Contract</option>
                                                <option value="Temporary" {{ old('employment_type') === 'Temporary' ? 'selected' : '' }}>Temporary</option>
                                                <option value="Internship" {{ old('employment_type') === 'Internship' ? 'selected' : '' }}>Internship</option>
                                            </select>
                                            @error('employment_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="salary_range-field" class="form-label">Salary Range</label>
                                            <input type="text" id="salary_range-field" name="salary_range" class="form-control @error('salary_range') is-invalid @enderror" placeholder="e.g., $18 - $22/hr, $50k - $60k" value="{{ old('salary_range') }}">
                                            @error('salary_range')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="shift_type-field" class="form-label">Shift Type</label>
                                            <select id="shift_type-field" name="shift_type" class="form-control @error('shift_type') is-invalid @enderror">
                                                <option value="">Select Shift Type</option>
                                                <option value="On-site" {{ old('shift_type') === 'On-site' ? 'selected' : '' }}>On-site</option>
                                                <option value="Remote" {{ old('shift_type') === 'Remote' ? 'selected' : '' }}>Remote</option>
                                                <option value="Hybrid" {{ old('shift_type') === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                <option value="Night Shift" {{ old('shift_type') === 'Night Shift' ? 'selected' : '' }}>Night Shift</option>
                                                <option value="Day Shift" {{ old('shift_type') === 'Day Shift' ? 'selected' : '' }}>Day Shift</option>
                                            </select>
                                            @error('shift_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="short_description-field" class="form-label">Short Description</label>
                                            <textarea id="short_description-field" name="short_description" class="form-control @error('short_description') is-invalid @enderror" placeholder="Enter Short Description">{{ old('short_description') }}</textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description-field" class="form-label">Description</label>
                                            <textarea id="description-field" name="description" class="form-control summernote @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="requirements-field" class="form-label">Requirements</label>
                                            <textarea id="requirements-field" name="requirements" class="form-control summernote @error('requirements') is-invalid @enderror" placeholder="Enter Requirements">{{ old('requirements') }}</textarea>
                                            @error('requirements')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="job_type-field" class="form-label">Job Type</label>
                                            <input type="text" id="job_type-field" name="job_type" class="form-control @error('job_type') is-invalid @enderror" placeholder="e.g., Security Guard, Training Instructor" value="{{ old('job_type') }}">
                                            @error('job_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_logo-field" class="form-label">Company Logo</label>
                                            <input type="file" id="company_logo-field" name="company_logo" class="form-control @error('company_logo') is-invalid @enderror" accept="image/*">
                                            <div id="company_logo-preview" style="margin-top: 10px;"></div>
                                            @error('company_logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="posted_date-field" class="form-label">Posted Date</label>
                                            <input type="date" id="posted_date-field" name="posted_date" class="form-control @error('posted_date') is-invalid @enderror" value="{{ old('posted_date') }}">
                                            @error('posted_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="responsibilities-field" class="form-label">Responsibilities</label>
                                            <textarea id="responsibilities-field" name="responsibilities" class="form-control summernote @error('responsibilities') is-invalid @enderror" placeholder="Enter Responsibilities">{{ old('responsibilities') }}</textarea>
                                            @error('responsibilities')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6"  style="padding-left:40px;">
                                        <div class="mb-3">
                                            <label for="status-field" class="form-label">Status</label><br>
                                            <div class="form-check form-switch">
                                                <input type="hidden" name="status" value="0">
                                                <input type="checkbox" id="status-field" name="status" class="form-check-input" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status-field">{{ old('status', 1) ? 'Active' : 'Inactive' }}</label>
                                            </div>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.careers.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Add Career</button>
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
    .image-preview { max-width: 100px; max-height: 100px; margin: 5px; }
</style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@4.17.9/dist/tagify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview for company logo
        document.querySelector('#company_logo-field').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const previewContainer = document.querySelector('#company_logo-preview');
            previewContainer.innerHTML = ''; // Clear existing preview

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('image-preview');
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });

        // Initialize Summernote for description, requirements, and responsibilities
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endsection