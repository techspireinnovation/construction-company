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
                        <h4 class="mb-sm-0">Edit FAQ</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.faqs.index') }}">FAQs</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit FAQ</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.faqs.update', $faq->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <!-- Question -->
                                    <div class="col-md-6">
                                        <label class="form-label">Question</label>
                                        <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question', $faq->question) }}" required>
                                        @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Answer -->
                                    <div class="col-md-6">
                                        <label class="form-label">Answer</label>
                                        <textarea name="answer" rows="2" class="form-control @error('answer') is-invalid @enderror" required>{{ old('answer', $faq->answer) }}</textarea>
                                        @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mt-3">
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', $faq->status) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="hstack gap-2 justify-content-end mt-4">
                                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-success">Update FAQ</button>
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
