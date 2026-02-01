@extends('layouts.frontend.master')

@section('content')


    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{asset('Website/images/background/image-1.jpg')}});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">About Us</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container d-flex justify-content-between">
                <ul class="list-inline">
                    <li><a href="#">Home</a></li>
                    <li>About us 1</li>
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
		<div class="section-full content-inner about-bx">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 m-b30">
						<h5>We build dream for better life with great idea.</h5>
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text.</p>
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
						<div class="d-flex">
							<div class="m-r50 align-self-center">
								<a href="#" class="site-button">Know More</a>
							</div>
							<img src="{{asset('Website/images/item/signature.jpg')}}" alt="">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="m-b20 media-box">
									<img src="{{asset('Website/images/item/image-7.jpg')}}" alt="">
								</div>
                                <h5>Our Mission</h5>
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="m-b20 media-box">
									<img src="{{asset('Website/images/item/image-8.jpg')}}" alt="">
								</div>
                                <h5>Our Vision</h5>
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	
		<!-- Approach -->
		<div class="section-full content-inner approach">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-head text-center">
							<h2>Why Choose Us</h2>
							<div class="divider-sc"></div>
						</div>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-md-4 col-sm-12 col-12 m-b30">
                        <div class="approach-bx">
                            <div class="icon_box">
                                <span><i class="fa fa-pencil"></i></span>
                            </div>
                            <h4>ARCHITECTURAL DESIGN</h4>
                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12 m-b30">
                        <div class="approach-bx active">
                            <div class="icon_box">
                                <span><i class="fa fa-refresh"></i></span>
                            </div>
                            <h4>RECONSTRUCTION SERVICES</h4>
                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12 m-b30">
                        <div class="approach-bx">
                            <div class="icon_box">
                                <span><i class="fa fa-pencil-square-o"></i></span>
                            </div>
                            <h4>ELECTRICAL SYSTEMS</h4>
                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<!-- Approach end -->
		<!-- team -->
		<div class="team section-full content-inner overlay-black-dark" style="background-image:url({{asset('Website/images/background/image-3.jpg')}});">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-head text-white">
							<h2>Meet Our team</h2>
							<div class="divider-sc"></div>
						</div>
					</div>
				</div>
				<div class="row">
                    <div class="col-lg-3 col-sm-6 col-12 m-b30">
                        <div class="team-bx">
                            <figure class="team-img-bx">
                                <a href="#"><img src="{{asset('Website/images/team/image-1.jpg')}}" alt=""></a>
                                <div class="team-overlay-bx">
                                    <div class="team-in-bx">
                                        <ul class="social-link">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </figure>
                            <div class="user-bx text-center">
                                <h4>Brown Angelino</h4>
                                <a href="#">
                                    <p class="position">President</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 m-b30">
                        <div class="team-bx">
                            <figure class="team-img-bx">
                                <a href="#"><img src="{{asset('Website/images/team/image-2.jpg')}}" alt=""></a>
                                <div class="team-overlay-bx">
                                    <div class="team-in-bx">
                                        <ul class="social-link">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </figure>
                            <div class="user-bx text-center">
                                <h4>Astley Fletcher</h4>
                                <a href="#">
                                    <p class="position">Founder</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 m-b30">
                        <div class="team-bx">
                            <figure class="team-img-bx">
                                <a href="#"><img src="{{asset('Website/images/team/image-3.jpg')}}" alt=""></a>
                                <div class="team-overlay-bx">
                                    <div class="team-in-bx">
                                        <ul class="social-link">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </figure>
                            <div class="user-bx text-center">
                                <h4>Jones Antony</h4>
                                <a href="#">
                                    <p class="position">Designer</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 m-b30">
                        <div class="team-bx">
                            <figure class="team-img-bx">
                                <a href="#"><img src="{{asset('Website/images/team/image-4.jpg')}}" alt=""></a>
                                <div class="team-overlay-bx">
                                    <div class="team-in-bx">
                                        <ul class="social-link">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </figure>
                            <div class="user-bx text-center">
                                <h4>Bernatt Rotty</h4>
                                <a href="#">
                                    <p class="position">Manager</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- team end -->
		<!-- Press -->
		<div class="team section-full content-inner-2 Press">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-head text-center">
							<h2>Latest News</h2>
							<div class="divider-sc"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="img-carousel-dots-nav owl-btn-3 owl-loaded owl-theme owl-carousel owl-none">
							<div class="item">
								<div class="Press-bx"><img src="{{asset('Website/images/item/image-12.jpg')}}" alt=""></div>
								<div class="Press-cont">
									<h4><a href="#">Title of Our Project</a></h4>
									<p class="date">25 July, 2020</p>
									<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
							</div>
							<div class="item">
								<div class="Press-bx"><img src="{{asset('Website/images/item/image-13.jpg')}}" alt=""></div>
								<div class="Press-cont">
									<h4><a href="#">Title of Our Project</a></h4>
									<p class="date">25 July, 2020</p>
									<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
							</div>
							<div class="item">
								<div class="Press-bx"><img src="{{asset('Website/images/item/image-12.jpg')}}" alt=""></div>
								<div class="Press-cont">
									<h4><a href="#">Title of Our Project</a></h4>
									<p class="date">25 July, 2020</p>
									<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
							</div>
							<div class="item">
								<div class="Press-bx"><img src="{{asset('Website/images/item/image-13.jpg')}}" alt=""></div>
								<div class="Press-cont">
									<h4><a href="#">Title of Our Project</a></h4>
									<p class="date">25 July, 2020</p>
									<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
							</div>
							<div class="item">
								<div class="Press-bx"><img src="{{asset('Website/images/item/image-12.jpg')}}" alt=""></div>
								<div class="Press-cont">
									<h4><a href="#">Title of Our Project</a></h4>
									<p class="date">25 July, 2020</p>
									<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
							</div>
							<div class="item">
								<div class="Press-bx"><img src="{{asset('Website/images/item/image-13.jpg')}}" alt=""></div>
								<div class="Press-cont">
									<h4><a href="#">Title of Our Project</a></h4>
									<p class="date">25 July, 2020</p>
									<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Press end -->
		<!-- subscribe -->
		<div class="section-full content-inner-2 subscribe" style="background-image:url({{asset('Website/images/background/image-2.jpg')}});">
			<div class="container text-center text-white">
				<div class="row">
					<div class="col-md-8 m-auto">
						<div class="section-head">
							<h2>Subscribe For Newsletter</h2>
							<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
						</div>
						<form class="dzSubscribe" action="script/mailchamp.php" method="post">
							<div class="dzSubscribeMsg"></div>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-envelope"></i></span>
								</div>
								<input name="dzEmail" required="required"  class="form-control" placeholder="Your Email Address" type="email">
								<div class="input-group-append">
									<button class="site-button" name="submit" value="Submit" type="submit">Subscribe us</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- subscribe end -->
		<!-- content area end -->
	</div>
	<!-- content-end -->
@endsection