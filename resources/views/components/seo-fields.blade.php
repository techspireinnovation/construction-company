{{-- resources/views/components/seo-fields.blade.php --}}
@props([
    'seo' => null,
    'imageWidth' => 200,
    'imageHeight' => 150,
])

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title mb-0">SEO Details</h4>
    </div>
    <div class="card-body">
        <div class="row">

            <!-- SEO Title -->
            <div class="col-md-6 mb-3">
                <label class="form-label">SEO Title</label>
                <input type="text" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror"
                       value="{{ old('seo_title', $seo->seo_title ?? '') }}" placeholder="Enter SEO Title">
                @error('seo_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- SEO Description -->
            <div class="col-md-6 mb-3">
                <label class="form-label">SEO Description</label>
                <textarea name="seo_description" class="form-control @error('seo_description') is-invalid @enderror" rows="3"
                          placeholder="Enter SEO Description">{{ old('seo_description', $seo->seo_description ?? '') }}</textarea>
                @error('seo_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- SEO Keywords with Tags Input -->
            <div class="col-md-6 mb-3">
                <label class="form-label">SEO Keywords</label>
                <div id="keywords-container" class="keywords-input-container">
                    <div class="tags-container" id="tags-container"
                         style="display: flex; flex-wrap: wrap; gap: 8px; padding: 8px; border: 1px solid #dee2e6; border-radius: 4px; min-height: 45px; align-items: center; background-color: #f8f9fa;">
                        <!-- Existing tags will be added here by JavaScript -->
                    </div>
                    <input type="text"
                           id="keywords-input"
                           class="form-control mt-2 @error('seo_keywords') is-invalid @enderror"
                           placeholder="Type keyword and press Enter or comma"
                           autocomplete="off">
                    <input type="hidden"
                           name="seo_keywords"
                           id="keywords-hidden"
                           value="{{ old('seo_keywords', isset($seo->seo_keywords) ? (is_array($seo->seo_keywords) ? implode(',', $seo->seo_keywords) : $seo->seo_keywords) : '') }}">
                    @error('seo_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- SEO Image using the same reusable component -->
            <div class="col-md-6 mb-3">
                <x-image-upload
                    name="seo_image"
                    label="SEO Image"
                    value="{{ old('seo_image', $seo->seo_image ?? null) }}"
                    inputId="seo-image-input"
                    previewId="seo-image-preview"
                    containerId="seo-image-preview-container"
                    removeBtnId="remove-seo-image"
                    maxWidth="{{ $imageWidth }}"
                    maxHeight="{{ $imageHeight }}"
                    :required="false"
                    :error="$errors->first('seo_image')"
                    helpText="Upload SEO image for social sharing. Recommended size: 1200x630px. Max size: 5MB."
                />
            </div>

        </div>
    </div>
</div>

<style>
.keywords-input-container {
    position: relative;
}

.tags-container {
    min-height: 45px;
    transition: min-height 0.3s ease;
}

.keyword-tag {
    display: inline-flex;
    align-items: center;
    background-color: #25A0E2;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    gap: 8px;
    white-space: nowrap;
    margin: 2px;
    transition: all 0.2s ease;
    border: 1px solid #1e8bc9;
    box-shadow: 0 2px 4px rgba(37, 160, 226, 0.1);
}

.keyword-tag:hover {
    background-color: #1e8bc9;
    box-shadow: 0 3px 6px rgba(37, 160, 226, 0.15);
    transform: translateY(-1px);
}

.tag-close {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 18px;
    line-height: 1;
    padding: 0 0 0 8px;
    margin: 0;
    opacity: 0.9;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    border-radius: 2px;
    transition: all 0.2s;
}

.tag-close:hover {
    opacity: 1;
    background-color: rgba(255, 255, 255, 0.2);
}

#keywords-input {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-top: 1px solid #dee2e6;
    border-color: #dee2e6;
}

#keywords-input:focus {
    border-color: #25A0E2;
    box-shadow: 0 0 0 0.25rem rgba(37, 160, 226, 0.25);
    position: relative;
    z-index: 1;
}

.tags-container:focus-within {
    border-color: #25A0E2;
    box-shadow: 0 0 0 0.25rem rgba(37, 160, 226, 0.25);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tags Input Functionality
    class TagsInput {
        constructor(containerId, inputId, hiddenInputId) {
            this.container = document.getElementById(containerId);
            this.input = document.getElementById(inputId);
            this.hiddenInput = document.getElementById(hiddenInputId);
            this.tags = [];

            this.init();
        }

        init() {
            this.loadExistingTags();
            this.bindEvents();
            this.setupInputStyling();
        }

        setupInputStyling() {
            // Add focus styling to the container when input is focused
            this.input.addEventListener('focus', () => {
                this.container.style.borderColor = '#25A0E2';
                this.container.style.boxShadow = '0 0 0 0.25rem rgba(37, 160, 226, 0.25)';
            });

            this.input.addEventListener('blur', () => {
                this.container.style.borderColor = '#dee2e6';
                this.container.style.boxShadow = 'none';
            });
        }

        loadExistingTags() {
            const tagsValue = this.hiddenInput.value;
            if (tagsValue) {
                const tagsArray = tagsValue.split(',').map(tag => tag.trim()).filter(tag => tag);
                tagsArray.forEach(tag => this.addTag(tag, false));
            }
            this.adjustContainerHeight();
        }

        bindEvents() {
            // Handle input events
            this.input.addEventListener('keydown', (e) => this.handleKeyDown(e));
            this.input.addEventListener('blur', () => this.handleBlur());

            // Prevent form submission on Enter in tags input
            this.input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && e.target === this.input) {
                    e.preventDefault();
                }
            });
        }

        handleKeyDown(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                this.addTagFromInput();
            } else if (e.key === 'Backspace' && this.input.value === '' && this.tags.length > 0) {
                this.removeLastTag();
            }
        }

        handleBlur() {
            this.addTagFromInput();
        }

        addTagFromInput() {
            const keyword = this.input.value.trim();
            if (keyword) {
                this.addTag(keyword);
                this.input.value = '';
            }
        }

        addTag(keyword, updateHeight = true) {
            if (!keyword.trim()) return;

            // Check if tag already exists (case-insensitive)
            const normalizedKeyword = keyword.toLowerCase().trim();
            if (this.tags.some(tag => tag.toLowerCase() === normalizedKeyword)) {
                this.input.value = '';
                return;
            }

            // Create tag element
            const tagElement = document.createElement('span');
            tagElement.className = 'keyword-tag';
            tagElement.innerHTML = `
                <span class="tag-text">${keyword.trim()}</span>
                <button type="button" class="tag-close" title="Remove keyword">×</button>
            `;

            // Add to container
            this.container.appendChild(tagElement);

            // Add to tags array
            this.tags.push(keyword.trim());

            // Add event listener to remove button
            tagElement.querySelector('.tag-close').addEventListener('click', () => {
                this.removeTag(keyword.trim());
                tagElement.remove();
            });

            // Update hidden input
            this.updateHiddenInput();

            // Adjust container height if needed
            if (updateHeight) {
                this.adjustContainerHeight();
            }

            this.input.value = '';
        }

        removeTag(keyword) {
            const index = this.tags.indexOf(keyword);
            if (index > -1) {
                this.tags.splice(index, 1);
                this.updateHiddenInput();
                this.adjustContainerHeight();
            }
        }

        removeLastTag() {
            if (this.tags.length > 0) {
                const lastTag = this.tags[this.tags.length - 1];
                this.removeTag(lastTag);

                // Remove the visual tag
                const lastTagElement = this.container.querySelector('.keyword-tag:last-child');
                if (lastTagElement) {
                    lastTagElement.remove();
                }
            }
        }

        updateHiddenInput() {
            this.hiddenInput.value = this.tags.join(',');
        }

        adjustContainerHeight() {
            const tagsCount = this.tags.length;
            if (tagsCount === 0) {
                this.container.style.minHeight = '45px';
                return;
            }

            // Calculate approximate rows based on tag width
            const containerWidth = this.container.clientWidth;
            let currentRowWidth = 0;
            let rows = 1;

            // Simulate tag widths (approximate calculation)
            const tagElements = this.container.querySelectorAll('.keyword-tag');
            tagElements.forEach(tag => {
                const tagWidth = tag.offsetWidth + 8; // + gap
                if (currentRowWidth + tagWidth > containerWidth) {
                    rows++;
                    currentRowWidth = tagWidth;
                } else {
                    currentRowWidth += tagWidth;
                }
            });

            const baseHeight = 45;
            const rowHeight = 40; // Height per row (including padding)
            const minHeight = baseHeight + (rows * rowHeight);
            this.container.style.minHeight = `${minHeight}px`;
        }

        getTags() {
            return [...this.tags];
        }

        clear() {
            this.tags = [];
            this.container.innerHTML = '';
            this.updateHiddenInput();
            this.adjustContainerHeight();
        }
    }

    // Initialize Tags Input if elements exist
    if (document.getElementById('tags-container') &&
        document.getElementById('keywords-input') &&
        document.getElementById('keywords-hidden')) {
        const seoTagsInput = new TagsInput('tags-container', 'keywords-input', 'keywords-hidden');
    }
});
</script>