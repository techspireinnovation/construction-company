@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    @include('_message')
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Hero Section</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Homepage</li>
                                <li class="breadcrumb-item active">Hero Section</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary bg-opacity-10 border-bottom-0">
                            <div>
                                <h4 class="card-title mb-0 text-primary">
                                    <i class="ri-slideshow-line align-middle me-2"></i>Hero Content
                                </h4>
                                <p class="text-muted mb-0 mt-1">Manage your homepage hero section</p>
                            </div>
                            @if($hero)
                                <a href="{{ route('admin.hero-sections.edit') }}" class="btn btn-primary waves-effect waves-light">
                                    <i class="ri-edit-2-line align-middle me-1"></i> Edit Hero
                                </a>
                            @else
                                <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-success waves-effect waves-light">
                                    <i class="ri-add-line align-middle me-1"></i> Create Hero
                                </a>
                            @endif
                        </div>

                        <div class="card-body">
                            @if($hero)
                                <!-- Hero Type Indicator -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="alert {{ $hero->type == 1 ? 'alert-info' : 'alert-warning' }} bg-opacity-10 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    @if($hero->type == 1)
                                                        <i class="ri-image-2-line fs-3 text-info"></i>
                                                    @else
                                                        <i class="ri-video-line fs-3 text-warning"></i>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="alert-heading mb-1">
                                                        {{ $hero->type == 1 ? 'Image Slideshow Hero' : 'Video Background Hero' }}
                                                    </h5>
                                                    <p class="mb-0">Last updated: {{ $hero->updated_at->format('M d, Y h:i A') }}</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <span class="badge {{ $hero->type == 1 ? 'bg-info' : 'bg-warning' }} rounded-pill">
                                                        {{ $hero->type == 1 ? 'Images' : 'Video' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content Display -->
                                <div class="row">
                                    @if($hero->type == 1)
                                        <!-- Images Type -->
                                        <div class="col-12">
                                            <h5 class="mb-3 border-bottom pb-2">
                                                <i class="ri-image-line me-2"></i>Slides ({{ count(json_decode($hero->hero_with_images, true)) }})
                                            </h5>

                                            <div class="row">
                                                @foreach(json_decode($hero->hero_with_images, true) as $index => $slide)
                                                    <div class="col-lg-6 mb-4">
                                                        <div class="card border h-100">
                                                            <div class="card-header bg-light">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <h6 class="mb-0">
                                                                        <span class="badge bg-primary rounded-circle me-2">{{ $index + 1 }}</span>
                                                                        {{ $slide['title'] }}
                                                                    </h6>
                                                                    <span class="badge bg-secondary">Slide {{ $index + 1 }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                @if(!empty($slide['image']))
                                                                    <div class="mb-3">
                                                                        <div class="image-preview-wrapper position-relative">
                                                                            <img src="{{ asset('storage/'.$slide['image']) }}"
                                                                                 class="img-fluid rounded"
                                                                                 alt="{{ $slide['title'] }}"
                                                                                 style="max-height: 200px; width: 100%; object-fit: cover;">
                                                                            <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center rounded opacity-0"
                                                                                 style="transition: opacity 0.3s;">
                                                                                <span class="text-white"><i class="ri-eye-line fs-4"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <small class="text-muted d-block mt-1">Image Preview</small>
                                                                    </div>
                                                                @endif

                                                                @if(!empty($slide['content']))
                                                                    <div class="mb-3">
                                                                        <label class="form-label text-muted mb-1">Content</label>
                                                                        <div class="border rounded p-3 bg-light">
                                                                            {{ $slide['content'] }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="card-footer bg-transparent">
                                                                <small class="text-muted">
                                                                    <i class="ri-information-line me-1"></i>
                                                                    @if(!empty($slide['image']))
                                                                        Image uploaded
                                                                    @else
                                                                        No image uploaded
                                                                    @endif
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <!-- Video Type -->
                                        <div class="col-12">
                                            <h5 class="mb-3 border-bottom pb-2">
                                                <i class="ri-video-line me-2"></i>Video Content
                                            </h5>

                                            @php
                                                $videoData = json_decode($hero->hero_with_video, true);
                                            @endphp

                                            <div class="row">
                                                <!-- Video Preview -->
                                                <div class="col-lg-8 mb-4">
                                                    <div class="card border">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0">
                                                                <i class="ri-play-circle-line me-2"></i>Video Preview
                                                            </h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if(!empty($videoData['embed']))
                                                                <div class="ratio ratio-16x9">
                                                                    {!! $videoData['embed'] !!}
                                                                </div>
                                                            @else
                                                                <div class="text-center py-5 bg-light rounded">
                                                                    <i class="ri-video-off-line fs-1 text-muted"></i>
                                                                    <p class="mt-2 text-muted">No embed code provided</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Video Details -->
                                                <div class="col-lg-4 mb-4">
                                                    <div class="card border h-100">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0">
                                                                <i class="ri-information-line me-2"></i>Details
                                                            </h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <label class="form-label text-muted mb-1">Title</label>
                                                                <div class="border rounded p-3 bg-light">
                                                                    <strong>{{ $videoData['title'] ?? 'No title' }}</strong>
                                                                </div>
                                                            </div>

                                                            @if(!empty($videoData['content']))
                                                                <div class="mb-3">
                                                                    <label class="form-label text-muted mb-1">Description</label>
                                                                    <div class="border rounded p-3 bg-light">
                                                                        {{ $videoData['content'] }}
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <div class="mb-3">
                                                                <label class="form-label text-muted mb-1">Embed Code Status</label>
                                                                <div class="d-flex align-items-center">
                                                                    @if(!empty($videoData['embed']))
                                                                        <span class="badge bg-success rounded-pill me-2">
                                                                            <i class="ri-check-line me-1"></i>Loaded
                                                                        </span>
                                                                        <small class="text-muted">Embed code is active</small>
                                                                    @else
                                                                        <span class="badge bg-danger rounded-pill me-2">
                                                                            <i class="ri-close-line me-1"></i>Missing
                                                                        </span>
                                                                        <small class="text-muted">No embed code provided</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                            <div>
                                                <small class="text-muted">
                                                    <i class="ri-history-line me-1"></i>
                                                    Created: {{ $hero->created_at->format('M d, Y') }} |
                                                    Updated: {{ $hero->updated_at->format('M d, Y') }}
                                                </small>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            @else
                                <!-- Empty State -->
                                <div class="text-center py-5">
                                    <div class="mb-4">
                                        <i class="ri-slideshow-line display-1 text-muted"></i>
                                    </div>
                                    <h4 class="mb-3">No Hero Section Created</h4>
                                    <p class="text-muted mb-4">Your homepage hero section is currently empty. Create an engaging hero section to welcome your visitors.</p>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="card border h-100 text-center hover-shadow">
                                                        <div class="card-body py-4">
                                                            <i class="ri-image-2-line fs-1 text-info mb-3"></i>
                                                            <h5>Image Slideshow</h5>
                                                            <p class="text-muted small">Multiple slides with images and text</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card border h-100 text-center hover-shadow">
                                                        <div class="card-body py-4">
                                                            <i class="ri-video-line fs-1 text-warning mb-3"></i>
                                                            <h5>Video Background</h5>
                                                            <p class="text-muted small">Single video with overlay content</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-primary btn-lg">
                                            <i class="ri-add-line align-middle me-1"></i> Create Hero Section
                                        </a>
                                    </div>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image hover effect
        const imagePreviews = document.querySelectorAll('.image-preview-wrapper');
        imagePreviews.forEach(wrapper => {
            const overlay = wrapper.querySelector('.image-overlay');
            wrapper.addEventListener('mouseenter', () => {
                overlay.style.opacity = '1';
            });
            wrapper.addEventListener('mouseleave', () => {
                overlay.style.opacity = '0';
            });
        });

        // Toggle raw data arrow
        const rawDataHeader = document.querySelector('[data-bs-target="#rawDataCollapse"]');
        if (rawDataHeader) {
            rawDataHeader.addEventListener('click', function() {
                const icon = this.querySelector('.ri-arrow-down-s-line');
                if (icon.classList.contains('ri-arrow-down-s-line')) {
                    icon.classList.replace('ri-arrow-down-s-line', 'ri-arrow-up-s-line');
                } else {
                    icon.classList.replace('ri-arrow-up-s-line', 'ri-arrow-down-s-line');
                }
            });
        }
    });
</script>
@endpush

@push('styles')
<style>
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease;
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .image-preview-wrapper {
        overflow: hidden;
        border-radius: 8px;
    }

    .image-overlay {
        transition: opacity 0.3s;
    }

    pre {
        background: #1a1a1a;
        color: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    code {
        color: #e83e8c;
    }

    .badge {
        font-weight: 500;
    }

    .alert {
        border: none;
        border-radius: 10px;
    }
</style>
@endpush