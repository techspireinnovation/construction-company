@props([
    'name',
    'label' => '',
    'value' => [],
    'placeholder' => 'Type sentence and press Enter',
    'error' => null
])

@php
    $cleanValue = [];

    if (is_string($value)) {
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $cleanValue = $decoded;
        } else {
            $cleanValue = [$value];
        }
    } elseif (is_array($value)) {
        $cleanValue = $value;
    }

    $cleanValue = array_map('trim', $cleanValue);
    $cleanValue = array_filter($cleanValue);
    $cleanValue = array_values(array_unique($cleanValue));

    $hiddenValue = json_encode($cleanValue);
@endphp

<div class="mb-3">
    @if($label)
        <label class="form-label">{{ $label }}</label>
    @endif

    <div id="{{ $name }}-container"
         class="long-sentence-tags-container"
         style="display:flex;flex-wrap:wrap;gap:8px;padding:8px;border:1px solid #dee2e6;border-radius:4px;min-height:50px;background:#f8f9fa;">
    </div>

    <input type="text"
           id="{{ $name }}-input"
           class="form-control mt-2 @error($name) is-invalid @enderror"
           placeholder="{{ $placeholder }}"
           autocomplete="off">

    <input type="hidden"
           name="{{ $name }}"
           id="{{ $name }}-hidden"
           value="{{ $hiddenValue }}">

    @if($error)
        <div class="invalid-feedback d-block">{{ $error }}</div>
    @endif
</div>

<style>
.keyword-sentence-tag {
    display:inline-flex;
    align-items:center;
    background:#fcfeff;
    border:1px solid #b6b8b9;
    padding:6px 12px;
    border-radius:4px;
    gap:8px;
}
.keyword-sentence-tag .tag-close {
    cursor: pointer;
    font-weight: bold;
    background: none;
    border: none;
    color: #000;
    font-size: 16px;
    line-height: 1;
    padding: 0 4px;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    class LongSentenceTags {
        constructor(containerId, inputId, hiddenInputId) {
            this.container = document.getElementById(containerId);
            this.input = document.getElementById(inputId);
            this.hiddenInput = document.getElementById(hiddenInputId);
            this.tags = [];

            this.loadExistingTags();
            this.bindEvents();
        }

        loadExistingTags() {
            let value = this.hiddenInput.value;
            if (!value || value === '[]') return;

            let tagsArray = [];

            try {
                tagsArray = JSON.parse(value);
                if (typeof tagsArray === 'string') {
                    tagsArray = JSON.parse(tagsArray);
                }
            } catch {
                tagsArray = [];
            }

            if (!Array.isArray(tagsArray)) {
                tagsArray = [tagsArray];
            }

            this.tags = [];
            this.container.innerHTML = '';

            const seen = new Set();

            tagsArray.forEach(tag => {
                tag = String(tag).trim();
                if (!tag) return;

                const key = tag.toLowerCase();
                if (seen.has(key)) return;
                seen.add(key);

                this.tags.push(tag);

                const tagEl = document.createElement('span');
                tagEl.className = 'keyword-sentence-tag';
                tagEl.innerHTML = `
                    <span>${this.escapeHtml(tag)}</span>
                    <button type="button" class="tag-close">&times;</button>
                `;

                tagEl.querySelector('.tag-close').addEventListener('click', () => {
                    this.removeTag(tag);
                    tagEl.remove();
                });

                this.container.appendChild(tagEl);
            });

            this.updateHiddenInput();
        }

        bindEvents() {
            this.input.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.addTagFromInput();
                }
            });

            this.input.addEventListener('blur', () => this.addTagFromInput());
        }

        addTagFromInput() {
            const text = this.input.value.trim();
            if (!text) return;
            this.addTag(text);
            this.input.value = '';
        }

        addTag(text) {
            const key = text.toLowerCase();
            if (this.tags.some(t => t.toLowerCase() === key)) return;

            this.tags.push(text);

            const tagEl = document.createElement('span');
            tagEl.className = 'keyword-sentence-tag';
            tagEl.innerHTML = `
                <span>${this.escapeHtml(text)}</span>
                <button type="button" class="tag-close">&times;</button>
            `;

            tagEl.querySelector('.tag-close').addEventListener('click', () => {
                this.removeTag(text);
                tagEl.remove();
            });

            this.container.appendChild(tagEl);
            this.updateHiddenInput();
        }

        removeTag(text) {
            this.tags = this.tags.filter(t => t.toLowerCase() !== text.toLowerCase());
            this.updateHiddenInput();
        }

        updateHiddenInput() {
            this.hiddenInput.value = JSON.stringify(this.tags);
        }

        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    }

    document.querySelectorAll('.long-sentence-tags-container').forEach(container => {
        const base = container.id.replace('-container', '');
        new LongSentenceTags(
            `${base}-container`,
            `${base}-input`,
            `${base}-hidden`
        );
    });
});
</script>
