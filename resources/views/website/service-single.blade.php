@extends('layouts.frontend.master')

@section('content')
    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Service Single</h1>
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
                    <li>service single</li>
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
								<li><a href="service.html">View All Services</a> <span class="fa fa-cog"></span></li>
								<li class="active"><a href="service-single.html">Construction</a></li>
								<li><a href="service-single.html">Building design</a></li>
								<li><a href="service-single.html">Renovation</a></li>
								<li><a href="service-single.html">Architecture</a></li>
								<li><a href="service-single.html">Home Design</a></li>
								<li><a href="service-single.html">Construct Planning</a></li>
							</ul>
							<div class="folder">
								<div class="img-box text-center">
									<img src="{{asset('Website/service/service-2.jpg')}}" alt="">
								</div>
								<ul class="fld-list">
									<li>
										<a href="#">
											<span class="fa fa-file-pdf-o"></span>Our Brouchure.txt<i class="fa fa-download"></i>
										</a>
									</li>
								</ul>
							</div>
							<div class="des-author">
								<div class="au-bx">
									<h5>Human Resource:</h5>
									<div class="au-img-bx">
										<img src="{{asset('Website/service/thumb4.jpg')}}" alt="">
									</div>
									<div class="cont-bx">
										<h5>Charles Mecky</h5>
										<p><i class="fa fa-phone"></i>+123 456 789</p>
										<p><i class="fa fa-envelope"></i>info@gmail.com</p>
									</div>
								</div>
								<div class="au-bx">
									<h5>Sales Department:</h5>
									<div class="au-img-bx">
										<img src="{{asset('Website/service/thumb5.jpg')}}" alt="">
									</div>
									<div class="cont-bx">
										<h5>Robert Fertly</h5>
										<p><i class="fa fa-phone"></i>+123 456 789</p>
										<p><i class="fa fa-envelope"></i>info@gmail.com</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-xl-9">
						<div class="right-side">
							<div class="space"><img src="{{asset('Website/service/service-1.jpg')}}" alt=""></div>
							<div class="section-head">
								<h2>Construct Design</h2>
								<div class="divider-sc"></div>
							</div>
							<div class="">
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.  It was popularised in the 1960s with the release of Letraset sheets containing.</p>
							</div>
							<blockquote>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</blockquote>
							<div class="">
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic.</p>
							</div>
							<div class="section-head">
								<h2>Construct Design</h2>
								<div class="divider-sc"></div>
							</div>
							<div class="row develop ">
								<div class="col-md-4 col-sm-6 col-12 space">
									<div class="bx text-center">
										<div class="icon_box">
											<span class="ti-ruler-pencil"></span>
										</div>
										<h4>Architectural <br> Design</h4>
										<p class="m-0">Lorem Ipsum is simply dummy text of the printing.</p>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-12 space">
									<div class="bx text-center">
										<div class="icon_box">
											<span class="ti-reload"></span>
										</div>
										<h4>Reconstruction <br> Services</h4>
										<p class="m-0">Lorem Ipsum is simply dummy text of the printing.</p>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-12 space">
									<div class="bx text-center">
										<div class="icon_box">
											<span class="ti-pencil-alt"></span>
										</div>
										<h4>Electrical <br> Systems</h4>
										<p class="m-0">Lorem Ipsum is simply dummy text of the printing.</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-md-6 col-12">
									<div class="section-head">
										<h3>Advantages of Services</h3>
										<div class="divider-sc"></div>
									</div>
									<div class="text">
										<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book, It has survived not.</p>
									</div>
									<ul class="profit">
										<li>Develop new ideas and market them</li>
										<li>Build a business strategy and plan</li>
										<li>Protect intellectual property</li>
										<li>Build leadership and management skills</li>
										<li>Improve manufacturing processes</li>
									</ul>
								</div>
								<div class="col-md-6 col-md-6 col-12">
									<div class="section-head">
										<h3>Construct Design Planing</h3>
										<div class="divider-sc"></div>
									</div>
									<div class="dez-accordion box-sort-in space active-bg accdown1 " id="accordion001">
										<div class="panel">
											<div class="acod-head">
												<h6 class="acod-title"> <a data-toggle="collapse" data-target="#collapseOne001" class="collapsed" aria-expanded="false">Security and Safety</a> </h6>
											</div>
											<div id="collapseOne001" class="acod-body collapse" data-parent="#accordion001">
												<div class="acod-content">
													<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
												</div>
											</div>
										</div>
										<div class="panel">
											<div class="acod-head">
												<h6 class="acod-title"> <a data-toggle="collapse" data-target="#collapseTwo001" aria-expanded="true">Construct Design Concept</a> </h6>
											</div>
											<div id="collapseTwo001" class="acod-body collapse show" data-parent="#accordion001">
												<div class="acod-content">
													<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
												</div>
											</div>
										</div>
										<div class="panel">
											<div class="acod-head">
												<h6 class="acod-title"> <a data-toggle="collapse" data-target="#collapseThree001" class="collapsed" aria-expanded="false">Architecture</a> </h6>
											</div>
											<div id="collapseThree001" class="acod-body collapse" data-parent="#accordion001">
												<div class="acod-content">
													<p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="">
								<div class="section-head">
									<h3>Request Free Consultation</h3>
									<div class="divider-sc"></div>
								</div>
								<form class="form-design dzForm" method="post" action="script/contact.php">
									<input type="hidden" value="Contact" name="dzToDo">	
									<div class="dzFormMsg"></div>
									<div class="row clearfix">
										<div class="col-md-6 col-sm-12 col-12">
											<div class="form-group">
												<input type="text" name="dzName" class="form-control" value="" placeholder="Your Name *">
											</div>
											<div class="form-group">
												<input type="email" name="dzEmail" class="form-control" value="" placeholder="Your Mail *">
											</div>
											<div class="form-group">
												<select class="form-control">
													<option>Select Service</option>
													<option>service one</option>
													<option>service two</option>
													<option>single service</option>
												</select>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<div class="g-recaptcha" data-sitekey="6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
												<input class="form-control d-none" style="display:none;" data-recaptcha="true" required="" data-error="Please complete the Captcha">
											</div>
										</div>
										<div class="col-md-6 col-sm-12 col-12">
											<div class="form-group">
												<textarea class="form-control" placeholder="Your Message...."></textarea>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-12 m-b30">
											<button name="submit" type="submit" value="Submit" class="site-button w-100">send message</button>
										</div>
									</div>
								</form>
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