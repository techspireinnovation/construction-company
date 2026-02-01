@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Include the _message.blade.php partial -->


            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Site Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.site_setting.index') }}">Settings</a></li>
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
                            <h4 class="card-title mb-0">Edit Site Settings</h4>
                        </div>
                        <div class="card-body">
                            <form id="editForm" method="POST" action="{{ route('admin.settings.update', $settings->id ?? 1) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="site-title-field" class="form-label">Site Title</label>
                                            <input type="text" id="site-title-field" name="site_title" class="form-control @error('site_title') is-invalid @enderror" placeholder="Enter Site Title" value="{{ old('site_title', $settings->site_title ?? '') }}">
                                            @error('site_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email-field" class="form-label">Email</label>
                                            <input type="email" id="email-field" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" value="{{ old('email', $settings->email ?? '') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="receive-email-field" class="form-label">Receive Email</label>
                                            <input type="email" id="receive-email-field" name="receive_email" class="form-control @error('receive_email') is-invalid @enderror" placeholder="Enter Receive Email" value="{{ old('receive_email', $settings->receive_email ?? '') }}">
                                            @error('receive_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone-1-field" class="form-label">Phone 1</label>
                                            <input type="text" id="phone-1-field" name="phone_1" class="form-control @error('phone_1') is-invalid @enderror" placeholder="Enter Phone 1" value="{{ old('phone_1', $settings->phone_1 ?? '') }}">
                                            @error('phone_1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone-2-field" class="form-label">Phone 2</label>
                                            <input type="text" id="phone-2-field" name="phone_2" class="form-control @error('phone_2') is-invalid @enderror" placeholder="Enter Phone 2" value="{{ old('phone_2', $settings->phone_2 ?? '') }}">
                                            @error('phone_2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company-name-field" class="form-label">Company Name</label>
                                            <input type="text" id="company-name-field" name="company_name" class="form-control @error('company_name') is-invalid @enderror" placeholder="Enter Company Name" value="{{ old('company_name', $settings->company_name ?? '') }}">
                                            @error('company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address-field" class="form-label">Address</label>
                                            <textarea id="address-field" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address" rows="4">{{ old('address', $settings->address ?? '') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="google-map-field" class="form-label">Google Map Embed Code</label>
                                            <textarea id="google-map-field" name="google_map" class="form-control @error('google_map') is-invalid @enderror" placeholder="Enter Google Map Embed Code" rows="4">{{ old('google_map', $settings->google_map ?? '') }}</textarea>
                                            @error('google_map')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="footer-about-field" class="form-label">Footer About</label>
                                            <textarea id="footer-about-field" name="footer_about" class="form-control summernote @error('footer_about') is-invalid @enderror" placeholder="Enter Footer About">{{ old('footer_about', $settings->footer_about ?? '') }}</textarea>
                                            @error('footer_about')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="logo-field" class="form-label">Logo</label>
                                            <input type="file" id="logo-field" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                                            @if ($settings && $settings->logo)
                                                <img id="logo-preview" src="{{ asset('storage/settings/' . $settings->logo) }}" alt="Logo" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                            @else
                                                <img id="logo-preview" src="" alt="Logo" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                            @endif
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="favicon-field" class="form-label">Favicon</label>
                                            <input type="file" id="favicon-field" name="favicon" class="form-control @error('favicon') is-invalid @enderror" accept="image/*">
                                            @if ($settings && $settings->favicon)
                                                <img id="favicon-preview" src="{{ asset('storage/settings/' . $settings->favicon) }}" alt="Favicon" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                            @else
                                                <img id="favicon-preview" src="" alt="Favicon" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                            @endif
                                            @error('favicon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook-url-field" class="form-label">Facebook URL</label>
                                            <input type="url" id="facebook-url-field" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" placeholder="Enter Facebook URL" value="{{ old('facebook_url', $settings->facebook_url ?? '') }}">
                                            @error('facebook_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="whatsapp-url-field" class="form-label">WhatsApp URL</label>
                                            <input type="url" id="whatsapp-url-field" name="whatsapp_url" class="form-control @error('whatsapp_url') is-invalid @enderror" placeholder="Enter WhatsApp URL" value="{{ old('whatsapp_url', $settings->whatsapp_url ?? '') }}">
                                            @error('whatsapp_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="instagram-url-field" class="form-label">Instagram URL</label>
                                            <input type="url" id="instagram-url-field" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" placeholder="Enter Instagram URL" value="{{ old('instagram_url', $settings->instagram_url ?? '') }}">
                                            @error('instagram_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="twitter-url-field" class="form-label">Twitter URL</label>
                                            <input type="url" id="twitter-url-field" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" placeholder="Enter Twitter URL" value="{{ old('twitter_url', $settings->twitter_url ?? '') }}">
                                            @error('twitter_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="youtube-url-field" class="form-label">YouTube URL</label>
                                            <input type="url" id="youtube-url-field" name="youtube_url" class="form-control @error('youtube_url') is-invalid @enderror" placeholder="Enter YouTube URL" value="{{ old('youtube_url', $settings->youtube_url ?? '') }}">
                                            @error('youtube_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.settings.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Settings</button>
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
</style>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview for logo
        document.querySelector('#logo-field').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.querySelector('#logo-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '{{ $settings && $settings->logo ? asset('storage/settings/' . $settings->logo) : '' }}';
                preview.style.display = '{{ $settings && $settings->logo ? 'block' : 'none' }}';
            }
        });

        // Image preview for favicon
        document.querySelector('#favicon-field').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.querySelector('#favicon-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '{{ $settings && $settings->favicon ? asset('storage/settings/' . $settings->favicon) : '' }}';
                preview.style.display = '{{ $settings && $settings->favicon ? 'block' : 'none' }}';
            }
        });

        // Initialize Summernote for footer_about
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