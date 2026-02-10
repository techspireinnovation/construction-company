@extends('layouts.frontend.master')
@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>{{ $service->title ?? $meta_title }}</title>

    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:image" content="{{ $meta_image }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $meta_title }}">
    <meta property="twitter:description" content="{{ $meta_description }}">
    <meta property="twitter:image" content="{{ $meta_image }}">
@endsection
@section('style')
<style>
    .service-description p {
    all: unset;
    display: block;    /* keep paragraph structure */
    color: #000000;
    line-height: 1.7;
    margin-bottom: 15px;
}

</style>
@endsection
@section('content')
    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
         @php
         $breadcrumbs = [
             ['label' => 'Home', 'url' => route('web.home')],
             ['label' => 'Services', 'url' => route('web.services')],
             ['label' => $service->title]
         ];
     @endphp

     <x-page-banner
         :title="$service->title"
         :banner="isset($service) && $service->banner_image ? asset('storage/' . $service->banner_image) : null"
         :breadcrumbs="$breadcrumbs"
     />

        <!-- Breadcrumb row END -->
		<!-- content area -->
		<div class="section-full content-inner-3 single-service">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-xl-3 m-b30">
						<div class="side-link-service">
							<ul class="service-list">
								<li><a href="{{ route('web.services') ?? '#' }}">View All Services</a> <span class="fa fa-cog"></span></li>
								@php
									// Get all active services for sidebar
									$allServices = App\Models\Service::where('status', 1)->whereNull('deleted_at')->get();
								@endphp

								@if(isset($allServices) && $allServices->count())
									@foreach($allServices as $sidebarService)
										<li class="{{ (isset($service) && $sidebarService->id == $service->id) ? 'active' : '' }}">
											<a href="{{ route('web.service.single', $sidebarService->slug ?? '#') }}">
												{{ $sidebarService->title ?? 'Service' }}
											</a>
										</li>
									@endforeach
								@else
									<!-- Fallback services -->
									<li class="active"><a href="#">Construction</a></li>
									<li><a href="#">Building design</a></li>
									<li><a href="#">Renovation</a></li>
									<li><a href="#">Architecture</a></li>
									<li><a href="#">Home Design</a></li>
									<li><a href="#">Construct Planning</a></li>
								@endif
							</ul>
						</div>
					</div>
					<div class="col-lg-8 col-xl-9">
						<div class="right-side">
							<div class="space">
								@if(isset($service) && $service->image)
									<img src="{{ asset('storage/' . $service->image) ?? '' }}" alt="{{ $service->title ?? 'Service Image' }}">
								@else
									<img src="{{ asset('Website/images/service/service-1.jpg') ?? '' }}" alt="Service Image">
								@endif
							</div>
							<div class="section-head">
								<h2>{{ $service->title ?? 'Construct Design' }}</h2>
								<div class="divider-sc"></div>
							</div>
                            <div class="service-description">
                                @if(isset($service) && $service->description)
                                    {!! $service->description !!}
                                @else
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                @endif
                            </div>


							{{-- @if(isset($service) && $service->short_description)
								<div class="">
									<p>{{ $service->short_description ?? '' }}</p>
								</div>
							@else
								<div class="">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic.</p>
								</div>
							@endif --}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- content area end -->
	</div>
	<!-- content-end -->
	@endsection