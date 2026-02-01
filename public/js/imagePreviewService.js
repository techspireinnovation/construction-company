// imagePreviewService.js
class ImagePreviewService {
    constructor(options = {}) {
        this.defaults = {
            previewId: 'image-preview',
            previewContainerId: 'image-preview-container',
            removeBtnId: 'remove-image',
            imageInputId: 'image-input',
            maxWidth: 200,
            maxHeight: 150,
            existingImageInputName: 'existing_image'
        };

        this.config = { ...this.defaults, ...options };
        this.init();
    }

    init() {
        this.imageInput = document.getElementById(this.config.imageInputId);
        this.imagePreview = document.getElementById(this.config.previewId);
        this.imagePreviewContainer = document.getElementById(this.config.previewContainerId);
        this.removeImageBtn = document.getElementById(this.config.removeBtnId);

        if (this.imageInput && this.imagePreview) {
            this.bindEvents();
            this.checkExistingImage();
        } else {
            console.warn('Image Preview Service: Required elements not found');
        }
    }

    bindEvents() {
        // Handle image selection
        this.imageInput.addEventListener('change', (e) => this.handleImageSelect(e));

        // Handle image removal
        if (this.removeImageBtn) {
            this.removeImageBtn.addEventListener('click', () => this.removeImage());
        }
    }

    handleImageSelect(e) {
        const file = e.target.files[0];
        if (file) {
            if (!this.validateImage(file)) {
                this.imageInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                this.imagePreview.src = e.target.result;
                this.showPreview();
                this.onImageSelected(file);
            };
            reader.readAsDataURL(file);
        }
    }

    validateImage(file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        const maxSize = 5 * 1024 * 1024; // 5MB

        if (!allowedTypes.includes(file.type)) {
            alert('Please select a valid image file (JPEG, PNG, GIF, WebP, SVG).');
            return false;
        }

        if (file.size > maxSize) {
            alert('Image size should be less than 5MB.');
            return false;
        }

        return true;
    }

    showPreview() {
        if (this.imagePreviewContainer) {
            this.imagePreviewContainer.style.display = 'block';
        }
    }

    hidePreview() {
        if (this.imagePreviewContainer) {
            this.imagePreviewContainer.style.display = 'none';
        }
    }

    removeImage() {
        this.imageInput.value = '';
        this.imagePreview.src = '#';
        this.hidePreview();

        // Clear any existing hidden image value
        const existingImageInput = document.querySelector(`input[name="${this.config.existingImageInputName}"]`);
        if (existingImageInput) {
            existingImageInput.remove();
        }

        this.onImageRemoved();
    }

    checkExistingImage() {
        if (this.imagePreview && this.imagePreview.src && this.imagePreview.src !== '#') {
            this.showPreview();
        } else {
            this.hidePreview();
        }
    }

    // Callback methods (can be overridden)
    onImageSelected(file) {
        console.log('Image selected:', file.name);
    }

    onImageRemoved() {
        console.log('Image removed');
    }

    // Public methods
    setPreviewSize(width, height) {
        this.config.maxWidth = width;
        this.config.maxHeight = height;
        if (this.imagePreview) {
            this.imagePreview.style.maxWidth = `${width}px`;
            this.imagePreview.style.maxHeight = `${height}px`;
        }
    }

    getCurrentImage() {
        return this.imageInput.files[0] || null;
    }

    isImageSelected() {
        return this.imageInput.files.length > 0;
    }
}

// Export for use in different environments
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ImagePreviewService;
} else {
    window.ImagePreviewService = ImagePreviewService;
}