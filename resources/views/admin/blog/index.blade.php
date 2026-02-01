@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Partners List View</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('partners.index') }}">Partners</a></li>
                                <li class="breadcrumb-item active">List View</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="search-box">
                                <p class="text-muted">Search</p>
                                <div class="position-relative">
                                    <input type="text" class="form-control rounded bg-light border-light" placeholder="Search partners..." id="search-input">
                                    <i class="mdi mdi-magnify search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('partners.create') }}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end gap-2">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control" placeholder="Search partners..." id="filter-search-input">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                    <div class="row gx-4">
                        @if (empty($partners))
                            <div class="col-xxl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted text-center">No partners available</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($partners as $partner)
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row g-4">
                                                <div class="col-xxl-3 col-lg-5">
                                                    <img src="{{ asset($partner->image) }}" alt="{{ $partner->name }}" class="img-fluid rounded w-100 object-fit-cover">
                                                </div><!--end col-->
                                                <div class="col-xxl-9 col-lg-7">
                                                    <a href="{{ route('partners.show', $partner->id) }}">
                                                        <h5 class="fs-15 fw-semibold">{{ $partner->name }}</h5>
                                                    </a>
                                                    <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                                                        <span class="text-muted"><i class="ri-calendar-event-line me-1"></i> {{ \Carbon\Carbon::parse($partner->created_at)->format('d M, Y') }}</span> |
                                                        <span class="text-muted"><i class="ri-checkbox-circle-line me-1"></i> {{ $partner->status ? 'Active' : 'Inactive' }}</span>
                                                    </div>
                                                    <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('partners.destroy', $partner->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this partner?')">Delete</button>
                                                    </form>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div>
                                    </div>
                                </div><!--end col-->
                            @endforeach
                        @endif
                    </div><!--end row-->
                    <div class="row g-0 text-center text-sm-start align-items-center mb-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0 text-muted">Showing <span class="fw-semibold">{{ $partners->firstItem() }}</span> to <span class="fw-semibold">{{ $partners->lastItem() }}</span> of <span class="fw-semibold text-decoration-underline">{{ $partners->total() }}</span> entries</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                                <li class="page-item {{ $partners->onFirstPage() ? 'disabled' : '' }}">
                                    <a href="{{ $partners->previousPageUrl() }}" class="page-link">Previous</a>
                                </li>
                                @foreach ($partners->links()->elements[0] as $page => $url)
                                    <li class="page-item {{ $partners->currentPage() == $page ? 'active' : '' }}">
                                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item {{ $partners->hasMorePages() ? '' : 'disabled' }}>
                                    <a href="{{ $partners->nextPageUrl() }}" class="page-link">Next</a>
                                </li>
                            </ul>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!-- container-fluid -->
    </div><!-- End Page-content -->
</div>

@section('script')
    <!-- Tagify CSS -->
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <!-- Tagify JS -->
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script>
        // Initialize search input
        const searchInput = document.querySelector('#search-input');
        new Tagify(searchInput, {
            whitelist: [], // Can be populated with suggested search terms
            maxTags: 5,
            dropdown: {
                enabled: 0,
                maxItems: 10,
            },
        });

        // Filter partners by search
        document.querySelector('#search-input').addEventListener('change', function(e) {
            filterPartners();
        });

        document.querySelector('#filter-search-input').addEventListener('change', function(e) {
            filterPartners();
        });

        function filterPartners() {
            const searchTerms = document.querySelector('#search-input').value || document.querySelector('#filter-search-input').value;
            window.location.href = "{{ route('partners.index') }}?search=" + encodeURIComponent(searchTerms);
        }
    </script>
@endsection
@endsection