@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('components.toaster')

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Profile</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.profile.index') }}">Profile</a>
                                </li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Update Profile</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('admin.profile.update') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <!-- Name -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text"
                                               name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', $user->name ?? '') }}"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email"
                                               name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $user->email ?? '') }}"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                   <!-- OLD PASSWORD -->
<div class="col-md-4 mb-3">
    <label class="form-label">Old Password</label>

    <div class="input-group">
        <input type="password"
               name="old_password"
               id="old_password"
               class="form-control @error('old_password') is-invalid @enderror">

        <button type="button"
                class="btn btn-outline-secondary toggle-password"
                data-target="old_password">
            <i class="ri-eye-line"></i>
        </button>

        @error('old_password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


<!-- NEW PASSWORD -->
<div class="col-md-4 mb-3">
    <label class="form-label">New Password</label>

    <div class="input-group">
        <input type="password"
               name="password"
               id="password"
               class="form-control @error('password') is-invalid @enderror">

        <button type="button"
                class="btn btn-outline-secondary toggle-password"
                data-target="password">
            <i class="ri-eye-line"></i>
        </button>

        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


<!-- CONFIRM PASSWORD -->
<div class="col-md-4 mb-3">
    <label class="form-label">Confirm Password</label>

    <div class="input-group">
        <input type="password"
               name="password_confirmation"
               id="password_confirmation"
               class="form-control">

        <button type="button"
                class="btn btn-outline-secondary toggle-password"
                data-target="password_confirmation">
            <i class="ri-eye-line"></i>
        </button>
    </div>
</div>


                                    <!-- Profile Image -->
                                    <div class="col-md-6 mb-3">

                                        <x-image-upload
                                            name="profile_image"
                                            label="Profile Image"
                                            value="{{ $user->profile_image ?? '' }}"
                                            inputId="profile-image-input"
                                            previewId="profile-image-preview"
                                            containerId="profile-image-preview-container"
                                            removeBtnId="remove-profile-image"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('profile_image')"
                                            helpText="Upload profile image. Max size: 5MB."
                                        />

                                    </div>

                                </div>

                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.profile.index') }}"
                                       class="btn btn-light">
                                        Cancel
                                    </a>

                                    <button type="submit"
                                            class="btn btn-success">
                                        Update Profile
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/imagePreviewService.js') }}"></script>

<script>
document.querySelectorAll('.toggle-password').forEach(button => {

    button.addEventListener('click', function () {

        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        const icon = this.querySelector('i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('ri-eye-line');
            icon.classList.add('ri-eye-off-line');
        } else {
            input.type = "password";
            icon.classList.remove('ri-eye-off-line');
            icon.classList.add('ri-eye-line');
        }

    });

});
</script>
@endsection
