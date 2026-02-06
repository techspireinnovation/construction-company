document.addEventListener("DOMContentLoaded", function () {
    const modalEl = document.getElementById("globalDeleteModal");
    if (!modalEl) return;

    const deleteModal = new bootstrap.Modal(modalEl);
    const deleteMessage = document.getElementById("globalDeleteMessage");
    const confirmBtn = document.getElementById("globalConfirmDeleteBtn");

    let deleteAction = null;

    /* =====================
       SINGLE DELETE
    ===================== */
    document.body.addEventListener("click", function (e) {
        const singleBtn = e.target.closest(".js-single-delete");
        if (!singleBtn) return;

        const form = singleBtn.closest("form");
        const message =
            singleBtn.dataset.message ||
            "Are you sure you want to delete this item?";

        deleteMessage.innerText = message;
        deleteAction = () => form.submit();

        deleteModal.show();
    });

    /* =====================
       BULK DELETE
    ===================== */
    document.body.addEventListener("click", function (e) {
        const bulkBtn = e.target.closest(".js-bulk-delete");
        if (!bulkBtn || bulkBtn.disabled) return;

        const checkboxSelector = bulkBtn.dataset.checkbox || ".chk-child";
        const actionUrl = bulkBtn.dataset.action;
        const csrf = bulkBtn.dataset.csrf;

        const checkedIds = Array.from(
            document.querySelectorAll(`${checkboxSelector}:checked`)
        ).map((cb) => cb.value);

        if (checkedIds.length === 0) return;

        deleteMessage.innerText = `Are you sure you want to delete ${checkedIds.length} item(s)?`;

        deleteAction = () => {
            const form = document.createElement("form");
            form.method = "POST";
            form.action = actionUrl;

            form.innerHTML = `
                <input type="hidden" name="_token" value="${csrf}">
                <input type="hidden" name="ids" value="${checkedIds.join(",")}">
            `;

            document.body.appendChild(form);
            form.submit();
        };

        deleteModal.show();
    });

    /* =====================
       CONFIRM BUTTON
    ===================== */
    confirmBtn.addEventListener("click", function () {
        if (deleteAction) deleteAction();
    });
});
