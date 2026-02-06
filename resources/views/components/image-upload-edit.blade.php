@props([
    'name',
    'label',
    'existingImage' => null,
    'maxWidth' => 200,
    'maxHeight' => 150,
    'required' => false,
    'error' => null,
    'helpText' => 'Upload image. Max size: 5MB.',
    'accept' => 'image/*',
    'inputId' => null,
    'previewId' => null,
    'containerId' => null,
    'removeBtnId' => null,
    'existingImagePath' => null,
    'value' => null
])

@php
    $inputId = $inputId ?? 'image_input_' . Str::random(8);
    $previewId = $previewId ?? 'image_preview_' . Str::random(8);
    $containerId = $containerId ?? 'image_preview_container_' . Str::random(8);
    $removeBtnId = $removeBtnId ?? 'remove_image_' . Str::random(8);

    // If value is provided, use it as existing image
    if ($value && empty($existingImage)) {
        $existingImage = $value;
    }

    // Extract just the filename for display
    $existingImageFilename = $existingImage ? basename($existingImage) : null;
@endphp

<div class="image-upload-edit mb-3">
    <label class="form-label">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>

    @if($existingImage)
        <!-- Show existing image -->
        <div class="existing-image-section mb-2">
            <div class="d-flex align-items-start">
                <div class="me-3">
                    <img src="{{ asset('storage/' . $existingImage) }}"
                         alt="Existing Image"
                         class="img-thumbnail"
                         style="max-width: {{ $maxWidth }}px; max-height: {{ $maxHeight }}px;">
                </div>
                <div class="flex-grow-1">
                    <div class="mb-2">
                        <input type="hidden"
                               name="{{ $name }}_existing"
                               value="{{ $existingImage }}"
                               class="existing-image-input"
                               data-original="{{ $existingImage }}">
                        <span class="text-muted d-block">Current image: {{ $existingImageFilename }}</span>
                        <small class="text-muted">Upload new image to replace current one</small>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input remove-image-checkbox"
                               type="checkbox"
                               name="{{ $name }}_remove"
                               id="remove_{{ $name }}"
                               value="1">
                        <label class="form-check-label text-danger" for="remove_{{ $name }}">
                            <i class="ri-delete-bin-line align-middle me-1"></i> Remove current image
                        </label>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <input type="file"
           name="{{ $name }}"
           id="{{ $inputId }}"
           class="form-control image-input @error(str_replace(['[', ']'], ['.', ''], $name)) is-invalid @enderror"
           accept="{{ $accept }}"
           @if(!$required && !$existingImage) @elseif($required) required @endif
           data-preview-id="{{ $previewId }}"
           data-container-id="{{ $containerId }}">

    @error(str_replace(['[', ']'], ['.', ''], $name))
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <!-- Image Preview Container -->
    <div class="image-preview-container mt-2" id="{{ $containerId }}" style="display: none;">
        <div class="preview-wrapper d-flex align-items-center">
            <img class="preview-image img-thumbnail"
                 id="{{ $previewId }}"
                 src=""
                 alt="Preview"
                 style="max-width: {{ $maxWidth }}px; max-height: {{ $maxHeight }}px;">
            <button type="button"
                    class="btn btn-sm btn-danger ms-2 remove-preview"
                    id="{{ $removeBtnId }}"
                    data-input-id="{{ $inputId }}"
                    data-preview-id="{{ $previewId }}"
                    data-container-id="{{ $containerId }}">
                <i class="ri-delete-bin-line align-middle me-1"></i> Remove Preview
            </button>
        </div>
    </div>

    @if($helpText)
        <div class="form-text">{{ $helpText }}</div>
    @endif
</div>