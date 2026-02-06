@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('components.toaster')

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Why Choose Us Entry</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.why_choose_us.index') }}">Why Choose Us</a></li>
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
                            <h4 class="card-title mb-0">Add New Entry</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.why_choose_us.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Icon -->
                                    <div class="col-md-6 mb-3">
                                        <x-image-upload
                                            name="icon"
                                            label="Icon Image"
                                            value="{{ old('icon') }}"
                                            inputId="icon-image-input"
                                            previewId="icon-image-preview"
                                            containerId="icon-image-preview-container"
                                            removeBtnId="remove-icon-image"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="true"
                                            :error="$errors->first('icon')"
                                            helpText="Upload icon image. Max size: 2MB."
                                        />
                                    </div>

                                    <!-- Content and Status side by side -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea name="content" rows="4" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3 d-flex align-items-center">
                                        <div class="form-check form-switch w-100">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status',1) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.why_choose_us.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Add Entry</button>
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
<script src="{{ asset('js/imagePreviewService.js') }}"></script>
@endsection
