@extends('layouts.frontend.master')

@section('content')

    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Service</h1>
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
                    <li>Service</li>
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
		<div class="section-full content-inner-3 service-page">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-sm-6">
                        <div class="sr-pg-bx">
                            <figure class="sr-img-bx">
                                <a href="service-single.html"><img src="{{asset('Website/images/service/1.jpg')}}" alt="Awesome Image"></a>
                            </figure>
                            <div class="cont-bx">
                                <a href="service-single.html"><h4>Architecture</h4></a>
                                <p class="m-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-4 col-sm-6">
                        <div class="sr-pg-bx">
                            <figure class="sr-img-bx">
                                <a href="service-single.html"><img src="{{asset('Website/images/service/2.jpg')}}" alt="Awesome Image"></a>
                            </figure>
                            <div class="cont-bx">
                                <a href="service-single.html"><h4>Building Construct</h4></a>
                                <p class="m-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-4 col-sm-6">
                        <div class="sr-pg-bx">
                            <figure class="sr-img-bx">
                                <a href="service-single.html"><img src="{{asset('Website/images/service/3.jpg')}}" alt="Awesome Image"></a>
                            </figure>
                            <div class="cont-bx">
                                <a href="service-single.html"><h4>Renovation</h4></a>
                                <p class="m-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-4 col-sm-6">
                        <div class="sr-pg-bx">
                            <figure class="sr-img-bx">
                                <a href="service-single.html"><img src="{{asset('Website/images/service/4.jpg')}}" alt="Awesome Image"></a>
                            </figure>
                            <div class="cont-bx">
                                <a href="service-single.html"><h4>Home Design</h4></a>
                                <p class="m-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-4 col-sm-6">
                        <div class="sr-pg-bx">
                            <figure class="sr-img-bx">
                                <a href="service-single.html"><img src="{{asset('Website/images/service/5.jpg')}}" alt="Awesome Image"></a>
                            </figure>
                            <div class="cont-bx">
                                <a href="service-single.html"><h4>Safety and Security</h4></a>
                                <p class="m-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-4 col-sm-6">
                        <div class="sr-pg-bx">
                            <figure class="sr-img-bx">
                                <a href="service-single.html"><img src="{{asset('Website/images/service/6.jpg')}}" alt="Awesome Image"></a>
                            </figure>
                            <div class="cont-bx">
                                <a href="service-single.html"><h4>Renovation</h4></a>
                                <p class="m-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<!-- content area end -->
	</div>
	<!-- content-end -->
    @endsection