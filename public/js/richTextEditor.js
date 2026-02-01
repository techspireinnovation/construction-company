// richTextEditor.js
class RichTextEditor {
    constructor(options = {}) {
        this.defaults = {
            containerSelector: '.snow-editor',
            hiddenInputId: 'long-description-hidden',
            theme: 'snow',
            placeholder: 'Write something...',
            height: 300,
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
        };

        this.config = { ...this.defaults, ...options };
        this.editor = null;
        this.hiddenInput = null;
        this.init();
    }

    init() {
        const container = document.querySelector(this.config.containerSelector);
        if (!container) {
            console.warn('RichTextEditor: Container not found');
            return;
        }

        // Set container height
        container.style.height = `${this.config.height}px`;

        // Initialize Quill editor
        this.editor = new Quill(container, {
            theme: this.config.theme,
            placeholder: this.config.placeholder,
            modules: this.config.modules
        });

        // Set up hidden input
        this.hiddenInput = document.getElementById(this.config.hiddenInputId);
        if (this.hiddenInput) {
            // Set initial content if exists
            if (this.hiddenInput.value) {
                this.editor.root.innerHTML = this.hiddenInput.value;
            }

            // Update hidden input on content change
            this.editor.on('text-change', () => {
                this.updateHiddenInput();
            });
        }

        this.setupImageHandler();
    }

    updateHiddenInput() {
        if (this.hiddenInput) {
            this.hiddenInput.value = this.editor.root.innerHTML;
        }
    }

    setupImageHandler() {
        const toolbar = this.editor.getModule('toolbar');
        toolbar.addHandler('image', () => {
            this.selectLocalImage();
        });
    }

    selectLocalImage() {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = () => {
            const file = input.files[0];
            if (file) {
                // Validate image
                if (!this.validateImage(file)) {
                    return;
                }

                // Create a file reader
                const reader = new FileReader();

                reader.onload = (e) => {
                    const range = this.editor.getSelection();
                    this.editor.insertEmbed(range.index, 'image', e.target.result);
                };

                reader.readAsDataURL(file);
            }
        };
    }

    validateImage(file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        const maxSize = 5 * 1024 * 1024; // 5MB

        if (!allowedTypes.includes(file.type)) {
            alert('Please select a valid image file (JPEG, PNG, GIF, WebP).');
            return false;
        }

        if (file.size > maxSize) {
            alert('Image size should be less than 5MB.');
            return false;
        }

        return true;
    }

    // Public methods
    getContent() {
        return this.editor.root.innerHTML;
    }

    setContent(html) {
        this.editor.root.innerHTML = html;
        this.updateHiddenInput();
    }

    clear() {
        this.editor.root.innerHTML = '';
        this.updateHiddenInput();
    }

    enable() {
        this.editor.enable();
    }

    disable() {
        this.editor.disable();
    }

    focus() {
        this.editor.focus();
    }

    // Form integration helper
    static bindToForm(formId, editorInstance) {
        const form = document.getElementById(formId);
        if (form && editorInstance) {
            form.addEventListener('submit', (e) => {
                editorInstance.updateHiddenInput();
            });
        }
    }
}

// Export for use in different environments
if (typeof module !== 'undefined' && module.exports) {
    module.exports = RichTextEditor;
} else {
    window.RichTextEditor = RichTextEditor;
}