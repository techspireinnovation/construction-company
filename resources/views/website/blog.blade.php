@extends('layouts.frontend.master')

@section('content')

    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Blog Grid View</h1>
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
                    <li>grid view</li>
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
		<div class="section-full content-inner-3 blog-page blog-sc">
			<div class="container">
				<div class="row">
					<div class="col-xl-8 col-lg-8">
						<div class="row">
							<div class="col-lg-6 col-sm-6">
								<div class="blog-post blog-grid">
									<div class="dez-post-media dez-img-effect"> <a href="#"><img src="{{ asset('Website/images/blog/image-1.jpg') }}" alt=""></a> </div>
									<div class="dez-info">
										 <div class="dez-post-meta">
											By fletcher | April 21, 2016
										</div>
										<div class="dez-post-title ">
											<h5 class="post-title"><a href="#">Title of first blog</a></h5>
										</div>
										<div class="dez-post-text">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="blog-post blog-grid">
									<div class="dez-post-media dez-img-effect"> <a href="#"><img src="{{ asset('Website/images/blog/image-2.jpg') }}" alt=""></a> </div>
									<div class="dez-info">
										<div class="dez-post-meta">
											By fletcher | April 21, 2016
										</div>
										<div class="dez-post-title ">
											<h5 class="post-title"><a href="#">Title of first blog</a></h5>
										</div>
										<div class="dez-post-text">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="blog-post blog-grid">
									<div class="dez-post-media dez-img-effect"> <a href="#"><img src="{{ asset('Website/images/blog/image-3.jpg') }}" alt=""></a> </div>
									<div class="dez-info">
										 <div class="dez-post-meta">
											By fletcher | April 21, 2016
										</div>
										<div class="dez-post-title ">
											<h5 class="post-title"><a href="#">Title of first blog</a></h5>
										</div>
										<div class="dez-post-text">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="blog-post blog-grid">
									<div class="dez-post-media dez-img-effect"> <a href="#"><img src="{{ asset('Website/images/blog/image-4.jpg') }}" alt=""></a> </div>
									<div class="dez-info">
										 <div class="dez-post-meta">
											By fletcher | April 21, 2016
										</div>
										<div class="dez-post-title ">
											<h5 class="post-title"><a href="#">Title of first blog</a></h5>
										</div>
										<div class="dez-post-text">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="blog-post blog-grid">
									<div class="dez-post-media dez-img-effect"> <a href="#"><img src="{{ asset('Website/images/blog/image-5.jpg') }}" alt=""></a> </div>
									<div class="dez-info">
										 <div class="dez-post-meta">
											By fletcher | April 21, 2016
										</div>
										<div class="dez-post-title ">
											<h5 class="post-title"><a href="#">Title of first blog</a></h5>
										</div>
										<div class="dez-post-text">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="blog-post blog-grid">
									<div class="dez-post-media dez-img-effect"> <a href="#"><img src="{{ asset('Website/images/blog/image-6.jpg') }}" alt=""></a> </div>
									<div class="dez-info">
										 <div class="dez-post-meta">
											By fletcher | April 21, 2016
										</div>
										<div class="dez-post-title ">
											<h5 class="post-title"><a href="#">Title of first blog</a></h5>
										</div>
										<div class="dez-post-text">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
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
											</span> </div>
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
										<div class="dez-post-media"> <a href="#"><img src="{{ asset('Website/images/blog/post-1.jpg') }}" alt=""></a> </div>
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
										<div class="dez-post-media"> <a href="#"><img src="{{ asset('Website/images/blog/post-2.jpg') }}" alt=""> </a></div>
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
										<div class="dez-post-media"> <a href="#"><img src="{{ asset('Website/images/blog/post-3.jpg') }}" alt=""> </a></div>
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