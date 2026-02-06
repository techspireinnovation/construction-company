@extends('layouts.frontend.master')

@section('content')
    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Our Projects</h1>
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
                    <li>our projects</li>
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
		<div class="section-full content-inner-2">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="site-filters clearfix center  m-b40">
							<ul class="filters" data-toggle="buttons">
								<li data-filter="" class="btn active">
									<input type="radio">
									<a href="#" class="site-button-secondry button-sm radius-xl">All</a>
								</li>
								<li data-filter="web" class="btn">
									<input type="radio">
									<a href="#" class="site-button-secondry button-sm radius-xl">Construct</a>
								</li>
								<li data-filter="advertising" class="btn">
									<input type="radio">
									<a href="#" class="site-button-secondry button-sm radius-xl">Building</a>
								</li>
								<li data-filter="branding" class="btn">
									<input type="radio">
									<a href="#" class="site-button-secondry button-sm radius-xl">Renovation</a>
								</li>
								<li data-filter="design" class="btn">
									<input type="radio">
									<a href="#" class="site-button-secondry button-sm radius-xl">Architecture</a>
								</li>
								<li data-filter="photography" class="btn">
									<input type="radio">
									<a href="#" class="site-button-secondry button-sm radius-xl">Home</a>
								</li>
							</ul>
						</div>
						<div class="clearfix">
							<div id="masonry" class="row dez-gallery-listing gallery-grid-4 gallery mfp-gallery port-style1">
								<div class="card-container web branding col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-1.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-1.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Buildings Construct</h5>
										</div>
									</div>
								</div>
								<div class="card-container advertising design col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-2.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-2.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Interior Design</h5>
										</div>
									</div>
								</div>
								<div class="card-container web design col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-3.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-3.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Building Planing</h5>
										</div>
									</div>
								</div>
								<div class="card-container advertising branding col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-4.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-4.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Architecture</h5>
										</div>
									</div>
								</div>
								<div class="card-container web design col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-5.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-5.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Home Design</h5>
										</div>
									</div>
								</div>
								<div class="card-container advertising photography col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-6.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-6.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Buildings Construct</h5>
										</div>
									</div>
								</div>
								<div class="card-container web branding col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-7.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-7.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Interior Design</h5>
										</div>
									</div>
								</div>
								<div class="card-container advertising photography col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-8.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-8.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Building Planing</h5>
										</div>
									</div>
								</div>
								<div class="card-container web design col-lg-4 col-sm-6">
									<div class="Project-bx">
										<div class="Proj-img-bx">
											<img src="{{ asset('Website/images/project/image-9.jpg')}}" alt="Awesome Image"/>
											<div class="Proj-overlay-eff">
												<div class="proj-part">
													<div class="Proj-cont">
														<div class="first">
															<ul class="list-inline">
																<li><a href="#"><i class="fa fa-link"></i></a></li>
																<li><a href="{{ asset('Website/images/project/thumb-img-9.jpg')}}" class="mfp-link" title="Title Come Here"><i class="fa fa-search-plus"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="title-bx text-center">
											<h5>Architecture</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<ul class="pagination">
							<li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- content area end -->
	</div>
	<!-- content-end -->
    @endsection
   