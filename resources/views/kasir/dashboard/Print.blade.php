<!-- Modal Print -->
<div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printModalLabel">Mencetak Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Transaksi Sedang Diproses untuk Dicetak...</strong></p>

                <!-- Konten Transaksi yang Akan Dicetak -->
                <div id="receiptContent">
                    <p><strong>ID Transaksi: </strong><span id="transaction_id">TX-123456789</span></p> <!-- ID Transaksi -->
                    <p><strong>Item: </strong><span id="item_name">Kebab XL</span></p>
                    <p><strong>Jumlah: </strong><span id="quantity">2</span></p>
                    <p><strong>Total Harga: </strong><span id="total_price">Rp. 34.000</span></p>
                    <p><strong>Pembayaran: </strong><span id="payment">Rp. 100.000</span></p>
                    <p><strong>Kembalian: </strong><span id="change">Rp. 66.000</span></p>
                    <p><strong>Tanggal: </strong><span id="date">01/02/2025, 14:30:00</span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="printReceipt">Print</button>
                <button type="button" class="btn btn-success" id="backToMain" style="display:none;">Kembali ke Halaman Utama</button>
            </div>
        </div>
    </div>
</div>
