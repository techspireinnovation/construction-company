<div class="modal fade" id="globalDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">

                <lord-icon
                    src="https://cdn.lordicon.com/gsqxdxog.json"
                    trigger="loop"
                    colors="primary:#dc3545,secondary:#f06548"
                    style="width:120px;height:120px">
                </lord-icon>

                <div class="mt-4">
                    <h4 class="mb-3">Confirm Deletion</h4>
                    <p class="text-muted mb-4" id="globalDeleteMessage"></p>

                    <div class="hstack gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger" id="globalConfirmDeleteBtn">
                            Yes, Delete
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
