@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('_message')

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">About Section</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Homepage</li>
                                <li class="breadcrumb-item active">About</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Card -->
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary bg-opacity-10 border-bottom-0">
                            <div>
                                <h4 class="card-title mb-0 text-primary">
                                    <i class="ri-information-line align-middle me-2"></i>About Content
                                </h4>
                                <p class="text-muted mb-0 mt-1">Manage your homepage about section</p>
                            </div>
                            @if($about)
                                <a href="{{ route('admin.abouts.edit') }}" class="btn btn-primary waves-effect waves-light">
                                    <i class="ri-edit-2-line align-middle me-1"></i> Edit About
                                </a>
                            @else
                                <a href="{{ route('admin.abouts.create') }}" class="btn btn-success waves-effect waves-light">
                                    <i class="ri-add-line align-middle me-1"></i> Create About
                                </a>
                            @endif
                        </div>

                        <div class="card-body">
                            @if($about)
                                <!-- Title -->
                                <div class="mb-4">
                                    <h5 class="mb-2">Title</h5>
                                    <div class="border rounded p-3 bg-light">{{ $about->title }}</div>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <h5 class="mb-2">Description</h5>
                                    <div class="border rounded p-3 bg-light">{{ $about->description }}</div>
                                </div>

                               <!-- Mission & Vision Side by Side -->
<div class="mb-4">
    <div class="row">
        <!-- Mission -->
        <div class="col-lg-6 mb-3">
            <h5 class="mb-3">Mission</h5>
            @foreach(json_decode($about->mission, true) as $index => $mission)
                <div class="card border mb-3">
                    <div class="card-body text-center">
                        @if(!empty($mission['image']))
                            <img src="{{ asset('storage/'.$mission['image']) }}" class="img-fluid rounded mb-2" style="max-height:150px; width:100%; object-fit:cover;" alt="Mission {{ $index+1 }}">
                        @endif
                        <div class="border rounded p-2 bg-light">{{ $mission['content'] ?? '' }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Vision -->
        <div class="col-lg-6 mb-3">
            <h5 class="mb-3">Vision</h5>
            @foreach(json_decode($about->vision, true) as $index => $vision)
                <div class="card border mb-3">
                    <div class="card-body text-center">
                        @if(!empty($vision['image']))
                            <img src="{{ asset('storage/'.$vision['image']) }}" class="img-fluid rounded mb-2" style="max-height:150px; width:100%; object-fit:cover;" alt="Vision {{ $index+1 }}">
                        @endif
                        <div class="border rounded p-2 bg-light">{{ $vision['content'] ?? '' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


                                <!-- Stats -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Stats</h5>
                                    @php
                                        $stats = json_decode($about->stats, true) ?? [];
                                        $stats_labels = [
                                            'years_of_experience' => 'Years of Experience',
                                            'no_of_projects' => 'No. of Projects',
                                            'no_of_employees' => 'No. of Employees',
                                            'no_of_satisfied_clients' => 'No. of Satisfied Clients',
                                        ];
                                    @endphp
                                    <div class="row">
                                        @foreach($stats_labels as $key => $label)
                                            <div class="col-lg-3 mb-3">
                                                <div class="card border h-100 text-center p-3">
                                                    <h4 class="mb-1">{{ $stats[$key] ?? 0 }}</h4>
                                                    <p class="mb-0">{{ $label }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Created/Updated -->
                                <div class="mt-3">
                                    <small class="text-muted">
                                        Created: {{ $about->created_at->format('M d, Y') }} |
                                        Updated: {{ $about->updated_at->format('M d, Y') }}
                                    </small>
                                </div>

                            @else
                                <!-- Empty State -->
                                <div class="text-center py-5">
                                    <div class="mb-4">
                                        <i class="ri-information-line display-1 text-muted"></i>
                                    </div>
                                    <h4 class="mb-3">No About Section Created</h4>
                                    <p class="text-muted mb-4">Your homepage about section is currently empty. Add content to introduce your website or company.</p>
                                    <div class="mt-4">
                                        <a href="{{ route('admin.abouts.create') }}" class="btn btn-primary btn-lg">
                                            <i class="ri-add-line align-middle me-1"></i> Create About Section
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
