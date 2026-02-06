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
                        <h4 class="mb-sm-0">Profile</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Account</li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center bg-primary bg-opacity-10 border-bottom-0">
                            <div>
                                <h4 class="card-title mb-0 text-primary">
                                    <i class="ri-user-line align-middle me-2"></i>Profile Information
                                </h4>
                                <p class="text-muted mb-0 mt-1">Manage your account details</p>
                            </div>

                            <a href="{{ route('admin.profile.edit') }}"
                               class="btn btn-primary waves-effect waves-light">
                                <i class="ri-edit-2-line align-middle me-1"></i>
                                Edit Profile
                            </a>
                        </div>

                        <div class="card-body">

                            <!-- Profile Image -->
                            <div class="text-center mb-4">
                                @if(!empty($user?->profile_image))
                                    <img src="{{ asset('storage/'.$user->profile_image) }}"
                                         class="rounded-circle img-thumbnail"
                                         style="width:150px;height:150px;object-fit:cover;">
                                @else
                                    <img src="{{ asset('Backend/assets/images/users/avatar-2.jpg') }}"
                                         class="rounded-circle img-thumbnail"
                                         style="width:150px;height:150px;">
                                @endif
                            </div>


                            <!-- Name -->
                            <div class="mb-3">
                                <h5>Name</h5>
                                <div class="border rounded p-3 bg-light">
                                    {{ $user->name }}
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <h5>Email</h5>
                                <div class="border rounded p-3 bg-light">
                                    {{ $user->email }}
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="mt-3">
                                <small class="text-muted">
                                    Joined: {{ $user->created_at->format('M d, Y') }} |
                                    Updated: {{ $user->updated_at->format('M d, Y') }}
                                </small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
