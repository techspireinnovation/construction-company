@extends('layouts.frontend.master')

@section('content')
    <!-- Content -->
	<div class="page-content">
		 <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-primary-dark text-center" style="background: url({{ asset('Website/images/background/image-1.jpg') }});">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Project Single</h1>
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
                    <li>project single </li>
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
		<div class="section-full content-inner">
			<div class="container">
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-xl-8 col-lg-8">
                        <!-- blog start -->
                        <div class="blog-post blog-single">
                            <div class="img-top"> <a href="#"><img src="{{asset('Website/project/image-10.jpg')}}" alt=""></a> </div>
                            <div class="dez-post-text">
                                <div class="row">
									<div class="col-lg-6 col-md-6">
										<ul class="dez-single-info">
											<li><span>Customer</span>John Doe</li>
											<li><span>Live demo </span>www.livedemo.com</li>
											<li><span>Category</span>Finance & Legal</li>
											<li><span>Date</span>23 October,2020</li>
											<li><span>Tags</span>Financial Services</li>
										</ul>
									</div>
									<div class="col-md-6 col-md-6 col-12 m-b30">
										<h4>Construction and legal work</h4>
										<p class="head">Construction Services</p>
										<div class="text">
											<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book, only five centuries,</p>
										</div>
										<div>
											<a href="#" class="site-button">Launch Project</a>
										</div>
									</div>
								</div>
                            </div>
							<div class="blog-sc-hd">
								<h4>Project Analysis</h4>
							</div>
							<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining.</p>
                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also..</p>
							<div class="graph-1">
								<img src="{{asset('Website/service/graph.jpg')}}" alt="">
							</div>
							<div class="blog-sc-hd">
								<h4>Project Solution</h4>
							</div>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged, was popularised in.</p>
							<div class="dez-accordion box-sort-in space active-bg accdown1 " id="accordion001">
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> <a data-toggle="collapse" data-target="#collapseOne001" class="collapsed" aria-expanded="false">What is the procedure to join with your company?</a> </h6>
									</div>
									<div id="collapseOne001" class="acod-body collapse" data-parent="#accordion001">
										<div class="acod-content">
											<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
										</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> <a data-toggle="collapse" data-target="#collapseTwo001"  aria-expanded="true">Do you give any offer for premium customer?</a> </h6>
									</div>
									<div id="collapseTwo001" class="acod-body collapse show" data-parent="#accordion001">
										<div class="acod-content">
											<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
										</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> <a data-toggle="collapse"  data-target="#collapseThree001" class="collapsed" aria-expanded="false">What makes you special from others?</a> </h6>
									</div>
									<div id="collapseThree001" class="acod-body collapse" data-parent="#accordion001">
										<div class="acod-content">
											<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
										</div>
									</div>
								</div>
								<div class="panel">
									<div class="acod-head">
										<h6 class="acod-title"> <a data-toggle="collapse"  data-target="#collapsefour001" class="collapsed" aria-expanded="false">Why Would a Successful Entrepreneur Hire a Coach?</a> </h6>
									</div>
									<div id="collapsefour001" class="acod-body collapse" data-parent="#accordion001">
										<div class="acod-content">
											<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled  it to make a type specimen book.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="graph-2">
								<img src="{{asset('Website/service/graph2.jpg')}}" alt="">
							</div>
                        </div>
                        <!-- blog END -->
                    </div>
                    <!-- Left part END -->
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
                                        <div class="dez-post-media"> <a href="#"><img src="{{asset('Website/blog/post-1.jpg')}}" alt=""></a> </div>
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
                                        <div class="dez-post-media"> <a href="#"><img src="{{asset('Website/blog/post-2.jpg')}}" alt=""> </a></div>
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
                                        <div class="dez-post-media"> <a href="#"><img src="{{asset('Website/blog/post-3.jpg')}}" alt=""> </a></div>
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
                                    <li class="img-effect2"> <a href="#"><img src="{{asset('Website/blog/insta-1.jpg')}}" alt=""></a> </li>
                                    <li class="img-effect2"> <a href="#"><img src="{{asset('Website/blog/insta-2.jpg')}}" alt=""></a> </li>
                                    <li class="img-effect2"> <a href="#"><img src="{{asset('Website/blog/insta-3.jpg')}}" alt=""></a> </li>
                                    <li class="img-effect2"> <a href="#"><img src="{{asset('Website/blog/insta-4.jpg')}}" alt=""></a> </li>
                                    <li class="img-effect2"> <a href="#"><img src="{{asset('Website/blog/insta-5.jpg')}}" alt=""></a> </li>
                                    <li class="img-effect2"> <a href="#"><img src="{{asset('Website/blog/insta-6.jpg')}}" alt=""></a> </li>
                                </ul>
                            </div>
							<div class="inquiry">
                                <h4>For Construction Inquiry</h4>
                                <p>You can also send us an email and we’ll get in touch shortly, or Troll Free Number - (+91) 00-700-6202.</p>
                                <a href="#" class="site-button white">send mail</a>
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
	