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
                        <h4 class="mb-sm-0">Edit Team Member</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.teams.index') }}">Team</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Team Member</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.teams.update', $team->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $team->name) }}" required>
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Designation</label>
                                        <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror"
                                            value="{{ old('designation', $team->designation) }}" required>
                                        @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Instagram Link</label>
                                        <input type="url" name="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror"
                                            value="{{ old('instagram_link', $team->instagram_link) }}">
                                        @error('instagram_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Facebook Link</label>
                                        <input type="url" name="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror"
                                            value="{{ old('facebook_link', $team->facebook_link) }}">
                                        @error('facebook_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">LinkedIn Link</label>
                                        <input type="url" name="linkedin_link" class="form-control @error('linkedin_link') is-invalid @enderror"
                                            value="{{ old('linkedin_link', $team->linkedin_link) }}">
                                        @error('linkedin_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <x-image-upload
                                            name="image"
                                            label="Team Image"
                                            value="{{ $team->image }}"
                                            inputId="team-image-input"
                                            previewId="team-image-preview"
                                            containerId="team-image-preview-container"
                                            removeBtnId="remove-team-image"
                                            maxWidth="150"
                                            maxHeight="150"
                                            :required="false"
                                            :error="$errors->first('image')"
                                            helpText="Upload team member image. Max size: 5MB."
                                        />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input" type="checkbox" name="status" value="1"
                                                {{ old('status', $team->status) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{ route('admin.teams.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update Team Member</button>
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
@endsection
