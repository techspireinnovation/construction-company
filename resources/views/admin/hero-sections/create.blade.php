@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('components.toaster')

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Hero Section</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.hero-sections.index') }}">Hero</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card">

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.hero-sections.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Hero Type</label>
                                    <select name="type" id="hero-type" class="form-select @error('type') is-invalid @enderror" required>
                                        <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Images</option>
                                        <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Video</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Images block (JS toggle) --}}
                                <div id="hero-images" class="{{ old('type') == '2' ? 'd-none' : '' }}">
                                    <div id="slides-container">
                                        @php
                                            $oldImages = old('hero_with_images', [['title' => '', 'content' => '']]);
                                            $imageCount = count($oldImages);
                                        @endphp

                                        @foreach($oldImages as $index => $image)
                                            <div class="slide-container" id="slide-{{ $index }}" data-index="{{ $index }}">
                                                <div class="border rounded p-3 mb-3">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <h6 class="mb-0">Slide {{ $index + 1 }}</h6>
                                                        @if($index > 0)
                                                            <button type="button" class="btn btn-danger btn-sm remove-slide">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                                        <input type="text" name="hero_with_images[{{ $index }}][title]"
                                                               class="form-control @error('hero_with_images.' . $index . '.title') is-invalid @enderror"
                                                               placeholder="Enter title" value="{{ old('hero_with_images.' . $index . '.title', $image['title'] ?? '') }}">
                                                        @error('hero_with_images.' . $index . '.title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Content</label>
                                                        <textarea name="hero_with_images[{{ $index }}][content]" class="form-control" rows="3" placeholder="Enter content">{{ old('hero_with_images.' . $index . '.content', $image['content'] ?? '') }}</textarea>
                                                    </div>
                                                    <div>
                                                        <label class="form-label">Image <span class="text-danger">*</span></label>
                                                        <input type="file" name="hero_with_images[{{ $index }}][image]"
                                                               class="form-control image-input @error('hero_with_images.' . $index . '.image') is-invalid @enderror"
                                                               accept="image/*" data-index="{{ $index }}">

                                                        <!-- Show old filename if exists -->
                                                        @if(old('hero_with_images.' . $index . '.image_filename'))
                                                            <input type="hidden" name="hero_with_images[{{ $index }}][image_filename]" value="{{ old('hero_with_images.' . $index . '.image_filename') }}">
                                                            <div class="alert alert-info mt-2">
                                                                Previously uploaded file: {{ old('hero_with_images.' . $index . '.image_filename') }}
                                                            </div>
                                                        @endif

                                                        @error('hero_with_images.' . $index . '.image')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror

                                                        <!-- Image Preview Container -->
                                                        <div class="image-preview-container mt-2" id="image-preview-{{ $index }}" style="display: none;">
                                                            <div class="preview-wrapper d-flex align-items-center">
                                                                <img class="preview-image img-thumbnail" id="preview-image-{{ $index }}" src="" alt="Preview" style="max-width: 200px; max-height: 150px;">
                                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-preview" data-index="{{ $index }}">
                                                                    <i class="ri-delete-bin-line"></i> Remove
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="form-text">Upload slide image. Recommended size: 1920x1080px. Max size: 5MB.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Add Slide Button placed below all slides -->
                                    <div class="text-center mt-3" id="add-slide-container">
                                        <button type="button" class="btn btn-primary" id="add-slide">
                                            <i class="ri-add-line align-middle me-1"></i> Add Another Slide
                                        </button>
                                    </div>
                                </div>

                                {{-- Video block --}}
                                <div id="hero-video" class="{{ old('type') == '2' ? '' : 'd-none' }}">
                                    <div class="border rounded p-3 mb-3">
                                        <h6>Video Content</h6>
                                        <div class="mb-2">
                                            <label class="form-label">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="hero_with_video[title]"
                                                   class="form-control @error('hero_with_video.title') is-invalid @enderror"
                                                   placeholder="Enter title" value="{{ old('hero_with_video.title') }}">
                                            @error('hero_with_video.title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Content</label>
                                            <textarea name="hero_with_video[content]" class="form-control" rows="3" placeholder="Enter content">{{ old('hero_with_video.content') }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Video Embed Code <span class="text-danger">*</span></label>
                                            <textarea name="hero_with_video[embed]" id="video-embed-input"
                                                      class="form-control @error('hero_with_video.embed') is-invalid @enderror"
                                                      rows="4" placeholder="Paste YouTube embed code here...">{{ old('hero_with_video.embed') }}</textarea>
                                            @error('hero_with_video.embed')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Paste the iframe code from YouTube's "Share &gt; Embed" option</small>
                                        </div>

                                        <!-- Video Preview Container -->
                                        <div class="video-preview-container mt-3" id="video-preview-container" style="display: none;">
                                            <h6 class="mb-2">Video Preview</h6>
                                            <div id="video-preview" class="ratio ratio-16x9"></div>
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-sm btn-danger" id="remove-video-preview">
                                                    <i class="ri-delete-bin-line me-1"></i> Remove Preview
                                                </button>
                                            </div>
                                        </div>

                                        <div class="alert alert-info mt-3">
                                            <i class="ri-information-line"></i>
                                            Example: &lt;iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-success">Save Hero</button>
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


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const heroType = document.getElementById('hero-type');
    const heroImages = document.getElementById('hero-images');
    const heroVideo = document.getElementById('hero-video');
    const addSlideContainer = document.getElementById('add-slide-container');
    const addSlideBtn = document.getElementById('add-slide');
    const slidesContainer = document.getElementById('slides-container');
    let slideCount = {{ $imageCount }};

    // Initialize based on selected type
    function initializeType() {
        if (heroType.value === '2') {
            heroImages.classList.add('d-none');
            heroVideo.classList.remove('d-none');
            addSlideContainer.classList.add('d-none');
        } else {
            heroImages.classList.remove('d-none');
            heroVideo.classList.add('d-none');
            addSlideContainer.classList.remove('d-none');
        }
    }

    // Toggle between images and video
    heroType.addEventListener('change', function() {
        initializeType();
    });

    // Initialize type on page load
    initializeType();

    // Add new slide (will appear below existing slides)
    addSlideBtn.addEventListener('click', function() {
        slideCount++;
        const slideContainer = document.createElement('div');
        slideContainer.className = 'slide-container';
        slideContainer.id = `slide-${slideCount - 1}`;
        slideContainer.setAttribute('data-index', slideCount - 1);

        slideContainer.innerHTML = `
            <div class="border rounded p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Slide ${slideCount}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-slide">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
                <div class="mb-2">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="hero_with_images[${slideCount - 1}][title]" class="form-control" placeholder="Enter title" value="">
                </div>
                <div class="mb-2">
                    <label class="form-label">Content</label>
                    <textarea name="hero_with_images[${slideCount - 1}][content]" class="form-control" rows="3" placeholder="Enter content"></textarea>
                </div>
                <div>
                    <label class="form-label">Image <span class="text-danger">*</span></label>
                    <input type="file" name="hero_with_images[${slideCount - 1}][image]" class="form-control image-input" accept="image/*" data-index="${slideCount - 1}">

                    <!-- Image Preview Container -->
                    <div class="image-preview-container mt-2" id="image-preview-${slideCount - 1}" style="display: none;">
                        <div class="preview-wrapper d-flex align-items-center">
                            <img class="preview-image img-thumbnail" id="preview-image-${slideCount - 1}" src="" alt="Preview" style="max-width: 200px; max-height: 150px;">
                            <button type="button" class="btn btn-sm btn-danger ms-2 remove-preview" data-index="${slideCount - 1}">
                                <i class="ri-delete-bin-line"></i> Remove
                            </button>
                        </div>
                    </div>

                    <div class="form-text">Upload slide image. Recommended size: 1920x1080px. Max size: 5MB.</div>
                </div>
            </div>
        `;

        // Append the new slide to slides container (appears below existing slides)
        slidesContainer.appendChild(slideContainer);

        // Initialize image preview for the new slide
        const newImageInput = slideContainer.querySelector('.image-input');
        if (newImageInput) {
            newImageInput.addEventListener('change', handleImagePreview);
        }

        // Initialize remove preview button for the new slide
        const removePreviewBtn = slideContainer.querySelector('.remove-preview');
        if (removePreviewBtn) {
            removePreviewBtn.addEventListener('click', removeImagePreview);
        }
    });

    // Event delegation for remove slide buttons
    slidesContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-slide')) {
            const removeBtn = e.target.closest('.remove-slide');
            const slideContainer = removeBtn.closest('.slide-container');

            if (!slideContainer) return;

            if (document.querySelectorAll('.slide-container').length > 1) {
                slideContainer.remove();
                reindexSlides();
            } else {
                alert('At least one slide is required.');
            }
        }
    });

    // Handle image preview
    function handleImagePreview(e) {
        const index = this.getAttribute('data-index');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            const previewContainer = document.getElementById(`image-preview-${index}`);
            const previewImage = document.getElementById(`preview-image-${index}`);

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    }

    // Remove image preview
    function removeImagePreview() {
        const index = this.getAttribute('data-index');
        const previewContainer = document.getElementById(`image-preview-${index}`);
        const imageInput = document.querySelector(`.image-input[data-index="${index}"]`);

        if (previewContainer) {
            previewContainer.style.display = 'none';
        }

        if (imageInput) {
            imageInput.value = ''; // Clear the file input
        }
    }

    // Re-index remaining slides
    function reindexSlides() {
        const slides = document.querySelectorAll('.slide-container');
        slideCount = slides.length;

        slides.forEach((slide, index) => {
            slide.id = `slide-${index}`;
            slide.setAttribute('data-index', index);

            // Update the slide number in heading
            const heading = slide.querySelector('h6');
            heading.textContent = `Slide ${index + 1}`;

            // Update input names and data-index attributes
            const titleInput = slide.querySelector('input[type="text"]');
            const contentTextarea = slide.querySelector('textarea');
            const fileInput = slide.querySelector('.image-input');
            const previewContainer = slide.querySelector('.image-preview-container');
            const previewImage = slide.querySelector('.preview-image');
            const removePreviewBtn = slide.querySelector('.remove-preview');

            if (titleInput) {
                titleInput.name = `hero_with_images[${index}][title]`;
                // Update validation class if exists
                const errorClass = 'is-invalid';
                if (titleInput.classList.contains(errorClass)) {
                    titleInput.classList.remove(errorClass);
                    const invalidFeedback = titleInput.nextElementSibling;
                    if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
                        invalidFeedback.remove();
                    }
                }
            }
            if (contentTextarea) contentTextarea.name = `hero_with_images[${index}][content]`;
            if (fileInput) {
                fileInput.name = `hero_with_images[${index}][image]`;
                fileInput.setAttribute('data-index', index);

                // Update validation class if exists
                const errorClass = 'is-invalid';
                if (fileInput.classList.contains(errorClass)) {
                    fileInput.classList.remove(errorClass);
                    const invalidFeedback = fileInput.nextElementSibling;
                    if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
                        invalidFeedback.remove();
                    }
                }
            }

            // Update preview elements
            if (previewContainer) {
                previewContainer.id = `image-preview-${index}`;
            }
            if (previewImage) {
                previewImage.id = `preview-image-${index}`;
            }
            if (removePreviewBtn) {
                removePreviewBtn.setAttribute('data-index', index);
            }
        });
    }

    // YouTube Video Preview Functionality
    const videoEmbedInput = document.getElementById('video-embed-input');
    const videoPreviewContainer = document.getElementById('video-preview-container');
    const videoPreview = document.getElementById('video-preview');
    const removeVideoPreviewBtn = document.getElementById('remove-video-preview');

    // Initialize video preview if there's old embed code
    @if(old('hero_with_video.embed'))
        const oldEmbedCode = `{{ old('hero_with_video.embed') }}`;
        const youtubeUrl = extractYouTubeUrl(oldEmbedCode);
        if (youtubeUrl) {
            const videoId = getYouTubeVideoId(youtubeUrl);
            if (videoId) {
                showVideoPreview(videoId);
            }
        }
    @endif

    if (videoEmbedInput) {
        // Extract YouTube URL from embed code and show preview
        videoEmbedInput.addEventListener('input', function() {
            const embedCode = this.value;
            const youtubeUrl = extractYouTubeUrl(embedCode);

            if (youtubeUrl) {
                const videoId = getYouTubeVideoId(youtubeUrl);
                if (videoId) {
                    showVideoPreview(videoId);
                }
            }
        });

        // Remove video preview
        if (removeVideoPreviewBtn) {
            removeVideoPreviewBtn.addEventListener('click', function() {
                videoPreviewContainer.style.display = 'none';
                videoPreview.innerHTML = '';
                videoEmbedInput.value = '';
            });
        }
    }

    // Extract YouTube URL from embed code
    function extractYouTubeUrl(embedCode) {
        // Try to extract src attribute from iframe
        const srcMatch = embedCode.match(/src=["']([^"']+)["']/);
        if (srcMatch && srcMatch[1]) {
            return srcMatch[1];
        }

        // Check if it's already a YouTube URL
        if (embedCode.includes('youtube.com') || embedCode.includes('youtu.be')) {
            return embedCode;
        }

        return null;
    }

    // Extract YouTube video ID from URL
    function getYouTubeVideoId(url) {
        let videoId = null;

        // Regular YouTube URL (youtube.com/watch?v=...)
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);

        if (match && match[2].length === 11) {
            videoId = match[2];
        } else if (url.includes('youtube.com/embed/')) {
            // Embed URL format
            const embedMatch = url.match(/youtube\.com\/embed\/([^?]+)/);
            if (embedMatch && embedMatch[1]) {
                videoId = embedMatch[1];
            }
        } else if (url.includes('youtu.be/')) {
            // Short URL format
            const shortMatch = url.match(/youtu\.be\/([^?]+)/);
            if (shortMatch && shortMatch[1]) {
                videoId = shortMatch[1];
            }
        }

        return videoId;
    }

    // Show video preview
    function showVideoPreview(videoId) {
        videoPreview.innerHTML = `
            <iframe
                src="https://www.youtube.com/embed/${videoId}"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        `;
        videoPreviewContainer.style.display = 'block';
    }

    // Initialize image preview event listeners for existing slides
    document.querySelectorAll('.image-input').forEach(input => {
        input.addEventListener('change', handleImagePreview);
    });

    // Initialize remove preview event listeners
    document.querySelectorAll('.remove-preview').forEach(btn => {
        btn.addEventListener('click', removeImagePreview);
    });
});
</script>
@endpush