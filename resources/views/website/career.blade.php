@extends('layouts.frontend.master')

@section('content')

    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Career</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container d-flex justify-content-between">
                <ul class="list-inline">
                    <li><a href="{{route('web.home')}}">Home</a></li>
					<li><a href="{{route('web.about')}}">About us</a></li>
                    <li>Career</li>
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
        <!-- why choose us -->
			<div class="section-full content-inner-2 service">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-head text-center">
								<h2>Why Choosing ConstBuild</h2>
								<div class="divider-sc"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-6">
							<div class="sr-box">
								<figure class="sr-img-bx">
								   <a href="#"><img src="{{asset('Website/images/item/image-1.jpg')}}" alt=""></a>
								   <div class="sr-overlay-bx">
									  <div class="sr-in-bx">
										<div class="sr-icon-bx">
											<span><i class="fa fa-desktop" aria-hidden="true"></i></span>
										</div>
										<div class="sr-title-box">
											<h5>Construct Planning</h5>
											<div class="cont">
												<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
											</div>
										</div>
									  </div>
								   </div>
								</figure>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="sr-box">
								<figure class="sr-img-bx">
								   <a href="#"><img src="{{asset('Website/images/item/image-2.jpg')}}" alt=""></a>
								   <div class="sr-overlay-bx">
									  <div class="sr-in-bx">
										 <div class="sr-icon-bx">
											<span><i class="fa fa-database" aria-hidden="true"></i></span>
										 </div>
										 <div class="sr-title-box">
											<h5>Road Construct</h5>
											<div class="cont">
												<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
											</div>
										</div>
									  </div>
								   </div>
								</figure>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="sr-box">
								<figure class="sr-img-bx">
								   <a href="#"><img src="{{asset('Website/images/item/image-3.jpg')}}" alt=""></a>
								   <div class="sr-overlay-bx">
									  <div class="sr-in-bx">
										<div class="sr-icon-bx">
											<span><i class="fa fa-desktop" aria-hidden="true"></i></span>
										</div>
										<div class="sr-title-box">
											<h5>Building Construct</h5>
											<div class="cont">
												<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
											</div>
										</div>
									  </div>
								   </div>
								</figure>
							</div>
						</div>
					</div>
				</div>
			</div>
		
	</div>
	<!-- content-end -->
    @endsection