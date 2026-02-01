{{-- resources/views/components/rich-text-editor.blade.php --}}
@props([
    'name' => 'long_description',
    'value' => '',
    'height' => 300,
    'placeholder' => 'Write something...',
    'label' => 'Content',
    'required' => false,
    'error' => null,
])

@php
    // Decode HTML entities
    $decodedValue = html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    // Escape curly braces to prevent Blade errors
    $decodedValue = str_replace(['{', '}'], ['&#123;', '&#125;'], $decodedValue);
@endphp

<div class="mb-3">
    @if($label)
        <label class="form-label">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif

    <div class="snow-editor-{{ $name }}" style="height: {{ $height }}px;">
        <!-- Container will be filled by JavaScript -->
    </div>

    <!-- Hidden input to store the editor content -->
    <input type="hidden"
           name="{{ $name }}"
           id="editor-hidden-{{ $name }}"
           value="{{ $value }}"
           @if($required) required @endif>

    @if($error)
        <div class="invalid-feedback d-block">{{ $error }}</div>
    @endif

    <div class="form-text">Use the toolbar to format your content. You can add images, links, and various formatting options.</div>
</div>

{{-- Add a script block that will be captured --}}
@once
@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
@endpush
@endonce

<script>
document.addEventListener('DOMContentLoaded', function() {
    const containerSelector = '.snow-editor-{{ $name }}';
    const container = document.querySelector(containerSelector);

    if (container && typeof Quill !== 'undefined') {
        const editor = new Quill(container, {
            theme: 'snow',
            placeholder: '{{ $placeholder }}',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['clean'],
                    ['link', 'image', 'video']
                ]
            }
        });

        // Get the initial content from PHP variable
        const initialContent = @json($decodedValue);

        // Set initial content
        if (initialContent) {
            editor.root.innerHTML = initialContent;
        }

        // Update hidden input on content change
        editor.on('text-change', () => {
            const hiddenInput = document.getElementById('editor-hidden-{{ $name }}');
            if (hiddenInput) {
                hiddenInput.value = editor.root.innerHTML;
            }
        });

        // Setup image handler
        const toolbar = editor.getModule('toolbar');
        toolbar.addHandler('image', () => {
            selectLocalImage(editor);
        });

        // Bind to form
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function() {
                const hiddenInput = document.getElementById('editor-hidden-{{ $name }}');
                if (hiddenInput) {
                    hiddenInput.value = editor.root.innerHTML;
                }
            });
        }
    }
});

function selectLocalImage(editor) {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();

    input.onchange = () => {
        const file = input.files[0];
        if (file) {
            // Validate image
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            const maxSize = 5 * 1024 * 1024; // 5MB

            if (!allowedTypes.includes(file.type)) {
                alert('Please select a valid image file (JPEG, PNG, GIF, WebP).');
                return;
            }

            if (file.size > maxSize) {
                alert('Image size should be less than 5MB.');
                return;
            }

            // Create a file reader
            const reader = new FileReader();

            reader.onload = (e) => {
                const range = editor.getSelection();
                editor.insertEmbed(range.index, 'image', e.target.result);
            };

            reader.readAsDataURL(file);
        }
    };
}
</script>