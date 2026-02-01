@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Create Partner</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('partners.index') }}">Partners</a></li>
                                <li class="breadcrumb-item active">Create Partner</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form id="partnerForm" action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="partner-name-input">Partner Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="partner-name-input" placeholder="Enter partner name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="partner-image-img">Partner Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" name="image" id="partner-image-img" type="file" accept="image/png,image/gif,image/jpeg">
                                    <img id="image-preview" class="img-fluid mt-2" style="max-height: 200px; display: none;" alt="Image Preview">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-4">
                            <button type="submit" class="btn btn-success w-sm">Create</button>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Status</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <label for="choices-status-input" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="choices-status-input">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

