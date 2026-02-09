@props([
    'title' => 'Page Title',
    'banner' => null,
    'breadcrumbs' => [],
    'showShare' => true // optional share buttons
])

<!-- inner page banner -->
<div class="dez-bnr-inr overlay-primary-dark text-center"
     style="background: url({{ $banner ?? asset('Website/images/background/image-1.jpg') }}) no-repeat center center;
            background-size: cover;">
    <div class="container">
        <div class="dez-bnr-inr-entry">
            <h1 class="text-white">{{ $title }}</h1>
        </div>
    </div>
</div>
<!-- inner page banner END -->

<!-- Breadcrumb row -->
<div class="breadcrumb-row">
    <div class="container d-flex justify-content-between align-items-center">
        <ul class="list-inline mb-0">
            @foreach($breadcrumbs as $breadcrumb)
                @if(!$loop->last)
                    <li class="list-inline-item"><a href="{{ $breadcrumb['url'] ?? '#' }}">{{ $breadcrumb['label'] ?? '' }}</a></li>
                @else
                    <li class="list-inline-item active">{{ $breadcrumb['label'] ?? '' }}</li>
                @endif
            @endforeach
        </ul>

        @if($showShare)
        @php
            $currentUrl = urlencode(url()->current());
            $shareTitle = urlencode($title);
        @endphp
        <div class="share">
            <div class="share-link-rw">
                <ul class="share-open list-inline mb-0">
                    <li class="list-inline-item"><a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $currentUrl }}&title={{ $shareTitle }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <li class="list-inline-item"><a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $currentUrl }}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <a href="#" class="share-butn"><i class="fa fa-share-alt"></i>share</a>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Breadcrumb row END -->
