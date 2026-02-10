@extends('layouts.frontend.master')

@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>Contact Us</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:image" content="{{ $meta_image }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $meta_title }}">
    <meta property="twitter:description" content="{{ $meta_description }}">
    <meta property="twitter:image" content="{{ $meta_image }}">
@endsection

@section('content')
<div class="page-content">

    {{-- Page Banner --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => 'Contact Us']
        ];
    @endphp

    <x-page-banner
        :title="$page->title ?? 'Contact Us'"
        :banner="$page->banner_image ? asset('storage/' . $page->banner_image) : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />
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
                                <p>
                                    Get in touch with <strong>Singh Construction Pvt. Ltd.</strong> for all your building and infrastructure needs.
                                    Our team is ready to assist you with project inquiries, estimates, and expert guidance.
                                    Reach out via phone, email, or visit our office, and we’ll ensure your construction projects are handled with professionalism and care.
                                </p>

							</div>
							<div class="row">
                                <div class="col-lg-4">
                                    <div class="dez-accordion box-sort-in space active-bg contact-info accdown1" id="accordion001">
                                        <div class="panel">
                                            <div class="acod-head">
                                                <h6 class="acod-title">
                                                    <a data-toggle="collapse" data-target="#collapseOne001" class="collapsed" aria-expanded="false">Our Location</a>
                                                </h6>
                                            </div>
                                            <div id="collapseOne001" class="acod-body collapse show" data-parent="#accordion001">
                                                <div class="acod-content">
                                                    <ul class="info-link">
                                                        @if($siteSetting)
                                                            @if($siteSetting->address)
                                                            <li>
                                                                <div class="ic-bx">
                                                                    <i class="fa fa-home"></i>
                                                                </div>
                                                                <div class="add-bx">
                                                                    <p><b>Address:</b> {{ $siteSetting->address }}</p>
                                                                </div>
                                                            </li>
                                                            @endif

                                                            @if($siteSetting->primary_mobile_no)
                                                            <li>
                                                                <div class="ic-bx">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                                <div class="add-bx">
                                                                    <p><b>Call Us:</b> <br>{{ $siteSetting->primary_mobile_no }}
                                                                    @if($siteSetting->secondary_mobile_no)
                                                                        , {{ $siteSetting->secondary_mobile_no }}
                                                                    @endif
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            @endif

                                                            @if($siteSetting->primary_email)
                                                            <li>
                                                                <div class="ic-bx">
                                                                    <i class="fa fa-envelope"></i>
                                                                </div>
                                                                <div class="add-bx">
                                                                    <p><b>Mail Us:</b> <br>{{ $siteSetting->primary_email }}
                                                                    @if($siteSetting->secondary_email)
                                                                        , {{ $siteSetting->secondary_email }}
                                                                    @endif
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            @endif

                                                            <li>
                                                                <div class="ic-bx">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>
                                                                <div class="add-bx">
                                                                    <p><b>Opening Time:</b> <br>Mon - Sat: 09.00am to 18.00pm</p>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="align-self-stretch">
                                        @if($siteSetting && $siteSetting->embedded_map)
                                            {!! str_replace(
                                                ['width="600"', 'height="500"'],
                                                ['width="100%"', 'height="100%"'],
                                                $siteSetting->embedded_map
                                            ) !!}
                                        @else
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.38324904817!2d75.65012776138988!3d26.885447577280722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1540542287647" style="border:0; width: 100%; height: 450px;" allowfullscreen></iframe>
                                        @endif
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
						<div class="col-lg-12">
							<div class="section-head head-1">
								<h3>Send Your Message Us</h3>
								<div class="divider-sc"></div>
							</div>
                            <form class="form-design" method="POST" action="{{ route('contact.send') }}">
                                @csrf
                                <input type="hidden" value="Contact" name="dzToDo">
                                <div class="dzFormMsg"></div>
                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input name="name" type="text" value="{{ old('name') }}" required class="form-control" placeholder="Your Name">
                                            @error('name') <div style="color:red">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input name="email" type="email" value="{{ old('email') }}" class="form-control" required placeholder="Your Email Id">
                                            @error('email') <div style="color:red">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input name="mobile" type="text" value="{{ old('mobile') }}" class="form-control" required placeholder="Mobile No">
                                            @error('mobile') <div style="color:red">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input name="subject" type="text" value="{{ old('subject') }}" class="form-control" required placeholder="Subject">
                                            @error('subject') <div style="color:red">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <textarea name="message" rows="4" class="form-control" required placeholder="Your Message...">{{ old('message') }}</textarea>
                                            @error('message') <div style="color:red">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    <!-- REMOVED reCAPTCHA SECTION -->

                                    <div class="col-md-12 col-sm-12 col-12 m-b30">
                                        <button name="submit" type="submit" value="Submit" class="site-button w-100"> <span>Submit</span> </button>
                                    </div>
                                </div>
                            </form>

						</div>

					</div>
				</div>
			</div>
		<!-- content area end -->
		</div>
	</div>
	<!-- content-end -->
 @endsection