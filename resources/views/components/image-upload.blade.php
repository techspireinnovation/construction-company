{{-- resources/views/components/image-upload.blade.php --}}
@props([
    'name' => 'image',
    'label' => 'Image',
    'value' => null,
    'previewId' => 'image-preview',
    'containerId' => 'image-preview-container',
    'removeBtnId' => 'remove-image',
    'inputId' => 'image-input',
    'maxWidth' => 200,
    'maxHeight' => 150,
    'required' => false,
    'error' => null,
    'accept' => 'image/*',
    'helpText' => 'Upload an image file (JPEG, PNG, GIF, WebP, SVG). Max size: 5MB.',
    'showRemove' => true,
])

<div class="mb-3">
    <label class="form-label">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>

    <div class="image-upload-container">
        <input type="file"
               name="{{ $name }}"
               id="{{ $inputId }}"
               class="form-control @error($name) is-invalid @enderror"
               accept="{{ $accept }}"
               @if($required) required @endif>

        <div id="{{ $containerId }}" class="mt-3" style="{{ $value ? '' : 'display: none;' }}">
            <img id="{{ $previewId }}"
                 src="{{ $value ? asset('storage/' . $value) : '#' }}"
                 alt="{{ $label }} Preview"
                 style="max-width: {{ $maxWidth }}px; max-height: {{ $maxHeight }}px; object-fit: cover; border: 1px solid #dee2e6; border-radius: 4px;">

            @if($showRemove)
            <div class="mt-2">
                <button type="button" id="{{ $removeBtnId }}" class="btn btn-sm btn-danger">Remove Image</button>
            </div>
            @endif
        </div>

        @if($value)
            <input type="hidden" name="existing_{{ $name }}" value="{{ $value }}">
        @endif
    </div>

    @if($helpText)
        <div class="form-text">{{ $helpText }}</div>
    @endif

    @if($error)
        <div class="invalid-feedback d-block">{{ $error }}</div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('{{ $inputId }}');
    const imagePreview = document.getElementById('{{ $previewId }}');
    const imagePreviewContainer = document.getElementById('{{ $containerId }}');
    const removeImageBtn = document.getElementById('{{ $removeBtnId }}');

    if (imageInput && imagePreview) {
        // Handle image selection
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate image
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
                const maxSize = 5 * 1024 * 1024; // 5MB

                if (!allowedTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPEG, PNG, GIF, WebP, SVG).');
                    imageInput.value = '';
                    return;
                }

                if (file.size > maxSize) {
                    alert('Image size should be less than 5MB.');
                    imageInput.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    if (imagePreviewContainer) {
                        imagePreviewContainer.style.display = 'block';
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle image removal
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                imagePreview.src = '#';
                if (imagePreviewContainer) {
                    imagePreviewContainer.style.display = 'none';
                }

                // Clear any existing hidden image value
                const existingImageInput = document.querySelector('input[name="existing_{{ $name }}"]');
                if (existingImageInput) {
                    existingImageInput.remove();
                }
            });
        }
    }
});
</script>