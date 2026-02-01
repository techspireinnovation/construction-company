@extends('layouts.frontend.master')

@section('content')
    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Contact Us</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container d-flex justify-content-between">
                <ul class="list-inline">
                    <li><a href="#">Home</a></li>
                    <li>contact us</li>
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
		<div class="contact-page">
			<div class="section-full content-inner">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-head head-1">
								<h3>Contact Information</h3>
								<div class="divider-sc"></div>
							</div>
							<div class="">
								<p><p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the.</p>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="dez-accordion box-sort-in space active-bg contact-info accdown1" id="accordion001">
										<div class="panel">
											<div class="acod-head">
												<h6 class="acod-title"> <a data-toggle="collapse" data-target="#collapseOne001" class="collapsed" aria-expanded="false">Our Location</a> </h6>
											</div>
											<div id="collapseOne001" class="acod-body collapse show" data-parent="#accordion001">
												<div class="acod-content">
													<ul class="info-link">
														<li>
															<div class="ic-bx">
																<i class="fa fa-home"></i>
															</div>
															<div class="add-bx">
																<p><b>Address:</b> demo address #8901,
																<br> Marmora Road Chi Minh City, Vietnam </p>
															</div>
														</li>
														<li>
															<div class="ic-bx">
																<i class="fa fa-phone"></i>
															</div>
															<div class="add-bx">
																<p><b>Call Us:</b>
																<br>+123 456 7890</p>
															</div>
														</li>
														<li>
															<div class="ic-bx">
																<i class="fa fa-envelope"></i>
															</div>
															<div class="add-bx">
																<p><b>Mail Us:</b>
																<br>info@example.com</p>
															</div>
														</li>
														<li>
															<div class="ic-bx">
																<i class="fa fa-clock-o"></i>
															</div>
															<div class="add-bx">
																<p><b>Opening Time:</b>
																<br>Mon - Sat: 09.00am to 18.00pm</p>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<div class="col-lg-8">
									<div class="align-self-stretch">
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.38324904817!2d75.65012776138988!3d26.885447577280722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1540542287647" style="border:0; width: 100%; height: 450px;" allowfullscreen=""></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="section-full">
				<div class="container content-inner bdr-tp">
					<div class="row">
						<div class="col-lg-8">
							<div class="section-head head-1">
								<h3>Send Your Message Us</h3>
								<div class="divider-sc"></div>
							</div>
							<form class="form-design dzForm" method="post" action="script/contact.php">
								<input type="hidden" value="Contact" name="dzToDo">	
								<div class="dzFormMsg"></div>
								<div class="row clearfix">
									<div class="col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<input name="dzName" type="text" required="" class="form-control" placeholder="Your Name">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-12">
										<div class="form-group">
											 <input name="dzEmail" type="email" class="form-control" required="" placeholder="Your Email Id">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<input name="dzMobile" type="text" class="form-control" placeholder="Mobile No">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<input name="dzSubject" type="text" class="form-control" placeholder="Subject">
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<textarea name="dzMessage" rows="4" class="form-control" required="" placeholder="Your Message..."></textarea>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<div class="g-recaptcha" data-sitekey="6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
											<input class="form-control d-none" style="display:none;" data-recaptcha="true" required="" data-error="Please complete the Captcha">
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-12 m-b30">
										 <button name="submit" type="submit" value="Submit" class="site-button  w-100"> <span>Submit</span> </button>
									</div>
								</div>
							</form>
						</div>
						<div class="col-lg-4">
							<div class="contact-image-box h-100">
                                <img 
                                    src="{{ asset('Website/images/contact.jpg') }}" 
                                    alt="Contact Image"
                                    style="width:100%; height:100%; object-fit:cover; border-radius:6px;"
                                >
                            </div>
                            
						</div>
					</div>
				</div>
			</div>
		<!-- content area end -->
		</div>
	</div>
	<!-- content-end -->
 @endsection