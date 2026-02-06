class ImageUploadService {
    constructor() {
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        // Image preview when file is selected
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('image-input')) {
                this.handleImagePreview(e.target);
            }
        });

        // Remove preview buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.remove-preview')) {
                this.removeImagePreview(e.target.closest('.remove-preview'));
            }
        });

        // Handle remove image checkboxes
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('remove-image-checkbox')) {
                this.handleRemoveImageCheckbox(e.target);
            }
        });

        // Initialize existing image data attributes
        this.initializeExistingImages();
    }

    handleImagePreview(input) {
        const file = input.files[0];
        if (!file) return;

        const previewId = input.getAttribute('data-preview-id');
        const containerId = input.getAttribute('data-container-id');

        if (!previewId || !containerId) return;

        const preview = document.getElementById(previewId);
        const container = document.getElementById(containerId);

        if (!preview || !container) return;

        const reader = new FileReader();

        reader.onload = (e) => {
            preview.src = e.target.result;
            container.style.display = 'block';

            // Hide existing image section when new image is selected
            const existingImageSection = input.closest('.image-upload-edit').querySelector('.existing-image-section');
            if (existingImageSection) {
                existingImageSection.style.opacity = '0.5';

                // Uncheck remove checkbox if it's checked
                const removeCheckbox = existingImageSection.querySelector('.remove-image-checkbox');
                if (removeCheckbox && removeCheckbox.checked) {
                    removeCheckbox.checked = false;
                    this.handleRemoveImageCheckbox(removeCheckbox, false);
                }
            }
        }

        reader.readAsDataURL(file);
    }

    removeImagePreview(removeBtn) {
        const inputId = removeBtn.getAttribute('data-input-id');
        const previewId = removeBtn.getAttribute('data-preview-id');
        const containerId = removeBtn.getAttribute('data-container-id');

        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const container = document.getElementById(containerId);

        if (input) input.value = '';
        if (preview) preview.src = '';
        if (container) container.style.display = 'none';

        // Restore existing image section opacity
        const existingImageSection = removeBtn.closest('.image-upload-edit').querySelector('.existing-image-section');
        if (existingImageSection) {
            existingImageSection.style.opacity = '1';
        }
    }

    handleRemoveImageCheckbox(checkbox, triggerChange = true) {
        const existingImageInput = checkbox.closest('.image-upload-edit').querySelector('.existing-image-input');

        if (!existingImageInput) return;

        if (checkbox.checked) {
            // If remove is checked, clear the existing image value
            existingImageInput.value = '';

            // Clear any image preview
            const imageInput = checkbox.closest('.image-upload-edit').querySelector('.image-input');
            if (imageInput) {
                imageInput.value = '';
                const containerId = imageInput.getAttribute('data-container-id');
                const container = document.getElementById(containerId);
                if (container) {
                    container.style.display = 'none';
                }
            }
        } else {
            // If remove is unchecked, restore the original value
            const originalValue = existingImageInput.getAttribute('data-original');
            if (originalValue) {
                existingImageInput.value = originalValue;
            }
        }

        // Trigger change event if needed
        if (triggerChange) {
            existingImageInput.dispatchEvent(new Event('change'));
        }
    }

    initializeExistingImages() {
        document.querySelectorAll('.existing-image-input').forEach(input => {
            if (!input.hasAttribute('data-original')) {
                input.setAttribute('data-original', input.value);
            }
        });
    }

    // Helper method to setup for specific forms
    setupForm(formId) {
        const form = document.getElementById(formId);
        if (!form) return;

        // Reset all previews when form is reset
        form.addEventListener('reset', () => {
            setTimeout(() => {
                this.initializeExistingImages();
                document.querySelectorAll('.image-preview-container').forEach(container => {
                    container.style.display = 'none';
                });
                document.querySelectorAll('.remove-image-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });
                document.querySelectorAll('.existing-image-section').forEach(section => {
                    section.style.opacity = '1';
                });
            }, 100);
        });
    }
}

// Initialize the service when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.imageUploadService = new ImageUploadService();
});