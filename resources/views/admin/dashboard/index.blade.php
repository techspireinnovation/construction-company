@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Admin Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row project-wrapper">
                <div class="col-xxl-12">
                    <div class="row">
                        <!-- Blogs Count -->
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i data-feather="file-text" class="text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Blogs</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $blogCount }}</h4>
                                                @php $blogChange = $stats['blog']['change'] ?? 0; @endphp
                                                @if($blogChange > 0)
                                                    <span class="badge bg-success-subtle text-success fs-12">
                                                        <i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($blogChange, 1) }}%
                                                    </span>
                                                @elseif($blogChange < 0)
                                                    <span class="badge bg-danger-subtle text-danger fs-12">
                                                        <i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>{{ number_format(abs($blogChange), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary fs-12">
                                                        <i class="ri-minus-line fs-13 align-middle me-1"></i>0%
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted text-truncate mb-0">Active blogs</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <!-- Portfolios Count -->
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i data-feather="briefcase" class="text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-medium text-muted mb-3">Total Projects</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $portfolioCount }}</h4>
                                                @php $portfolioChange = $stats['portfolio']['change'] ?? 0; @endphp
                                                @if($portfolioChange > 0)
                                                    <span class="badge bg-success-subtle text-success fs-12">
                                                        <i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($portfolioChange, 1) }}%
                                                    </span>
                                                @elseif($portfolioChange < 0)
                                                    <span class="badge bg-danger-subtle text-danger fs-12">
                                                        <i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>{{ number_format(abs($portfolioChange), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary fs-12">
                                                        <i class="ri-minus-line fs-13 align-middle me-1"></i>0%
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted mb-0">Active projects</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <!-- Services Count -->
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i data-feather="layers" class="text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Services</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $serviceCount }}</h4>
                                                @php $serviceChange = $stats['service']['change'] ?? 0; @endphp
                                                @if($serviceChange > 0)
                                                    <span class="badge bg-success-subtle text-success fs-12">
                                                        <i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($serviceChange, 1) }}%
                                                    </span>
                                                @elseif($serviceChange < 0)
                                                    <span class="badge bg-danger-subtle text-danger fs-12">
                                                        <i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>{{ number_format(abs($serviceChange), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary fs-12">
                                                        <i class="ri-minus-line fs-13 align-middle me-1"></i>0%
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted text-truncate mb-0">Active services</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <!-- Team Members Count -->
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i data-feather="users" class="text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Team Members</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $teamCount }}</h4>
                                                @php $teamChange = $stats['team']['change'] ?? 0; @endphp
                                                @if($teamChange > 0)
                                                    <span class="badge bg-success-subtle text-success fs-12">
                                                        <i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($teamChange, 1) }}%
                                                    </span>
                                                @elseif($teamChange < 0)
                                                    <span class="badge bg-danger-subtle text-danger fs-12">
                                                        <i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>{{ number_format(abs($teamChange), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary fs-12">
                                                        <i class="ri-minus-line fs-13 align-middle me-1"></i>0%
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted text-truncate mb-0">Active team members</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <!-- Additional Stats Row -->
                    <div class="row mt-4">
                        <!-- Contact Submissions -->
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                                <i data-feather="mail" class="text-info"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Contact Inquiries</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $contactCount }}</h4>
                                                @php $contactChange = $stats['contact']['change'] ?? 0; @endphp
                                                @if($contactChange > 0)
                                                    <span class="badge bg-success-subtle text-success fs-12">
                                                        <i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($contactChange, 1) }}%
                                                    </span>
                                                @elseif($contactChange < 0)
                                                    <span class="badge bg-danger-subtle text-danger fs-12">
                                                        <i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>{{ number_format(abs($contactChange), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary fs-12">
                                                        <i class="ri-minus-line fs-13 align-middle me-1"></i>0%
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted text-truncate mb-0">New inquiries this month</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <!-- Testimonials Count -->
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                                <i data-feather="message-square" class="text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Testimonials</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $testimonialCount }}</h4>
                                                @php $testimonialChange = $stats['testimonial']['change'] ?? 0; @endphp
                                                @if($testimonialChange > 0)
                                                    <span class="badge bg-success-subtle text-success fs-12">
                                                        <i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($testimonialChange, 1) }}%
                                                    </span>
                                                @elseif($testimonialChange < 0)
                                                    <span class="badge bg-danger-subtle text-danger fs-12">
                                                        <i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>{{ number_format(abs($testimonialChange), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary fs-12">
                                                        <i class="ri-minus-line fs-13 align-middle me-1"></i>0%
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted text-truncate mb-0">Active testimonials</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <!-- Gallery Images Count -->
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle text-success rounded-2 fs-2">
                                                <i data-feather="image" class="text-success"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Gallery Images</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $galleryCount }}</h4>
                                                @php $galleryChange = $stats['gallery']['change'] ?? 0; @endphp
                                                @if($galleryChange > 0)
                                                    <span class="badge bg-success-subtle text-success fs-12">
                                                        <i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($galleryChange, 1) }}%
                                                    </span>
                                                @elseif($galleryChange < 0)
                                                    <span class="badge bg-danger-subtle text-danger fs-12">
                                                        <i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>{{ number_format(abs($galleryChange), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary fs-12">
                                                        <i class="ri-minus-line fs-13 align-middle me-1"></i>0%
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted text-truncate mb-0">Active gallery items</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <!-- Careers Count -->
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-danger-subtle text-danger rounded-2 fs-2">
                                                <i data-feather="briefcase" class="text-danger"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Career Openings</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $careerCount }}</h4>
                                                @php $careerChange = $stats['career']['change'] ?? 0; @endphp
                                                @if($careerChange > 0)
                                                    <span class="badge bg-success-subtle text-success fs-12">
                                                        <i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($careerChange, 1) }}%
                                                    </span>
                                                @elseif($careerChange < 0)
                                                    <span class="badge bg-danger-subtle text-danger fs-12">
                                                        <i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>{{ number_format(abs($careerChange), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary fs-12">
                                                        <i class="ri-minus-line fs-13 align-middle me-1"></i>0%
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted text-truncate mb-0">Active job positions</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <!-- Recent Blogs Table -->
                <div class="col-xl-7">
                    <div class="card card-height-100">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="card-title flex-grow-1 mb-0">Recent Blogs</h4>
                            <div class="flex-shrink-0">
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-soft-secondary btn-sm">View All</a>
                            </div>
                        </div><!-- end cardheader -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap table-centered align-middle">
                                    <thead class="bg-light text-muted">
                                        <tr>
                                            <th scope="col">Blog Title</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" style="width: 10%;">Created Date</th>
                                        </tr><!-- end tr -->
                                    </thead><!-- thead -->

                                    <tbody>
                                        @forelse($recentBlogs as $blog)
                                        <tr>
                                            <td class="fw-medium">
                                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-reset">
                                                    {{ Str::limit($blog->title, 30) }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($blog->category)
                                                    <span class="badge bg-primary-subtle text-primary">{{ $blog->category->title }}</span>
                                                @else
                                                    <span class="text-muted">No Category</span>
                                                @endif
                                            </td>
                                            <td>{{ $blog->written_by ?? 'Admin' }}</td>
                                            <td>
                                                @if($blog->status)
                                                    <span class="badge bg-success-subtle text-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $blog->created_at->format('d M Y') }}</td>
                                        </tr><!-- end tr -->
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">No blogs found</td>
                                        </tr>
                                        @endforelse
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>

                            <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                                <div class="flex-shrink-0">
                                    <div class="text-muted">Showing <span class="fw-semibold">{{ min(5, $blogCount) }}</span> of <span class="fw-semibold">{{ $blogCount }}</span> Blogs
                                    </div>
                                </div>
                            </div>

                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <!-- Recent Contact Submissions -->
                <div class="col-xl-5">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1 py-1">Recent Contact Inquiries</h4>
                            <div class="flex-shrink-0">
                                <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-soft-secondary btn-sm">View All</a>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-nowrap table-centered align-middle mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @forelse($recentContacts as $contact)
                                        <tr>
                                            <td>
                                                <div class="fw-medium">{{ $contact->name }}</div>
                                            </td>
                                            <td class="text-muted">{{ $contact->email }}</td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 150px;" title="{{ $contact->subject }}">
                                                    {{ Str::limit($contact->subject, 20) }}
                                                </div>
                                            </td>
                                            <td class="text-muted">{{ $contact->created_at->format('d M') }}</td>
                                        </tr><!-- end -->
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">No contact inquiries yet</td>
                                        </tr>
                                        @endforelse
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>

                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <!-- Additional Statistics Row -->
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Content Statistics</h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="p-3 border border-dashed border-primary-subtle rounded-3">
                                        <h5 class="mb-1">{{ $blogCategoryCount }}</h5>
                                        <p class="text-muted mb-0">Blog Categories</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border border-dashed border-success-subtle rounded-3">
                                        <h5 class="mb-1">{{ $portfolioCategoryCount }}</h5>
                                        <p class="text-muted mb-0">Project Categories</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border border-dashed border-warning-subtle rounded-3">
                                        <h5 class="mb-1">{{ $partnerCount }}</h5>
                                        <p class="text-muted mb-0">Partners</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Site Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="p-3 border border-dashed border-info-subtle rounded-3">
                                        <h5 class="mb-1">{{ $faqCount }}</h5>
                                        <p class="text-muted mb-0">FAQs</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border border-dashed border-danger-subtle rounded-3">
                                        <h5 class="mb-1">{{ $whyChooseUsCount }}</h5>
                                        <p class="text-muted mb-0">Why Choose Us</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border border-dashed border-secondary-subtle rounded-3">
                                        <h5 class="mb-1">{{ $pageCount }}</h5>
                                        <p class="text-muted mb-0">Active Pages</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@endsection