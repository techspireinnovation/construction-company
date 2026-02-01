@extends('layouts.frontend.master')
@section('content')

    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Testimonials</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container d-flex justify-content-between">
                <ul class="list-inline">
                    <li><a href="#">Home</a></li>
					<li><a href="#">About us</a></li>
                    <li>testimonials</li>
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
		<div class="section-full content-inner-3 testimonial-page text-center">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-sm-6">
						<div class="testimonial-des">
							<figure>
								<a href="#"><img src="{{asset('Website/images/team/1.png')}}" alt=""></a>
							</figure>
							<div class="testimonial-cont">
								<p class="m-0"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown.</p>
							</div>
							<h5 class="m-b5">Allen Duckeat</h5>
							<p class="city m-0"><a href="#"> Newyork</a></p>
                        </div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="testimonial-des">
							<figure>
								<a href="#"><img src="{{asset('Website/images/team/2.png')}}" alt=""></a>
							</figure>
							<div class="testimonial-cont">
								<p class="m-0"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown. </p>
							</div>
							<h5 class="m-b5">Steve Bairstow </h5>
							<p class="city m-0"><a href="#"> Newyork</a></p>
                        </div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="testimonial-des">
							<figure>
								<a href="#"><img src="{{asset('Website/images/team/3.png')}}" alt=""></a>
							</figure>
							<div class="testimonial-cont">
								<p class="m-0"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown. </p>
							</div>
							<h5 class="m-b5">Steve Bairstow</h5>
							<p class="city m-0"><a href="#"> Newyork</a></p>
                        </div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="testimonial-des">
							<figure>
								<a href="#"><img src="{{asset('Website/images/team/4.png')}}" alt=""></a>
							</figure>
							<div class="testimonial-cont">
								<p class="m-0"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown. </p>
							</div>
							<h5 class="m-b5">Don Flethcer</h5>
							<p class="city m-0"><a href="#"> California</a></p>
                        </div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="testimonial-des">
							<figure>
								<a href="#"><img src="{{asset('Website/images/team/5.png')}}" alt=""></a>
							</figure>
							<div class="testimonial-cont">
								<p class="m-0"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown. </p>
							</div>
							<h5 class="m-b5">Don Flethcer</h5>
							<p class="city m-0"><a href="#"> Newyork</a></p>
                        </div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="testimonial-des">
							<figure>
								<a href="#"><img src="{{asset('Website/images/team/6.png')}}" alt=""></a>
							</figure>
							<div class="testimonial-cont">
								<p class="m-0"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown. </p>
							</div>
							<h5 class="m-b5">Steve Bairstow</h5>
							<p class="city m-0"><a href="#"> California</a></p>
                        </div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="testimonial-des">
							<figure>
								<a href="#"><img src="{{asset('Website/images/team/7.png')}}" alt=""></a>
							</figure>
							<div class="testimonial-cont">
								<p class="m-0"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown. </p>
							</div>
							<h5 class="m-b5">Allen Duckeat</h5>
							<p class="city m-0"><a href="#"> Newyork</a></p>
                        </div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="testimonial-des">
							<figure>
								<a href="#"><img src="{{asset('Website/images/team/8.png')}}" alt=""></a>
							</figure>
							<div class="testimonial-cont">
								<p class="m-0"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown. </p>
							</div>
							<h5 class="m-b5">Steve Bairstow </h5>
							<p class="city m-0"><a href="#"> California</a></p>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<!-- content area end -->
	</div>
	<!-- content-end -->
	@endsection