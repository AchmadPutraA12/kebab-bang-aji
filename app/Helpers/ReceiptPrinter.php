<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReceiptPrinter
{
    public static function print($invoice_number, $cart, $subtotal, $tax, $total, $payment, $change, $createdAt, $user)
    {
        $branchAddress = $user->branch?->address ?? 'Alamat tidak tersedia';
        $nameUser = $user->name ?? 'nama tidak tersedia';

        $html = '
        <html>
        <head>
            <title>Struk ' . $invoice_number . '</title>
            <style>
                @page {
                    size: 58mm auto; /* ubah ke 80mm jika printer kamu 80mm */
                    margin: 0;
                }
                body {
                    font-family: monospace;
                    font-size: 11px;
                    width: 58mm;
                    margin: 0 auto;
                    padding: 4px;
                    color: #000;
                }
                .center { text-align: center; }
                .line { border-top: 1px dashed #000; margin: 6px 0; }
                .right { text-align: right; display: block; width: 100%; }
                .item { display: flex; justify-content: space-between; font-size: 11px; }
                .footer { margin-top: 10px; text-align: center; font-size: 11px; }

                /* Tombol untuk tampilan layar */
                .actions {
                    text-align: center;
                    margin-top: 12px;
                }

                button {
                    display: inline-block;
                    margin: 4px;
                    padding: 6px 12px;
                    font-size: 11px;
                    background-color: #000;
                    color: #fff;
                    border: none;
                    cursor: pointer;
                    border-radius: 3px;
                }

                button:hover {
                    background-color: #333;
                }

                /* ✅ Sembunyikan tombol saat dicetak */
                @media print {
                    .actions { display: none !important; }
                }
            </style>
        </head>
        <body onload="window.print();">
            <div class="center">
                <strong>KEBAB BANG AJI</strong><br>
                ' . $branchAddress . '<br>
                Operator: ' . $nameUser . '<br>
                <small>Telp: 0812-3456-7890</small><br>
            </div>

            <div class="line"></div>
            <div>No. Invoice: ' . $invoice_number . '</div>
            <div>Tanggal: ' . $createdAt->format('d-m-Y H:i:s') . '</div>
            <div class="line"></div>';

        foreach ($cart as $item) {
            $subtotalItem = $item['price'] * $item['qty'];
            $html .= '
                <div class="item">
                    <span>' . htmlspecialchars($item['name']) . ' (' . $item['qty'] . 'x)</span>
                    <span>Rp' . number_format($subtotalItem, 0, ',', '.') . '</span>
                </div>';
        }

        $html .= '
            <div class="line"></div>
            <div class="item"><span>Subtotal</span><span>Rp ' . number_format($subtotal, 0, ',', '.') . '</span></div>
            <div class="item"><span>PPN (10%)</span><span>Rp ' . number_format($tax, 0, ',', '.') . '</span></div>
            <div class="item"><strong>Total</strong><strong>Rp ' . number_format($total, 0, ',', '.') . '</strong></div>
            <div class="item"><span>Bayar</span><span>Rp ' . number_format($payment, 0, ',', '.') . '</span></div>
            <div class="item"><span>Kembali</span><span>Rp ' . number_format($change, 0, ',', '.') . '</span></div>

            <div class="line"></div>
            <div class="footer">
                Terima kasih sudah berbelanja!<br>
                Semoga hari Anda menyenangkan 😊
            </div>

            <!-- ✅ Tombol hanya untuk tampilan layar -->
            <div class="actions">
                <button onclick="window.print()">Cetak Ulang</button>
                <button onclick="window.close()">Tutup</button>
            </div>
        </body>
        </html>
        ';

        $filename = 'receipts/receipt_' . Str::uuid() . '.html';
        Storage::disk('public')->put($filename, $html);

        return asset('storage/' . $filename);
    }
}
