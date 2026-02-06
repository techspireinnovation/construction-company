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
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-xs flex-shrink-0">
                                <div class="avatar-title bg-light-primary rounded">
                                    <i class="ri-settings-3-line fs-18"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="mb-1">Site Settings</h4>
                                <p class="text-muted mb-0">Manage your website configuration</p>
                            </div>
                        </div>
                        <div class="page-title-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Card -->
            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-sm">
                                            <div class="avatar-title bg-light-primary rounded fs-18">
                                                <i class="ri-building-2-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">Company Information</h5>
                                        <p class="text-muted mb-0">All your website configuration details</p>
                                    </div>
                                </div>
                                @php $setting = $settings->first(); @endphp
                                @if($setting)
                                    <a href="{{ route('admin.site-settings.edit', $setting->id) }}" class="btn btn-primary">
                                        <i class="ri-edit-2-line align-middle me-1"></i> Edit Settings
                                    </a>
                                @else
                                    <a href="{{ route('admin.site-settings.create') }}" class="btn btn-success">
                                        <i class="ri-add-line align-middle me-1"></i> Add Settings
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            @if($setting)
                                <!-- Company Details Section -->
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <div class="card border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start mb-3">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-light-primary rounded">
                                                                <i class="ri-building-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Company Name</h6>
                                                        <p class="text-muted mb-0">{{ $setting->company_name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start mb-3">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-light-primary rounded">
                                                                <i class="ri-map-pin-line text-info"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Address</h6>
                                                        <p class="text-muted mb-0">{{ $setting->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="mb-4">
                                    <h5 class="card-title mb-3 border-bottom pb-2">
                                        <i class="ri-contacts-line align-middle me-2"></i>Contact Information
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="border rounded p-3">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <i class="ri-phone-line"></i>
                                                    <h6 class="mb-0">Primary Mobile</h6>
                                                </div>
                                                <p class="mb-0 fw-medium">{{ $setting->primary_mobile_no }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="border rounded p-3">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <i class="ri-phone-line text-secondary"></i>
                                                    <h6 class="mb-0">Secondary Mobile</h6>
                                                </div>
                                                <p class="mb-0 fw-medium">{{ $setting->secondary_mobile_no ?? 'Not Set' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="border rounded p-3">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <i class="ri-mail-line text-success"></i>
                                                    <h6 class="mb-0">Primary Email</h6>
                                                </div>
                                                <p class="mb-0 fw-medium">{{ $setting->primary_email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="border rounded p-3">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <i class="ri-mail-line text-warning"></i>
                                                    <h6 class="mb-0">Secondary Email</h6>
                                                </div>
                                                <p class="mb-0 fw-medium">{{ $setting->secondary_email ?? 'Not Set' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Media Section -->
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">
                                                    <i class="ri-image-line align-middle me-2"></i>Company Logo
                                                </h6>
                                            </div>
                                            <div class="card-body text-center">
                                                @if($setting->logo_image)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/'.$setting->logo_image) }}"
                                                             alt="Logo"
                                                             class="img-thumbnail"
                                                             style="max-height: 150px; max-width: 300px; object-fit: contain;">
                                                    </div>
                                                    <small class="text-muted">Click to view full size</small>
                                                @else
                                                    <div class="text-center py-4">
                                                        <div class="avatar-lg mx-auto mb-3">
                                                            <div class="avatar-title bg-light-secondary rounded-circle">
                                                                <i class="ri-image-line fs-24 text-muted"></i>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mb-0">No logo uploaded</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">
                                                    <i class="ri-folder-image-line align-middle me-2"></i>Favicon
                                                </h6>
                                            </div>
                                            <div class="card-body text-center">
                                                @if($setting->fav_icon_image)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/'.$setting->fav_icon_image) }}"
                                                             alt="Favicon"
                                                             class="img-thumbnail rounded-circle"
                                                             style="width: 64px; height: 64px; object-fit: contain;">
                                                    </div>
                                                    <small class="text-muted">Website favicon icon</small>
                                                @else
                                                    <div class="text-center py-4">
                                                        <div class="avatar-lg mx-auto mb-3">
                                                            <div class="avatar-title bg-light-secondary rounded-circle">
                                                                <i class="ri-image-line fs-24 text-muted"></i>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mb-0">No favicon uploaded</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer & Map Section -->
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">
                                                    <i class="ri-file-text-line align-middle me-2"></i>Footer Text
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0">{{ $setting->footer_text }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">
                                                    <i class="ri-map-2-line align-middle me-2"></i>Location Map
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                @if($setting->embedded_map)
                                                    <div class="ratio ratio-16x9">
                                                        {!! str_replace(
                                                            ['width="600"', 'height="450"'],
                                                            ['width="100%"', 'height="100%"'],
                                                            $setting->embedded_map
                                                        ) !!}
                                                    </div>
                                                @else
                                                    <div class="text-center py-4">
                                                        <div class="avatar-lg mx-auto mb-3">
                                                            <div class="avatar-title bg-light-secondary rounded-circle">
                                                                <i class="ri-map-pin-line fs-24 text-muted"></i>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mb-0">No map configured</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Social Links Section -->
                                <div class="mb-4">
                                    <h5 class="card-title mb-3 border-bottom pb-2">
                                        <i class="ri-share-line align-middle me-2"></i>Social Media Links
                                    </h5>
                                    <div class="row">
                                        @php
                                            $socialLinks = [
                                                [
                                                    'platform' => 'Facebook',
                                                    'icon' => 'ri-facebook-circle-fill',
                                                    'color' => 'primary',
                                                    'link' => $setting->facebook_link,
                                                ],
                                                [
                                                    'platform' => 'Instagram',
                                                    'icon' => 'ri-instagram-line',
                                                    'color' => 'danger',
                                                    'link' => $setting->instagram_link,
                                                ],
                                                [
                                                    'platform' => 'WhatsApp',
                                                    'icon' => 'ri-whatsapp-line',
                                                    'color' => 'success',
                                                    'link' => $setting->whatsapp_link,
                                                ],
                                                [
                                                    'platform' => 'LinkedIn',
                                                    'icon' => 'ri-linkedin-box-fill',
                                                    'color' => 'info',
                                                    'link' => $setting->linkedin_link,
                                                ],
                                            ];
                                        @endphp

                                        @foreach($socialLinks as $social)
                                        <div class="col-md-3 col-6 mb-3">
                                            <div class="border rounded p-3 text-center h-100">
                                                <div class="avatar-lg mx-auto mb-3">
                                                    <div class="avatar-title1 bg-light-{{ $social['color'] }} rounded-circle fs-48">
                                                        <i class="{{ $social['icon'] }} text-{{ $social['color'] }}"></i>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">{{ $social['platform'] }}</h6>
                                                <p class="text-muted fs-12 mb-2">
                                                    @if($social['link'])
                                                        <a href="{{ $social['link'] }}" target="_blank" class="text-decoration-underline">
                                                            View Link
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Not Set</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>



                            @else
                                <!-- Empty State -->
                                <div class="text-center py-5">
                                    <div class="avatar-lg mx-auto mb-4">
                                        <div class="avatar-title bg-light-primary rounded-circle fs-24">
                                            <i class="ri-settings-3-line"></i>
                                        </div>
                                    </div>
                                    <h5 class="mb-3">No Settings Found</h5>
                                    <p class="text-muted mb-4">Start by adding your site settings to configure your website.</p>
                                    <a href="{{ route('admin.site-settings.create') }}" class="btn btn-success">
                                        <i class="ri-add-line align-middle me-1"></i> Add Settings
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-title1 {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background-color: #eeefff;
    color: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    font-weight: 500;
    height: 100%;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 100%;
}
    .card {
        border: 1px solid #e9ecef;
        box-shadow: 0 1px 2px rgba(56, 65, 74, 0.05);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 5px 15px rgba(56, 65, 74, 0.08);
    }

    .avatar-title {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .border {
        border-color: #e9ecef !important;
    }

    .bg-light-primary { background-color: rgba(85, 110, 230, 0.1) !important; }
    .bg-light-success { background-color: rgba(52, 195, 143, 0.1) !important; }
    .bg-light-info { background-color: rgba(80, 165, 241, 0.1) !important; }
    .bg-light-warning { background-color: rgba(247, 184, 75, 0.1) !important; }
    .bg-light-danger { background-color: rgba(240, 101, 72, 0.1) !important; }
    .bg-light-secondary { background-color: rgba(116, 120, 141, 0.1) !important; }

    .fs-12 { font-size: 12px !important; }
    .fs-18 { font-size: 18px !important; }
    .fs-24 { font-size: 24px !important; }

    .h-100 { height: 100% !important; }

    .text-decoration-underline {
        text-decoration: underline !important;
    }

    .ratio-16x9 {
        --bs-aspect-ratio: 56.25%;
    }
</style>
@endpush