<div class="modal fade" id="addCategoryProductModal" tabindex="-1" aria-labelledby="addCategoryProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formCategoryProduct">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryProductModalLabel">Tambah Categori Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none me-1" role="status" id="spinner"
                            aria-hidden="true"></span>
                        <span id="submitBtnText">Simpan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
