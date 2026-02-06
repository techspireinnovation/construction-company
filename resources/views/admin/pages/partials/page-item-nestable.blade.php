@php
$types = [
    1 => 'Home', 2 => 'About Us', 3 => 'Services', 4 => 'Team',
    5 => 'Testimonial', 6 => 'Gallery', 7 => 'Portfolio', 8 => 'Blog',
    9 => 'Career', 10 => 'Contact'
];
@endphp

<li class="dd-item" data-id="{{ $page->id }}">
    <div class="dd-handle">
        <div class="page-info">
            <div class="page-title">
                <!-- Only this icon is draggable -->
                <i class="ri-drag-move-2-line drag-handle me-2" style="opacity: 0.5;"></i>
                <span>{{ $types[$page->type] ?? 'Unknown' }}</span>
                <span class="badge bg-{{ $page->status ? 'success' : 'secondary' }} ms-2">
                    {{ $page->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-primary">
                    <i class="ri-edit-line"></i> Edit
                </a>
            </div>
        </div>
    </div>


    @if($page->children && $page->children->count())
        <ol class="dd-list">
            @foreach($page->children as $child)
                @include('admin.pages.partials.page-item-nestable', ['page' => $child])
            @endforeach
        </ol>
    @endif
</li>