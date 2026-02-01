@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Site Settings</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.site_setting.index') }}">Settings</a>
                            </li>
                            <li class="breadcrumb-item active">Overview</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Manage Site Settings</h4>
                        </div>

                        <div class="card-body">
                            @if ($SiteSettings)
                                <div class="row g-4">

                                    <!-- Company Name -->
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Company Name</h5>
                                                <p class="card-text">{{ $SiteSettings->company_name }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Primary Mobile -->
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Primary Mobile</h5>
                                                <p class="card-text">{{ $SiteSettings->primary_mobile_no }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Secondary Mobile -->
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Secondary Mobile</h5>
                                                <p class="card-text">{{ $SiteSettings->secondary_mobile_no ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Primary Email -->
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Primary Email</h5>
                                                <p class="card-text">{{ $SiteSettings->primary_email }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Secondary Email -->
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Secondary Email</h5>
                                                <p class="card-text">{{ $SiteSettings->secondary_email ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Address</h5>
                                                <p class="card-text">{{ $SiteSettings->address }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Embedded Map -->
                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Google Map</h5>
                                                {!! $SiteSettings->embedded_map !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer Text -->
                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Footer Text</h5>
                                                <p class="card-text">{!! $SiteSettings->footer_text !!}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Logo -->
                                    <div class="col-md-4">
                                        <div class="card h-100 text-center">
                                            <div class="card-body">
                                                <h5 class="card-title">Logo</h5>
                                                @if ($SiteSettings->logo_image)
                                                    <img src="{{ asset('storage/SiteSettings/' . $SiteSettings->logo_image) }}"
                                                         class="img-fluid"
                                                         style="max-height:100px">
                                                @else
                                                    <p>N/A</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Favicon -->
                                    <div class="col-md-4">
                                        <div class="card h-100 text-center">
                                            <div class="card-body">
                                                <h5 class="card-title">Favicon</h5>
                                                @if ($SiteSettings->fav_icon_image)
                                                    <img src="{{ asset('storage/SiteSettings/' . $SiteSettings->fav_icon_image) }}"
                                                         class="img-fluid"
                                                         style="max-height:100px">
                                                @else
                                                    <p>N/A</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Social Links -->
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Social Links</h5>
                                                <p>Facebook: {{ $SiteSettings->facebook_link ?? 'N/A' }}</p>
                                                <p>Instagram: {{ $SiteSettings->instagram_link ?? 'N/A' }}</p>
                                                <p>WhatsApp: {{ $SiteSettings->whatsapp_link ?? 'N/A' }}</p>
                                                <p>LinkedIn: {{ $SiteSettings->linkedin_link ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action -->
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('admin.site_setting.edit') }}"
                                           class="btn btn-primary px-5 py-2">
                                            Edit Settings
                                        </a>
                                    </div>

                                </div>
                            @else
                                <div class="text-center">
                                    <h5>No Site Settings Found</h5>
                                    <a href="{{ route('admin.site_setting.edit') }}"
                                       class="btn btn-primary mt-3">
                                        Configure Settings
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
