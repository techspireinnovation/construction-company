@extends('layouts.backend.master')

@section('title')
    {{ env('APP_NAME') }} | Create Page
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
                        <h1>Create Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">View Pages</a></li>
                            <li class="breadcrumb-item active">Create Page</li>
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
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="font-size: smaller;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form" method="post" action="{{ route('admin.pages.store') }}"
                            enctype="multipart/form-data">
                            @csrf
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
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ old('title') }}" placeholder="Enter title" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="slug">Slug<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="slug"
                                                    value="{{ old('slug') }}" placeholder="Enter slug" required>
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
                                                            {{ old('page_type_id') == $pageType->id ? 'selected' : '' }}>
                                                            {{ $pageType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('page_type_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="button" class="add-new-option btn-sm btn btn-primary"
                                                    style="float: right;">Add New Page Section</button>
                                            </div>
                                            <input type="hidden" name="counter" value="1">
                                            <div class="content-group">
                                                <div class="box">
                                                    <div class="form-group">
                                                        <label for="">Section Title</label>
                                                        <input type="text" class="form-control" name="section_title[]"
                                                            placeholder="Enter title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Sub Title</label>
                                                        <input type="text" class="form-control" name="section_subtitle[]"
                                                            placeholder="Enter sub title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="content">Content<span class="required">*</span></label>
                                                        <textarea class="summernote" name="content[]" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Text</label>
                                                        <input type="text" class="form-control" name="text[]"
                                                            placeholder="Enter text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Link</label>
                                                        <input type="text" class="form-control" name="link[]"
                                                            placeholder="Enter link">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 col-lg-8 col-md-8">
                                                            <div class="form-group">
                                                                <label for="image">Image</label>
                                                                <input type="file" class="form-control" id="1"
                                                                    name="image[]" accept="image/*"
                                                                    onchange="loadFile(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 col-lg-4 col-md-4">
                                                            <div class="image_div">
                                                                <img id="preview_1" class="display_image" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                          

                                            <div class="row">
                                                <div class="col-6 col-lg-3 col-md-3">
                                                    <div class="form-group">
                                                        <label for="status">Status</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="status" {{ old('status', 1) ? 'checked' : '' }}>
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
                                                    value="{{ old('seo_title') }}" placeholder="Enter SEO title">
                                            </div>

                                            <div class="form-group">
                                                <label for="seo_keyword">SEO Keyword</label>
                                                <input type="text" class="form-control" name="seo_keyword" id="bootstrap-tagsinput"
                                                    placeholder="Enter SEO Tags" data-role="tagsinput" value="{{ old('seo_keyword') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="seo_description">SEO Description</label>
                                                <textarea name="seo_description" class="form-control">{{ old('seo_description') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="seo_image">SEO Image</label>
                                                <input type="file" class="dropify" name="seo_image" accept="image/*" id="file"/>
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
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
        $(document).ready(function() {
            $('.add-new-option').click(function() {
                var old_value = parseInt($('input[name="counter"]').val());
                var new_value = ++old_value;

                $('input[name="counter"]').val(new_value);
                var newOption =
                    '<div class="box">' +
                    '<div class="form-group">' +
                    '<label for="">Section Title</label>' +
                    '<input type="text" class="form-control" name="section_title[]" placeholder="Enter title">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="">Sub Title</label>' +
                    '<input type="text" class="form-control" name="section_subtitle[]" placeholder="Enter sub title">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="content">Content<span class="required">*</span></label>' +
                    '<textarea class="summernote" name="content[]" required></textarea>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="">Text</label>' +
                    '<input type="text" class="form-control" name="text[]" placeholder="Enter text">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="">Link</label>' +
                    '<input type="text" class="form-control" name="link[]" placeholder="Enter link">' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-8 col-lg-8 col-md-8">' +
                    '<div class="form-group">' +
                    '<label for="image">Image</label>' +
                    '<input type="file" class="form-control" id="' + new_value + '" name="image[]" accept="image/*" onchange="loadFile(event)">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-4 col-lg-4 col-md-4">' +
                    '<div class="image_div">' +
                    '<img id="preview_' + new_value + '" class="display_image" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.content-group').append(newOption);
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
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            var inputId = event.target.id;
            reader.onload = function() {
                var output = document.getElementById('preview_' + inputId);
                output.src = reader.result;
                $(output).css({
                    'height': '70px',
                    'width': '100px'
                });
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        $('input[name="title"]').keyup(function() {
            var title = $(this).val();
            $('input[name="seo_title"]').val(title);
            $('input[name="seo_keyword"]').val(title);
        });
    </script>
@endpush