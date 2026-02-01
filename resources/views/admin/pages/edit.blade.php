@extends('layouts.backend.master')

@section('title')
    {{ env('APP_NAME') }} | Edit Page
@endsection

@push('css')
    <style type="text/css">
        .box {
            border: 2px solid #ccc;
            padding: 12px;
            margin-bottom: 20px;
            margin-top: 50px;
        }
    </style>
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">View Pages</a></li>
                            <li class="breadcrumb-item active">Edit Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="font-size: smaller;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form" method="post" action="{{ route('admin.pages.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $page->id }}">
                            <div class="row">
                                <div class="col-12 col-lg-8 col-md-8">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">General</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title">Title<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title" required
                                                    value="{{ old('title', $page->title) }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="slug">Slug<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="slug" required
                                                    value="{{ old('slug', $page->slug) }}">
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="page_type_id">Page Type<span class="required">*</span></label>
                                                <select name="page_type_id" class="form-control" required>
                                                    <option value="">Select Page Type</option>
                                                    @foreach ($pageTypes as $pageType)
                                                        <option value="{{ $pageType->id }}"
                                                            {{ old('page_type_id', $page->page_type_id) == $pageType->id ? 'selected' : '' }}>
                                                            {{ $pageType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('page_type_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                @foreach ($page->contents as $page_content)
                                                    <input type="hidden" name="content_id[]" value="{{ $page_content->id }}">
                                                    <div class="box">
                                                        <div class="form-group">
                                                            <label for="section_title">Section Title</label>
                                                            <input type="text" class="form-control" name="section_title[]"
                                                                placeholder="Enter title" value="{{ old('section_title.' . $loop->index, $page_content->title) }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="section_subtitle">Sub Title</label>
                                                            <input type="text" class="form-control" name="section_subtitle[]"
                                                                placeholder="Enter subtitle" value="{{ old('section_subtitle.' . $loop->index, $page_content->subtitle) }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="content">Content</label>
                                                            <textarea class="summernote" name="content[]">{{ old('content.' . $loop->index, $page_content->content) }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="text">Text</label>
                                                            <input type="text" class="form-control" name="text[]"
                                                                placeholder="Enter text" value="{{ old('text.' . $loop->index, $page_content->text) }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link">Link</label>
                                                            <input type="text" class="form-control" name="link[]"
                                                                placeholder="Enter link" value="{{ old('link.' . $loop->index, $page_content->link) }}">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-8 col-lg-8 col-md-8">
                                                                <div class="form-group">
                                                                    <label for="image">Image</label>
                                                                    <input type="file" class="form-control"
                                                                        id="{{ $page_content->id }}" name="image[]" accept="image/*"
                                                                        onchange="loadFile(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-4">
                                                                @if ($page_content->image)
                                                                    <img src="{{ asset('storage/page/' . $page_content->image) }}"
                                                                        class="previous_image_{{ $page_content->id }} display_image"
                                                                        alt="Page Content Image" height="80" width="100">
                                                                @endif
                                                                <div class="image_div_{{ $page_content->id }}" style="display:none;">
                                                                    <img id="image_preview_{{ $page_content->id }}" class="display_image"
                                                                        height="80" width="100" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        

                                            <div class="row">
                                                <div class="col-6 col-lg-3 col-md-3">
                                                    <div class="form-group">
                                                        <label for="status">Status</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="status"
                                                                {{ old('status', $page->status) ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">SEO</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="seo_title">SEO Title</label>
                                                <input type="text" class="form-control" name="seo_title"
                                                    value="{{ old('seo_title', $page->seo_title) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="seo_keyword">SEO Keyword</label>
                                                <input type="text" class="form-control" name="seo_keyword" id="bootstrap-tagsinput"
                                                    placeholder="Enter SEO Tags" data-role="tagsinput"
                                                    value="{{ old('seo_keyword', $page->seo_keyword) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="seo_description">SEO Description</label>
                                                <textarea name="seo_description" class="form-control">{{ old('seo_description', $page->seo_description) }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="seo_image">SEO Image</label>
                                                <input type="file" data-default-file="{{ $page->seo_image ? asset('storage/page/seo_' . $page->seo_image) : '' }}"
                                                    class="dropify" name="seo_image" accept="image/*" id="file" />
                                                <div style="font-size: 16px; color: gray;">
                                                    <small><strong>Recommended Image</strong></small><br>
                                                    <small>Accept: <strong>jpg,jpeg,png</strong></small><br>
                                                    <small>Resolution: <strong>1200px X 630px</strong></small><br>
                                                    <small>File Size: <strong>Smaller than or Equal to 9MB (≤ 9MB)</strong></small>
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                                </div>
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('js')
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            var inputId = event.target.id;
            reader.onload = function() {
                var output = document.getElementById('image_preview_' + inputId);
                $('.image_div_' + inputId).css('display', 'block');
                output.src = reader.result;
                $('.previous_image_' + inputId).css('display', 'none');
            };
            $('.previous_image_' + inputId).css('display', 'block');
            $('.image_div_' + inputId).css('display', 'none');
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script>
        $(document).ready(function() {
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
                ],
                callbacks: {
                    onInit: function() {
                        $('.summernote').parent().find('textarea').removeAttr('required');
                    }
                }
            });
        });
    </script>
@endpush