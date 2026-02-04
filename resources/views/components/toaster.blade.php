{{-- resources/views/components/toaster.blade.php --}}
@props([
    'position' => 'top-0 end-0',  // Changed from 'top-end' to Bootstrap 5 classes
    'timeout' => 5000,
])

@if(session()->hasAny(['success', 'error', 'warning', 'info']) || $errors->any())
<div class="toast-container position-fixed p-3" style="z-index: 9999; {{ $position === 'top-0 end-0' ? 'top: 0; right: 0;' : 'top: 0; left: 0;' }}">

    @if(session('success'))
        <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="{{ $timeout }}">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="ri-checkbox-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="{{ $timeout }}">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="ri-error-warning-fill me-2"></i>
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('warning'))
        <div class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="{{ $timeout }}">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="ri-alert-fill me-2"></i>
                    {{ session('warning') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="toast align-items-center text-bg-info border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="{{ $timeout }}">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="ri-information-fill me-2"></i>
                    {{ session('info') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if($errors->any())
    @foreach($errors->all() as $error)
        <div class="toast align-items-center text-bg-danger border-0 mb-2"
             role="alert"
             aria-live="assertive"
             aria-atomic="true"
             data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="ri-error-warning-fill me-2"></i>
                    {{ $error }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endforeach
@endif


</div>
@endif