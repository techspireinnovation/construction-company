@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Slider</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Sliders</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Slider</h4>
                        </div>
                        <div class="card-body">
                            <form id="editForm" method="POST" action="{{ route('admin.sliders.update', $slider->id) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title-field" class="form-label">Title</label>
                                            <input type="text" id="title-field" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title" value="{{ old('title', $slider->title) }}">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sub-title-field" class="form-label">Sub Title</label>
                                            <input type="text" id="sub-title-field" name="sub_title" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter Sub Title" value="{{ old('sub_title', $slider->sub_title) }}">
                                            @error('sub_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="content-field" class="form-label">Content</label>
                                            <textarea id="content-field" name="content" class="form-control summernote @error('content') is-invalid @enderror" placeholder="Enter Content">{{ old('content', $slider->content) }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="button-name-field" class="form-label">Button Name</label>
                                            <input type="text" id="button-name-field" name="button_name" class="form-control @error('button_name') is-invalid @enderror" placeholder="Enter Button Name" value="{{ old('button_name', $slider->button_name) }}">
                                            @error('button_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="button-link-field" class="form-label">Button Link</label>
                                            <input type="url" id="button-link-field" name="button_link" class="form-control @error('button_link') is-invalid @enderror" placeholder="Enter Button Link" value="{{ old('button_link', $slider->button_link) }}">
                                            @error('button_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feature-image-field" class="form-label">Feature Images</label>
                                            <input type="file" id="feature-image-field" name="feature_images[]" class="form-control @error('feature_images') is-invalid @enderror" accept="image/*" multiple>
                                            <div id="feature-image-previews" style="margin-top: 10px;">
                                                @if ($slider->feature_image)
                                                    @foreach (json_decode($slider->feature_image, true) as $image)
                                                        <div class="image-preview-container" style="display: inline-block; position: relative; margin: 5px;">
                                                            <img src="{{ asset('storage/sliders/' . $image) }}" class="image-preview" alt="Feature Image">
                                                            <button type="button" class="btn btn-danger btn-sm remove-image" style="position: absolute; top: 0; right: 0;" data-image="{{ $image }}">X</button>
                                                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            @error('feature_images')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Slider</button>
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

@section('style')
<style>
    .invalid-feedback:empty { display: none; }
    .image-preview { max-width: 100px; max-height: 100px; margin: 5px; }
    .remove-image { padding: 2px 6px; }
</style>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview for new feature images
        document.querySelector('#feature-image-field').addEventListener('change', function (event) {
            const files = event.target.files;
            const previewsContainer = document.querySelector('#feature-image-previews');

            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const container = document.createElement('div');
                        container.style.display = 'inline-block';
                        container.style.position = 'relative';
                        container.style.margin = '5px';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('image-preview');
                        container.appendChild(img);

                        previewsContainer.appendChild(container);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });

        // Remove existing image
        document.querySelectorAll('.remove-image').forEach(button => {
            button.addEventListener('click', function () {
                const container = this.parentElement;
                const imageName = this.getAttribute('data-image');
                container.remove();

                // Add hidden input to track removed images
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'removed_images[]';
                input.value = imageName;
                document.querySelector('#editForm').appendChild(input);
            });
        });

        // Initialize Summernote for content
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endsection