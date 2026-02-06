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
                        <h4 class="mb-sm-0">Add Site Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.site-settings.index') }}">Site Settings</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add Settings</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.site-settings.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
                                            value="{{ old('company_name') }}" required>
                                        @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Primary Mobile</label>
                                        <input type="text" name="primary_mobile_no" class="form-control @error('primary_mobile_no') is-invalid @enderror"
                                            value="{{ old('primary_mobile_no') }}" required>
                                        @error('primary_mobile_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Secondary Mobile</label>
                                        <input type="text" name="secondary_mobile_no" class="form-control @error('secondary_mobile_no') is-invalid @enderror"
                                            value="{{ old('secondary_mobile_no') }}">
                                        @error('secondary_mobile_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Primary Email</label>
                                        <input type="email" name="primary_email" class="form-control @error('primary_email') is-invalid @enderror"
                                            value="{{ old('primary_email') }}" required>
                                        @error('primary_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Secondary Email</label>
                                        <input type="email" name="secondary_email" class="form-control @error('secondary_email') is-invalid @enderror"
                                            value="{{ old('secondary_email') }}">
                                        @error('secondary_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required>{{ old('address') }}</textarea>
                                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Embedded Map</label>
                                        <textarea name="embedded_map" class="form-control @error('embedded_map') is-invalid @enderror" rows="3" required>{{ old('embedded_map') }}</textarea>
                                        @error('embedded_map')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <x-image-upload
                                            name="logo_image"
                                            label="Logo Image"
                                            inputId="logo-input"
                                            previewId="logo-preview"
                                            containerId="logo-preview-container"
                                            removeBtnId="remove-logo"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('logo_image')"
                                            helpText="Upload company logo (PNG/JPG/WebP). Max 2MB."
                                        />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <x-image-upload
                                            name="fav_icon_image"
                                            label="Favicon Image"
                                            inputId="favicon-input"
                                            previewId="favicon-preview"
                                            containerId="favicon-preview-container"
                                            removeBtnId="remove-favicon"
                                            maxWidth="50"
                                            maxHeight="50"
                                            :required="false"
                                            :error="$errors->first('fav_icon_image')"
                                            helpText="Upload favicon (PNG/ICO). Max 1MB."
                                        />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Footer Text</label>
                                        <input type="text" name="footer_text" class="form-control @error('footer_text') is-invalid @enderror"
                                            value="{{ old('footer_text') }}" required>
                                        @error('footer_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Instagram Link</label>
                                        <input type="url" name="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror"
                                            value="{{ old('instagram_link') }}">
                                        @error('instagram_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Facebook Link</label>
                                        <input type="url" name="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror"
                                            value="{{ old('facebook_link') }}">
                                        @error('facebook_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">WhatsApp Link</label>
                                        <input type="url" name="whatsapp_link" class="form-control @error('whatsapp_link') is-invalid @enderror"
                                            value="{{ old('whatsapp_link') }}">
                                        @error('whatsapp_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">LinkedIn Link</label>
                                        <input type="url" name="linkedin_link" class="form-control @error('linkedin_link') is-invalid @enderror"
                                            value="{{ old('linkedin_link') }}">
                                        @error('linkedin_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                </div>

                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.site-settings.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Create Settings</button>
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
