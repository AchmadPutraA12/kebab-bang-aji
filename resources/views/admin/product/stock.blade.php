<div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formStock">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStockModalLabel">Edit Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="stockInput" class="form-label">Stock <span class="text-danger">*</span></label>
                        <input type="text" name="stock" class="form-control" required id="stockInput"
                            autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Penanggung Jawab</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- Pilih Penanggung Jawab --</option>
                            @foreach ($users as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="mode" class="form-label">Mode Update</label>
                        <select name="mode" class="form-select" id="mode">
                            <option value="set">Input Stock</option>
                            <option value="retur">Return Stock</option>
                        </select>
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
