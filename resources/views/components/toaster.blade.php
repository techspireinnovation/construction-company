{{-- resources/views/components/toaster.blade.php --}}
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
        @if(session($type))
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

<style>
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 400px;
    max-height: 80vh;
    overflow-y: auto;
    padding-right: 5px;
}

.toast {
    padding: 16px 20px;
    border-radius: 8px;
    color: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    opacity: 0;
    animation: slideIn 0.3s ease-out forwards;
    transition: all 0.3s ease;
    cursor: pointer;
    border-left: 4px solid;
    position: relative;
    overflow: hidden;
}

.toast::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: rgba(255,255,255,0.2);
    animation: progressBar 5s linear forwards;
}

.toast-content {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    flex: 1;
}

.toast-icon {
    font-size: 18px;
    margin-top: 2px;
}

.toast-message {
    flex: 1;
    font-size: 14px;
    line-height: 1.4;
}

.toast-message strong {
    display: block;
    margin-bottom: 4px;
    font-weight: 600;
}

.toast-close {
    background: transparent;
    border: none;
    color: rgba(255,255,255,0.8);
    font-size: 20px;
    line-height: 1;
    cursor: pointer;
    padding: 0;
    margin-left: 10px;
    transition: color 0.2s;
}

.toast-close:hover {
    color: #fff;
}

/* Colors */
.toast-success {
    background: linear-gradient(135deg, #28a745, #218838);
    border-left-color: #1e7e34;
}

.toast-error {
    background: linear-gradient(135deg, #dc3545, #c82333);
    border-left-color: #bd2130;
}

.toast-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
    border-left-color: #d39e00;
}

.toast-warning .toast-close {
    color: rgba(33,37,41,0.8);
}

.toast-warning .toast-close:hover {
    color: #212529;
}

.toast-info {
    background: linear-gradient(135deg, #17a2b8, #138496);
    border-left-color: #117a8b;
}

.toast-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border-left-color: #004085;
}

.toast-secondary {
    background: linear-gradient(135deg, #6c757d, #545b62);
    border-left-color: #3d4348;
}

.toast-light {
    background: linear-gradient(135deg, #f8f9fa, #e2e6ea);
    color: #212529;
    border-left-color: #dae0e5;
}

.toast-light .toast-close {
    color: rgba(33,37,41,0.8);
}

.toast-light .toast-close:hover {
    color: #212529;
}

/* Stagger animation */
.toast { animation-delay: calc(var(--toast-index, 0) * 0.1s); }

/* Animations */
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes progressBar {
    from { width: 100%; }
    to { width: 0%; }
}

.toast.hide {
    animation: slideOut 0.3s ease-out forwards;
}

@keyframes slideOut {
    to {
        transform: translateX(100%);
        opacity: 0;
        max-height: 0;
        padding: 0;
        margin: 0;
    }
}

/* Custom scrollbar */
.toast-container::-webkit-scrollbar {
    width: 6px;
}

.toast-container::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.toast-container::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 10px;
}

.toast-container::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.3);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toastContainer = document.getElementById('toast-container');
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
        toast.addEventListener('click', function(e) {
            if (!e.target.classList.contains('toast-close')) {
                return;
            }
            clearTimeout(timeoutId);
            removeToast(this);
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
                }
            }, 300);
        }
    }

    // Close all toasts when clicking outside (optional)
    document.addEventListener('click', function(e) {
        if (!toastContainer.contains(e.target) && !e.target.closest('.toast')) {
            document.querySelectorAll('.toast').forEach(toast => {
                clearTimeout(toast.dataset.timeoutId);
                removeToast(toast);
            });
        }
    });
});
</script>