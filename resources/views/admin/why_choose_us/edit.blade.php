@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('components.toaster')

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Why Choose Us Entry</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.why_choose_us.index') }}">Why Choose Us</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Entry</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.why_choose_us.update', $item->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $item->title) }}" required>
                                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Icon -->
                                    <div class="col-md-6 mb-3">
                                        <x-image-upload
                                            name="icon"
                                            label="Icon Image"
                                            value="{{ $item->icon }}"
                                            inputId="icon-image-input"
                                            previewId="icon-image-preview"
                                            containerId="icon-image-preview-container"
                                            removeBtnId="remove-icon-image"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="!$item->icon"
                                            {{-- Only required if no existing image --}}
                                            :error="$errors->first('icon')"
                                            helpText="Upload icon image (PNG, JPG, GIF). Max size: 2MB."
                                            existingImage="{{ $item->icon ? asset('storage/' . $item->icon) : '' }}"
                                            showRemove="{{ $item->icon ? 'true' : 'false' }}"
                                        />
                                    </div>

                                    <!-- Content and Status side by side -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea name="content" rows="4" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $item->content) }}</textarea>
                                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3 d-flex align-items-center">
                                        <div class="form-check form-switch w-100">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.why_choose_us.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Entry</button>
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
