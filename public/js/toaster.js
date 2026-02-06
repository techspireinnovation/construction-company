// public/js/toaster.js
document.addEventListener("DOMContentLoaded", function () {
    const toastElList = document.querySelectorAll(".toast");

    toastElList.forEach((toastEl, index) => {
        setTimeout(() => {
            const toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 5000,
            });

            toast.show();

            // Remove toast from DOM after it hides
            toastEl.addEventListener("hidden.bs.toast", function () {
                this.remove();

                // Remove container if no toasts remain
                if (document.querySelectorAll(".toast").length === 0) {
                    const container =
                        document.querySelector(".toast-container");
                    if (container) container.remove();
                }
            });
        }, index * 120); // small stagger so multiple toasts don't overlap
    });
});
