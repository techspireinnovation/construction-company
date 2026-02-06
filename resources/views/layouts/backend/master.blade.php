<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8">
    <title>Projects | Admin - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('Backend/assets/images/favicon.ico') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('Backend/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('Backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('Backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('Backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <!-- custom Css-->
    <link href="{{ asset('Backend/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
      <!-- quill css -->
    <link href="{{ asset('Backend/assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('Backend/assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('Backend/assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css">









    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
{{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css"
        integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

        .tag {
            background: var(--primary);
            padding: 2px;
            border-radius: 2px;
        }

        .bootstrap-tagsinput {
            width: 100% !important;
        }

    </style>

@stack('css')

    @yield('style')

</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.backend.header')
        @include('layouts.backend.navigation')
        @yield('content')
        @include('layouts.backend.footer')
    </div>
    @yield('script')
    @stack('scripts')

    <!-- JAVASCRIPT -->
    <script src="{{ asset('Backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/plugins.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('Backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- projects js -->
    <script src="{{ asset('Backend/assets/js/pages/dashboard-projects.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('Backend/assets/js/app.js') }}"></script>

    <script src="{{ asset('Backend/assets/libs/sortablejs/Sortable.min.js') }}"></script>

    <!-- Nestable init js (if exists) -->
    <script src="{{ asset('Backend/assets/js/pages/nestable.init.js') }}"></script>



    <!-- profile-setting init js -->
    <script src="{{ asset('Backend/assets/js/pages/profile-setting.init.js') }}"></script>


    <!-- dropzone js -->
    <script src="{{ asset('Backend/assets/libs/dropzone/dropzone-min.js') }}"></script>
    <!-- project-create init -->
    <script src="{{ asset('Backend/assets/js/pages/project-create.init.js') }}"></script>


    <!-- quill js -->
    <script src="{{ asset('Backend/assets/libs/quill/quill.min.js') }}"></script>

    <!-- init js -->




    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();

            $('.dropify').each(function () {
                var dropifyInput = $(this);
                var fileUrl = dropifyInput.attr('data-default-file');

                if (fileUrl && fileUrl.endsWith('.webp')) {
                    setTimeout(function () {
                        var previewContainer = dropifyInput.closest('.dropify-wrapper').find('.dropify-preview');
                        previewContainer.addClass('show');
                        previewContainer.find('.dropify-render').html('<img src="' + fileUrl + '" alt="WebP Image">');
                    }, 500);
                }
            });
        });


    </script>

    @stack('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"
    integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $("input[data-role=tagsinput]").tagsinput({
        duplicate: false,
        confirmKeys: [13, 188]
    });

    $('.bootstrap-tagsinput input').on('keypress', function(e) {
        if (e.keyCode == 13) {
            e.keyCode = 188;
            e.preventDefault();
        };
    });
</script>
<script src="{{ asset('js/toaster.js') }}"></script>

    <!-- App js -->
</body>

</html>