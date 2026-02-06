@extends('layouts.frontend.master')

@section('content')
    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <!-- inner page banner -->
<div class="dez-bnr-inr overlay-primary-dark text-center"
style="background: url({{ isset($service) && $service->banner_image ? asset('storage/' . $service->banner_image) : asset('Website/images/background/image-1.jpg') }});">
<div class="container">
   <div class="dez-bnr-inr-entry">
       <h1 class="text-white">{{ $service->title ?? 'Service Title' }}</h1>
   </div>
</div>
</div>
<!-- inner page banner END -->

        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container d-flex justify-content-between">
                <ul class="list-inline">
                    <li><a href="{{ route('web.home') ?? '#' }}">Home</a></li>
					<li><a href="{{ route('web.services') ?? '#' }}">Services</a></li>
                    <li>{{ $service->title ?? 'Service' }}</li>
                </ul>
				<div class="share">
					<div class="share-link-rw">
						<ul class="share-open">
							<li><a href="#" class=""><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class=""><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class=""><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#" class=""><i class="fa fa-twitter"></i></a></li>
						</ul>
						<a href="#" class="share-butn"><i class="fa fa-share-alt"></i>share</a>
					</div>
				</div>
            </div>
        </div>
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
							<div class="">
                                <div class="">
                                    @if(isset($service) && $service->description)
                                        {!! $service->description !!}
                                    @else
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.  It was popularised in the 1960s with the release of Letraset sheets containing.</p>
                                    @endif
                                </div>

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