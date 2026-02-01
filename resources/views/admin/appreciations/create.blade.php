@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Testimonial</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.appreciations.index') }}">Testimonials</a></li>
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
                            <h4 class="card-title mb-0">Add New Testimonial</h4>
                        </div>
                        <div class="card-body">
                            <form id="createForm" method="POST" action="{{ route('admin.appreciations.store') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name-field" class="form-label">Name</label>
                                            <input type="text" id="name-field" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="designation-field" class="form-label">Designation</label>
                                            <input type="text" id="designation-field" name="designation" class="form-control @error('designation') is-invalid @enderror" placeholder="Enter Designation" value="{{ old('designation') }}">
                                            @error('designation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company-name-field" class="form-label">Company Name</label>
                                            <input type="text" id="company-name-field" name="company_name" class="form-control @error('company_name') is-invalid @enderror" placeholder="Enter Company Name" value="{{ old('company_name') }}">
                                            @error('company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="message-field" class="form-label">Message</label>
                                            <textarea id="message-field" name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Enter Message">{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image-field" class="form-label">Image</label>
                                            <input type="file" id="image-field" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                            <div id="image-preview" style="margin-top: 10px;"></div>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-left:40px;">
                                        <div class="mb-3">
                                            <label for="status-field" class="form-label">Status</label><br>
                                            <div class="form-check form-switch">
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
                                    <a href="{{ route('admin.appreciations.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Add Testimonial</button>
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
    .image-preview { max-width: 100px; max-height: 100px; margin: 5px; }
</style>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview
        document.querySelector('#image-field').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const previewContainer = document.querySelector('#image-preview');
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
    });
</script>
@endsection