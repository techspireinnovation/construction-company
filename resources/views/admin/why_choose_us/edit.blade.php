@extends('layouts.backend.master')

@section('title')
    {{ env('APP_NAME') }} | Edit Why Choose Us
@endsection

@push('css')
    <style type="text/css">
        .box {
            border: 2px solid #ccc;
            padding: 12px;
            margin-bottom: 20px;
            
        }
        .image_div, .icon_div {
            margin-top: 10px;
        }
        .display_image, .display_icon {
            height: 70px;
            width: 100px;
            margin-right: 10px;
            object-fit: cover;
        }
        .content {
            margin-left: 100px;
        }
       
        .card {
            width: 100%;
            margin-top: -30px;
            margin-bottom: 100px;
            max-width: 1400px; /* Increased from 800px to 1000px for a wider form */
        }
    </style>
@endpush

@section('content')
    <div class="full-page">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Why Choose Us</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.why_choose_us.index') }}">View Why Choose Us</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
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
                            <form class="form" method="post" action="{{ route('admin.why_choose_us.update', $whyChooseUs->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row justify-content-center">
                                    <div class="col-12 col-lg-10 col-md-10"> <!-- Increased from col-lg-8 to col-lg-10 -->
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
                                                        value="{{ old('title', $whyChooseUs->title) }}" placeholder="Enter title" required>
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    @if ($whyChooseUs->image)
                                                        <div class="image_div">
                                                            <img src="{{ asset('storage/why_choose_us/' . $whyChooseUs->image) }}" class="display_image" alt="Current Image">
                                                        </div>
                                                    @endif
                                                    <input type="file" class="form-control-file" id="image"
                                                        name="image" accept="image/*">
                                                    @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @endif
                                                    <div class="image_div" id="preview_image"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="icon">Icon (Optional)</label>
                                                    @if ($whyChooseUs->icon)
                                                        <div class="icon_div">
                                                            <img src="{{ asset('storage/why_choose_us/icons/' . $whyChooseUs->icon) }}" class="display_icon" alt="Current Icon">
                                                        </div>
                                                    @endif
                                                    <input type="file" class="form-control-file" id="icon"
                                                        name="icon" accept="image/*">
                                                    @error('icon')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @endif
                                                    <div class="icon_div" id="preview_icon"></div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="add-new-option btn-sm btn btn-primary"
                                                        style="float: right;">Add New Content</button>
                                                </div>
                                                <input type="hidden" name="counter" value="{{ count($whyChooseUs->contents) }}">
                                                <div class="content-group">
                                                    @foreach ($whyChooseUs->contents as $index => $content)
                                                        <div class="box">
                                                            <div class="form-group">
                                                                <label for="content_title_{{ $index + 1 }}">Content Title<span class="required">*</span></label>
                                                                <input type="text" class="form-control" name="content_title[]"
                                                                    value="{{ old("content_title[$index]", $content->title) }}" placeholder="Enter content title" required>
                                                                @error("content_title.$index")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 col-lg-3 col-md-3">
                                                        <div class="form-group">
                                                            <label for="status">Status</label><br>
                                                            <label class="switch">
                                                                <input type="checkbox" name="status" {{ old('status', $whyChooseUs->status) ? 'checked' : '' }}>
                                                                <span class="slider round"></span>
                                                            </label>
                                                            @error('status')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <a href="{{ route('admin.why_choose_us.index') }}" class="btn btn-secondary">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
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
                    '<label for="content_title_' + new_value + '">Content Title<span class="required">*</span></label>' +
                    '<input type="text" class="form-control" name="content_title[]" placeholder="Enter content title" required>' +
                    '</div>' +
                    '</div>';
                $('.content-group').append(newOption);
            });

            // Image preview for single image
            $('#image').on('change', function(event) {
                var previewDiv = $('#preview_image');
                previewDiv.empty();

                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = $('<img>').attr({
                            'src': e.target.result,
                            'class': 'display_image'
                        });
                        previewDiv.append(img);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Icon preview
            $('#icon').on('change', function(event) {
                var previewDiv = $('#preview_icon');
                previewDiv.empty();

                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = $('<img>').attr({
                            'src': e.target.result,
                            'class': 'display_icon'
                        });
                        previewDiv.append(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush