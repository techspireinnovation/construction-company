@extends('layouts.frontend.master')

@section('content')
    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Blog Details</h1>
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
                    <li>blog details</li>
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
		<div class="section-full content-inner-3 blog-single blog-detail-pg">
			<div class="container">
				<div class="row">
					<div class="col-xl-8 col-lg-8">
						<div class="blog-post blog-lg blog-style-1">
							<div class="dez-post-media"> <a href="#"><img src="{{asset('Website/images/blog/image-7.jpg')}}" alt=""></a> </div>
								<div class="dez-post-title ">
									<h5>Consulting</h5>
									<h4 class="post-title"><a href="#">Make your dream with great construction planner</a></h4>
								</div>
								<div class="dez-info">
								 <div class="dez-post-meta">
									<ul class="d-flex align-items-center">
										<li class="post-author">by <a href="#"> mark fletcher</a> </li>
										<li class="post-date">October 25, 2020</li>
										<li class="post-comment"><a href="#">21 Comments</a> </li>
									</ul>
								</div>
								<div class="dez-post-text">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
									<img class="alignleft wow fadeIn blog-side-img" data-wow-delay="0.2s" src="{{asset('Website/images/blog/image-12.jpg')}}" alt="">
									<div class="quote">
										<i class="fa fa-quote-left"></i>
									</div>
									<p class="m-b15">Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of book.</p>
									<h5 class="m-b0">DOHN GASKEL</h5>
                                    <p class="text-primary">Manager</p>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
								</div>
							</div>
						</div>
						<div class="share-details">
							<div class="align-self-center"><ul class="tag-line m-0">
								<li>Tags:</li>
								<li><a href="#">Construction,</a></li>
								<li><a href="#">Architecture,</a></li>
								<li><a href="#">Interior,</a></li>
							</ul></div>
							<div class="social-bx">
								<span>Share <i class="fa fa-share-alt"></i></span>
								<ul class="list-inline social m-0">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="author">
							<div class="box-in">
								<figure class="author-img"><img src="{{asset('Website/images/blog/author.jpg')}}" alt=""></figure>
								<h4>Mark Richardson</h4>
								<div class="">
									<p class="m-b5">Printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
									<ul class="list-inline social-icons">
										<li>
											<a href="#"><i class="fa fa-facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-twitter"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-google-plus"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-youtube"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="reviews">
							<div class="section-head">
								<h3>Read Comments</h3>
								<div class="divider-sc"></div>
							</div>
							<div class="review-bx">
								<div class="review-single">
									<div class="img-bx">
										<img src="{{asset('Website/images/shop/thumb1.jpg')}}" alt="">
									</div>
									<div class="review-cont">
										<div class="first-sc">
											<div class="name float-left">
												<h5>Steven Rich – Sep 17, 2016:</h5 >
											</div>
											<div class="stars float-right">
												<ul>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
												</ul>
											</div>
										</div>
										<div class="">
											<p class="m-0">Printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book..</p>
										</div>
									</div>
								</div>
								<!--End single review box-->
								<!--Start single review box-->
								<div class="review-single">
									<div class="img-bx">
										<img src="{{asset('Website/images/shop/thumb2.jpg')}}" alt="">
									</div>
									<div class="review-cont">
										<div class="first-sc">
											<div class="name float-left">
												<h5>Steven Rich – Sep 17, 2016:</h5 >
											</div>
											<div class="stars float-right">
												<ul>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
												</ul>
											</div>
										</div>
										<div class="">
											<p class="m-0">Printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book..</p>
										</div>
									</div>
								</div>
								<!--End single review box-->
							</div>
							<div class="review-user">
								<div class="section-head head-1">
									<h3>Add Your comments</h3>
									<div class="divider-sc"></div>
								</div>
								<span>Your Rating</span>
								<ul class="rating">
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
								</ul>
								<ul class="active rating">
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
								</ul>
								<ul class="rating">
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
								</ul>
								<ul class="rating">
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
								</ul>
								<ul class="fix_border rating">
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
								</ul>
								<form action="#">
									<div class="row">
										<div class="col-md-6 col-sm-12 col-12">
											<label>First Name*</label>
											<input type="text" placeholder="">
										</div>
										<div class="col-md-6 col-sm-12 col-12">
											<label>Last Name*</label>
											<input type="text" placeholder="">
										</div>

										<div class="col-md-12 col-sm-12 col-12">
											<label>Email*</label>
											<input type="email" placeholder="">
										</div>
										<div class="col-md-12 col-sm-12 col-12">
											<label>Your Comments*</label>
											<textarea placeholder=""></textarea>
										</div>
									</div>
									<button class="site-button">submit now</button>
								</form>
							</div>
							<!-- End of .add_your_review -->
						</div>
					</div>
					<!-- Side bar start -->
					<div class="col-xl-4 col-lg-4">
						<aside  class="side-bar">
							<div class="widget">
								<div class="search-bx">
									<form role="search" method="post">
										<div class="input-group">
											<input name="text" type="text" class="form-control" placeholder="Search...">
											<span class="input-group-btn">
											<button type="submit" class="site-button"><i class="fa fa-search"></i></button>
											</span> 
										</div>
									</form>
								</div>
							</div>
							<div class="widget widget_categories">
								<h4 class="widget-title">Categories List</h4>
								<ul>
									<li><a href="#">Business Growth</a> (1)</li>
									<li><a href="#">Consulting</a> (1) </li>
									<li><a href="#">Management</a> (1) </li>
									<li><a href="#">Customer Insights </a> (1) </li>
									<li><a href="#">Organization</a> (1) </li>
								</ul>
							</div>
							<div class="widget recent-posts-entry">
								<h4 class="widget-title">Recent Posts</h4>
								<div class="widget-post-bx">
									<div class="widget-post clearfix">
										<div class="dez-post-media"> <a href="#"><img src="{{asset('Website/images/blog/post-1.jpg')}}" alt=""></a> </div>
										<div class="dez-post-info">
											<div class="dez-post-header">
												<h4 class="post-title"><a href="#">The Blog Post Title Come Here</a></h4>
											</div>
											<div class="dez-post-meta">
												<div class="post-date">October 21, 2016 </div>
											</div>
										</div>
									</div>
									<div class="widget-post clearfix">
										<div class="dez-post-media"> <a href="#"><img src="{{asset('Website/images/blog/post-2.jpg')}}" alt=""> </a></div>
										<div class="dez-post-info">
											<div class="dez-post-header">
												<h4 class="post-title"><a href="#">The Blog Post Title Come Here</a></h4>
											</div>
											<div class="dez-post-meta">
												<div class="post-date">October 21, 2016 </div>
											</div>
										</div>
									</div>
									<div class="widget-post clearfix">
										<div class="dez-post-media"> <a href="#"><img src="{{asset('Website/images/blog/post-3.jpg')}}" alt=""> </a></div>
										<div class="dez-post-info">
											<div class="dez-post-header">
												<h4 class="post-title"><a href="#">The Blog Post Title Come Here</a></h4>
											</div>
											<div class="dez-post-meta">
												<div class="post-date">October 21, 2016 </div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="widget widget_gallery">
								<h5 class="widget-title">Instagram</h5>
								<ul>
									<li class="img-effect2"> <a href="#"><img src="{{asset('Website/images/blog/insta-1.jpg')}}" alt=""></a> </li>
									<li class="img-effect2"> <a href="#"><img src="{{asset('Website/images/blog/insta-2.jpg')}}" alt=""></a> </li>
									<li class="img-effect2"> <a href="#"><img src="{{asset('Website/images/blog/insta-3.jpg')}}" alt=""></a> </li>
									<li class="img-effect2"> <a href="#"><img src="{{asset('Website/images/blog/insta-4.jpg')}}" alt=""></a> </li>
									<li class="img-effect2"> <a href="#"><img src="{{asset('Website/images/blog/insta-5.jpg')}}" alt=""></a> </li>
									<li class="img-effect2"> <a href="#"><img src="{{asset('Website/images/blog/insta-6.jpg')}}" alt=""></a> </li>
								</ul>
							</div>
							<div class="widget">
                               <h5 class="widget-title">Blog Archives</h5>
								<form class="form-design">
									<select class="form-control">
										<option>September</option>
										<option>August</option>
										<option>November</option>
										<option>December</option>
									</select>
								</form>
                            </div>
							<div class="widget widget_tag_cloud">
                                <h5 class="tagcloud">Tags Cloud</h5>
                                <div class="tagcloud"> <a href="#">Design</a> <a href="#">User interface</a> <a href="#">SEO</a> <a href="#">WordPress</a> <a href="#">Development</a> <a href="#">Joomla</a> <a href="#">Design</a> </div>
                            </div>
						</aside>
					</div>
                    <!-- Side bar END -->
				</div>
				
			</div>
		</div>
		<!-- content area end -->
	</div>
	<!-- content-end -->
	@endsection