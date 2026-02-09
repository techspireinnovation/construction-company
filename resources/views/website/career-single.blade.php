@extends('layouts.frontend.master')

@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>{{ $career->job_title ?? $meta_title }}</title>

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
@section('style')
<style>
    p {
    color: #000000;
    }
</style>
@endsection

@section('content')
<div class="page-content">

    {{-- Banner + Breadcrumb --}}
    @php
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('web.home')],
            ['label' => 'Career', 'url' => route('web.career')],
            ['label' => $career->job_title]
        ];
    @endphp

    <x-page-banner
        :title="$career->job_title"
        :banner="$career->banner_image
            ? asset('storage/' . $career->banner_image)
            : asset('Website/images/background/image-1.jpg')"
        :breadcrumbs="$breadcrumbs"
    />


    {{-- Career Details --}}
    <div class="section-full content-inner-3 single-service">
        <div class="container">
            <div class="row">

                {{-- Sidebar --}}
                <div class="col-lg-4 col-xl-3 m-b30">
                    <div class="side-link-service">
                        <ul class="service-list">

                            <li>
                                <a href="{{ route('web.career') }}">
                                    View All Careers
                                </a>
                                <span class="fa fa-briefcase"></span>
                            </li>

                            @php
                                $allCareers = App\Models\Career::where('status',1)
                                    ->whereNull('deleted_at')
                                    ->latest()
                                    ->get();
                            @endphp

                            @forelse($allCareers as $sidebarCareer)
                                <li class="{{ $sidebarCareer->id == $career->id ? 'active' : '' }}">
                                    <a href="{{ route('web.career.single', $sidebarCareer->slug) }}">
                                        {{ $sidebarCareer->job_title }}
                                    </a>
                                </li>
                            @empty
                                <li class="active">
                                    <a href="#">No Careers Found</a>
                                </li>
                            @endforelse

                        </ul>
                    </div>
                </div>


                {{-- Right Content --}}
                <div class="col-lg-8 col-xl-9">
                    <div class="right-side">

                        {{-- Banner / Image --}}
                        <div class="space">
                            <img
                                src="{{ $career->banner_image
                                    ? asset('storage/'.$career->banner_image)
                                    : asset('Website/images/service/service-1.jpg') }}"
                                alt="{{ $career->job_title }}"
                            >
                        </div>


                        {{-- Title --}}
                        <div class="section-head">
                            <h2>{{ $career->job_title }}</h2>
                            <div class="divider-sc"></div>
                        </div>


                        {{-- Short Summary --}}
                        @if($career->short_summery)
                            <p class="lead">
                                {{ $career->short_summery }}
                            </p>
                        @endif


                        {{-- Description --}}
                        <div class="m-b30">
                            {!! $career->description !!}
                        </div>


                        {{-- Requirements (SAFE FIX) --}}
                        @if(!empty($career->requirements))

                            @php
                                $requirements = is_array($career->requirements)
                                    ? $career->requirements
                                    : json_decode($career->requirements, true);
                            @endphp

                            @if(!empty($requirements))
                                <div class="m-b30">
                                    <h4>Requirements</h4>
                                    <ul class="list-check">
                                        @foreach($requirements as $req)
                                            <li>{{ $req }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        @endif


                        {{-- Responsibilities (SAFE FIX) --}}
                        @if(!empty($career->responsibilities))

                            @php
                                $responsibilities = is_array($career->responsibilities)
                                    ? $career->responsibilities
                                    : json_decode($career->responsibilities, true);
                            @endphp

                            @if(!empty($responsibilities))
                                <div class="m-b30">
                                    <h4>Responsibilities</h4>
                                    <ul class="list-check">
                                        @foreach($responsibilities as $res)
                                            <li>{{ $res }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        @endif


                        {{-- Job Info --}}
                        <div class="job-info-box p-4 bg-light">

                            <h4 class="m-b15">Job Information</h4>

                            <ul class="list-unstyled">

                                @if($career->employment_type)
                                    <li><b>Employment Type:</b>
                                        {{ \App\Helpers\CareerHelper::employmentType($career->employment_type) ?? '—' }}
                                    </li>
                                @endif

                                @if($career->experience_required)
                                    <li><b>Experience:</b>
                                        {{ $career->experience_required }}
                                    </li>
                                @endif

                                @if($career->education_level)
                                    <li><b>Education:</b>
                                        {{ \App\Helpers\CareerHelper::educationLevel($career->education_level) ?? '—' }}
                                    </li>
                                @endif

                                @if($career->salary_range)
                                    <li><b>Salary:</b>
                                        {{ $career->salary_range }}
                                    </li>
                                @endif

                                @if($career->application_deadline)
                                    <li><b>Deadline:</b>
                                        {{ $career->application_deadline->format('M d, Y') }}
                                    </li>
                                @endif

                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
