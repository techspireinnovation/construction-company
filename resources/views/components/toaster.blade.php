{{-- resources/views/components/toaster.blade.php --}}
@if ($errors->any() || session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info'))
    <div id="toast-container" class="toast-container">
        {{-- Validation Errors --}}
        @if ($errors->any())
            @foreach ($errors->all() as $index => $error)
                <div class="toast toast-error" data-index="{{ $index }}">
                    <div class="toast-content">
                        <i class="fas fa-exclamation-circle toast-icon"></i>
                        <div class="toast-message">
                            <strong>Validation Error:</strong> {{ $error }}
                        </div>
                    </div>
                    <button class="toast-close">&times;</button>
                </div>
            @endforeach
        @endif

        {{-- Session Messages --}}
        @php
            $sessionTypes = [
                'success' => ['icon' => 'fa-check-circle', 'color' => 'success'],
                'error' => ['icon' => 'fa-exclamation-circle', 'color' => 'error'],
                'warning' => ['icon' => 'fa-exclamation-triangle', 'color' => 'warning'],
                'info' => ['icon' => 'fa-info-circle', 'color' => 'info'],
                'primary' => ['icon' => 'fa-bell', 'color' => 'primary'],
                'secondary' => ['icon' => 'fa-bell', 'color' => 'secondary'],
                'light' => ['icon' => 'fa-bell', 'color' => 'light'],
                'payment-error' => ['icon' => 'fa-credit-card', 'color' => 'error'],
            ];
        @endphp

        @foreach($sessionTypes as $type => $config)
            @if(session()->has($type))
                <div class="toast toast-{{ $config['color'] }}">
                    <div class="toast-content">
                        <i class="fas {{ $config['icon'] }} toast-icon"></i>
                        <div class="toast-message">{{ session($type) }}</div>
                    </div>
                    <button class="toast-close">&times;</button>
                </div>
            @endif
        @endforeach
    </div>
@endif

<style>
/* Keep your existing styles */
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize if toasts exist
    const toastContainer = document.getElementById('toast-container');
    if (!toastContainer) return;

    const toasts = document.querySelectorAll('.toast');

    // Set animation delays
    toasts.forEach((toast, index) => {
        toast.style.setProperty('--toast-index', index);

        // Auto remove after 5 seconds
        const timeoutId = setTimeout(() => {
            removeToast(toast);
        }, 5000);

        // Store timeout ID for cleanup
        toast.dataset.timeoutId = timeoutId;

        // Click to dismiss
        const closeBtn = toast.querySelector('.toast-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                clearTimeout(timeoutId);
                removeToast(toast);
            });
        }

        // Click toast to dismiss (optional)
        toast.addEventListener('click', function(e) {
            if (!e.target.classList.contains('toast-close')) {
                clearTimeout(this.dataset.timeoutId);
                removeToast(this);
            }
        });

        // Hover pause
        toast.addEventListener('mouseenter', function() {
            clearTimeout(this.dataset.timeoutId);
        });

        toast.addEventListener('mouseleave', function() {
            clearTimeout(this.dataset.timeoutId);
            this.dataset.timeoutId = setTimeout(() => {
                removeToast(this);
            }, 2000);
        });
    });

    function removeToast(toastElement) {
        if (!toastElement.classList.contains('hide')) {
            toastElement.classList.add('hide');
            setTimeout(() => {
                if (toastElement.parentNode) {
                    toastElement.remove();
                    // If container is empty, remove it
                    if (toastContainer.children.length === 0) {
                        toastContainer.remove();
                    }
                }
            }, 300);
        }
    }

    // Close all toasts when clicking outside (optional)
    document.addEventListener('click', function(e) {
        if (toastContainer && !toastContainer.contains(e.target) && !e.target.closest('.toast')) {
            document.querySelectorAll('.toast').forEach(toast => {
                clearTimeout(toast.dataset.timeoutId);
                removeToast(toast);
            });
        }
    });
});
</script>