@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('_message')

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Pages SEO</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
                                <li class="breadcrumb-item active">SEO List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-0">Manage Page SEO</h4>
                                @if(!$allTypesAdded)
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="ri-add-line align-bottom me-1"></i> Add Page
    </a>
@endif

                            </div>
                        </div>

                        <div class="card-body">
                            <p class="text-muted">Drag and drop items to reorder. Drop items into each other to create nesting.</p>

                            <!-- Nestable Container -->
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    @foreach($pages->where('parent_id', null) as $page)
                                        @include('admin.pages.partials.page-item-nestable', ['page' => $page])
                                    @endforeach
                                </ol>
                            </div>

                            <div class="mt-4">
                               <!-- Add a hidden form -->
<form id="order-form" method="POST" action="{{ route('admin.pages.update-order') }}">
    @csrf
    <input type="hidden" name="order" id="order-input">
</form>

<!-- Update your button -->
<button type="button" class="btn btn-success" id="save-order-btn">
    <i class="ri-save-line align-bottom me-1"></i> Save Order
</button>
             </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css" rel="stylesheet">
<style>
    .invalid-feedback:empty { display: none; }

    /* Nestable custom styling */
    .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        max-width: 100%;
        list-style: none;
        font-size: 13px;
        line-height: 20px;
    }

    .dd-list {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .dd-item {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        min-height: 20px;
        font-size: 13px;
        line-height: 20px;
    }

    .dd-handle {
        display: block;
        height: auto;
        margin: 5px 0;
        padding: 12px 15px;
        background: #fff;
        border: 1px solid #e9ebec;
        border-radius: 5px;
        cursor: move;
        transition: all 0.2s ease;
    }

    .dd-handle:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .dd-item > .dd-handle {
        font-weight: 500;
    }

    .dd-item > button {
        margin-left: 30px;
    }

    .dd-item > .dd-list {
        margin-left: 30px;
        padding-left: 15px;
        border-left: 2px dashed #dee2e6;
    }

    .dd-empty,
    .dd-placeholder {
        margin: 5px 0;
        padding: 0;
        min-height: 30px;
        background: #f2fbff;
        border: 1px dashed #b6bcbf;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .dd-dragel {
        position: absolute;
        pointer-events: none;
        z-index: 9999;
    }

    .dd-dragel > .dd-item .dd-handle {
        margin-top: 0;
    }

    .dd-dragel .dd-handle {
        box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
    }

    /* Loading spinner */
    .spinner {
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Status badges */
    .badge {
        font-size: 0.75em;
        padding: 0.25em 0.6em;
    }

    /* Page info */
    .page-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .page-title {
        font-weight: 500;
        color: #343a40;
    }

    .page-meta {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .page-actions {
        display: flex;
        gap: 5px;
    }
</style>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize nestable
    $('#nestable').nestable({
    group: 1,
    maxDepth: 5,
    expandBtnHTML: '',
    collapseBtnHTML: '',
    handleClass: 'drag-handle'
});


    // Function to get the serialized output
    function getNestedOutput() {
        return $('#nestable').nestable('serialize');
    }

    // Function to update the hierarchy structure
    function updateHierarchy() {
        const output = getNestedOutput();
        console.log('Current hierarchy:', output);
        return output;
    }

    $('#save-order-btn').on('click', function(e) {
    e.preventDefault();

    const order = $('#nestable').nestable('serialize');
    $('#order-input').val(JSON.stringify(order));
    $('#order-form').submit();
});

    // Optional: Add expand/collapse functionality
    $('.dd').on('click', '.dd-expand', function() {
        $(this).closest('.dd-item').toggleClass('dd-collapsed');
    });

    // Optional: Log changes in real-time
    $('.dd').on('change', function() {
        updateHierarchy();
    });
});
</script>
@endsection