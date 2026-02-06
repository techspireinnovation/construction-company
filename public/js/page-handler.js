// Reusable table management module
class TableManager {
    constructor(config = {}) {
        // Configuration with defaults
        this.config = {
            tableId: "serviceTable",
            searchInputId: "search-input",
            noResultClass: "noresult",
            checkAllId: "checkAll",
            childCheckboxClass: ".chk-child",
            bulkDeleteBtnId: "delete-multiple-btn",
            searchColumns: [".title", ".short_description"],
            rowSelector: "tbody tr",
            ...config,
        };

        this.initialize();
    }

    initialize() {
        this.cacheElements();
        this.bindEvents();
        this.updateBulkDeleteButton();
    }

    cacheElements() {
        this.table = document.getElementById(this.config.tableId);
        this.searchInput = document.getElementById(this.config.searchInputId);
        this.noResultElement = document.querySelector(
            `.${this.config.noResultClass}`
        );
        this.checkAll = document.getElementById(this.config.checkAllId);
        this.bulkDeleteBtn = document.getElementById(
            this.config.bulkDeleteBtnId
        );
        this.childCheckboxes = document.querySelectorAll(
            this.config.childCheckboxClass
        );
        this.rows = this.table
            ? this.table.querySelectorAll(this.config.rowSelector)
            : [];
    }

    bindEvents() {
        // Search functionality
        if (this.searchInput) {
            this.searchInput.addEventListener("input", (e) =>
                this.handleSearch(e)
            );
        }

        // Bulk selection
        if (this.checkAll) {
            this.checkAll.addEventListener("change", (e) =>
                this.handleCheckAll(e)
            );
        }

        // Individual checkbox changes
        this.childCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () =>
                this.handleCheckboxChange()
            );
        });
    }

    handleSearch(event) {
        const searchTerm = event.target.value.toLowerCase().trim();
        let hasResults = false;

        this.rows.forEach((row) => {
            let rowMatches = false;

            // Check each configured search column
            this.config.searchColumns.forEach((columnSelector) => {
                const column = row.querySelector(columnSelector);
                if (
                    column &&
                    column.textContent.toLowerCase().includes(searchTerm)
                ) {
                    rowMatches = true;
                }
            });

            if (rowMatches) {
                row.style.display = "";
                hasResults = true;
            } else {
                row.style.display = "none";
            }
        });

        // Show/hide no results message
        if (this.noResultElement) {
            this.noResultElement.style.display = hasResults ? "none" : "block";
        }
    }

    handleCheckAll(event) {
        const isChecked = event.target.checked;
        this.childCheckboxes.forEach((checkbox) => {
            checkbox.checked = isChecked;
        });
        this.updateBulkDeleteButton();
    }

    handleCheckboxChange() {
        // If all checkboxes are manually checked, update "check all" checkbox
        if (this.checkAll) {
            const allChecked = Array.from(this.childCheckboxes).every(
                (cb) => cb.checked
            );
            const someChecked = Array.from(this.childCheckboxes).some(
                (cb) => cb.checked
            );

            this.checkAll.checked = allChecked;
            this.checkAll.indeterminate = someChecked && !allChecked;
        }

        this.updateBulkDeleteButton();
    }

    updateBulkDeleteButton() {
        if (!this.bulkDeleteBtn) return;

        const checkedCount = Array.from(this.childCheckboxes).filter(
            (cb) => cb.checked
        ).length;
        this.bulkDeleteBtn.disabled = checkedCount === 0;

        // Optional: Update button text with count
        if (this.config.showCountOnButton) {
            this.bulkDeleteBtn.innerHTML =
                checkedCount > 0
                    ? `<i class="ri-delete-bin-2-line"></i> Delete (${checkedCount})`
                    : '<i class="ri-delete-bin-2-line"></i> Delete';
        }
    }

    getSelectedIds() {
        return Array.from(this.childCheckboxes)
            .filter((cb) => cb.checked)
            .map((cb) => cb.value);
    }

    // Static method to easily initialize with defaults
    static init(config = {}) {
        return new TableManager(config);
    }
}

// Reusable delete confirmation module
class DeleteHandler {
    constructor() {
        this.confirmModal = document.getElementById("deleteConfirmModal");
        this.confirmBtn = document.getElementById("confirmDeleteBtn");
        this.cancelBtn = document.getElementById("cancelDeleteBtn");
        this.modalMessage = document.getElementById("deleteModalMessage");

        this.currentForm = null;
        this.currentBulkAction = null;
        this.currentCsrf = null;

        this.initialize();
    }

    initialize() {
        this.bindEvents();
    }

    bindEvents() {
        // Single delete buttons
        document.querySelectorAll(".js-single-delete").forEach((button) => {
            button.addEventListener("click", (e) => this.handleSingleDelete(e));
        });

        // Bulk delete button
        const bulkDeleteBtn = document.getElementById("delete-multiple-btn");
        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener("click", (e) =>
                this.handleBulkDelete(e)
            );
        }

        // Modal buttons
        if (this.confirmBtn) {
            this.confirmBtn.addEventListener("click", () =>
                this.executeDelete()
            );
        }

        if (this.cancelBtn) {
            this.cancelBtn.addEventListener("click", () => this.hideModal());
        }

        // Close modal on background click or escape
        if (this.confirmModal) {
            this.confirmModal.addEventListener("click", (e) => {
                if (e.target === this.confirmModal) {
                    this.hideModal();
                }
            });

            document.addEventListener("keydown", (e) => {
                if (
                    e.key === "Escape" &&
                    this.confirmModal.classList.contains("show")
                ) {
                    this.hideModal();
                }
            });
        }
    }

    handleSingleDelete(event) {
        event.preventDefault();

        const button = event.currentTarget;
        const form = button.closest("form");
        const message =
            button.getAttribute("data-message") ||
            "Are you sure you want to delete this item?";

        this.currentForm = form;
        this.currentBulkAction = null;

        this.showModal(message);
    }

    handleBulkDelete(event) {
        event.preventDefault();

        const button = event.currentTarget;
        const tableManager = window.tableManager; // Assuming TableManager is initialized globally

        if (!tableManager || button.disabled) return;

        const selectedIds = tableManager.getSelectedIds();

        if (selectedIds.length === 0) return;

        const message = `Are you sure you want to delete ${selectedIds.length} selected item(s)?`;
        const action = button.getAttribute("data-action");
        const csrf = button.getAttribute("data-csrf");

        this.currentForm = null;
        this.currentBulkAction = { action, csrf, ids: selectedIds };

        this.showModal(message);
    }

    showModal(message) {
        if (this.modalMessage) {
            this.modalMessage.textContent = message;
        }

        if (this.confirmModal) {
            this.confirmModal.classList.add("show");
            this.confirmModal.style.display = "block";
        }
    }

    hideModal() {
        if (this.confirmModal) {
            this.confirmModal.classList.remove("show");
            this.confirmModal.style.display = "none";
        }

        this.currentForm = null;
        this.currentBulkAction = null;
    }

    async executeDelete() {
        if (this.currentForm) {
            // Single delete
            this.currentForm.submit();
        } else if (this.currentBulkAction) {
            // Bulk delete via AJAX
            await this.performBulkDelete();
        }

        this.hideModal();
    }

    async performBulkDelete() {
        const { action, csrf, ids } = this.currentBulkAction;

        try {
            const response = await fetch(action, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf,
                    Accept: "application/json",
                },
                body: JSON.stringify({ ids }),
            });

            const data = await response.json();

            if (response.ok) {
                // Reload page or update table
                window.location.reload();
            } else {
                alert(data.message || "Error deleting items");
            }
        } catch (error) {
            console.error("Delete error:", error);
            alert("An error occurred while deleting items");
        }
    }

    // Static method to easily initialize
    static init() {
        return new DeleteHandler();
    }
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Initialize TableManager with optional custom config
    window.tableManager = TableManager.init({
        // Custom configuration (optional)
        // tableId: 'serviceTable',
        // searchInputId: 'search-input',
        // showCountOnButton: true
    });

    // Initialize DeleteHandler
    DeleteHandler.init();
});

// Export for module usage (if using ES6 modules)
// export { TableManager, DeleteHandler };
