/**
 * MultiImageUploader
 * Reusable component for multiple image upload with preview + remove
 *
 * Usage:
 * new MultiImageUploader({
 *   input: '#gallery-images-input',
 *   preview: '#gallery-preview-container'
 * });
 */

class MultiImageUploader {
    constructor(options) {
        this.input = document.querySelector(options.input);
        this.preview = document.querySelector(options.preview);

        if (!this.input || !this.preview) {
            console.warn('MultiImageUploader: Invalid selector(s)');
            return;
        }

        this.files = new DataTransfer();
        this.init();
    }

    init() {
        this.input.addEventListener('change', () => this.handleChange());
    }

    handleChange() {
        this.preview.innerHTML = '';
        this.files = new DataTransfer();

        if (!this.input.files.length) {
            this.preview.style.display = 'none';
            return;
        }

        this.preview.style.display = 'flex';

        Array.from(this.input.files).forEach((file) => {
            if (!file.type.startsWith('image/')) return;

            this.files.items.add(file);
            this.renderPreview(file);
        });

        this.input.files = this.files.files;
    }

    renderPreview(file) {
        const reader = new FileReader();

        reader.onload = (e) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'position-relative border rounded p-1';
            wrapper.style.width = '150px';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'rounded w-100';
            img.style.height = '120px';
            img.style.objectFit = 'cover';

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.innerHTML = '&times;';
            removeBtn.className =
                'btn btn-danger btn-sm position-absolute top-0 end-0';

            removeBtn.addEventListener('click', () => {
                this.removeFile(file, wrapper);
            });

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            this.preview.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
    }

    removeFile(file, wrapper) {
        const newFiles = new DataTransfer();

        Array.from(this.files.files).forEach(f => {
            if (f !== file) {
                newFiles.items.add(f);
            }
        });

        this.files = newFiles;
        this.input.files = this.files.files;
        wrapper.remove();

        if (!this.files.files.length) {
            this.preview.style.display = 'none';
        }
    }
}
