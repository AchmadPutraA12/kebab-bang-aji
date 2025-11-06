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

        // Bungkus teks panjang agar turun baris (maks 32 kolom untuk 58mm)
        $wrap = fn($text, $width = 32) => implode("\n", str_split($text, $width));

        // Fungsi bantu untuk format kiri-kanan
        $pad = function ($left, $right, $width = 32) {
            $spaces = max(1, $width - strlen(strip_tags($left)) - strlen(strip_tags($right)));
            return $left . str_repeat(' ', $spaces) . $right;
        };

        // ✅ HTML & CSS struk
        $html = '
        <html>
        <head>
            <title>Struk ' . $invoice_number . '</title>
            <style>
                /* Pastikan margin nol saat print */
                @page {
                    size: 58mm auto;
                    margin: 0;
                }

                body {
                    font-family: monospace;
                    font-size: 11px;
                    width: 58mm;
                    margin: 0;
                    padding: 0;
                    color: #000;
                    white-space: pre;
                    text-align: left;
                }

                .center {
                    text-align: center;
                    width: 100%;
                    display: block;
                }

                .line {
                    border-top: 1px dashed #000;
                    margin: 6px 0;
                }

                .footer {
                    margin-top: 10px;
                    text-align: center;
                    font-size: 11px;
                }

                .actions {
                    text-align: center;
                    margin-top: 10px;
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

                /* ✅ Tombol tidak ikut tercetak */
                @media print {
                    .actions { display: none !important; }
                }
            </style>
        </head>
        <body onload="window.print();">
            <div class="center">
                <strong>KEBAB BANG AJI</strong><br>
                ' . nl2br($wrap($branchAddress)) . '<br>
                Operator: ' . htmlspecialchars($nameUser) . '<br>
                <small>Telp: 0812-3456-7890</small><br>
            </div>

            ' . str_repeat('-', 32) . "\n" . '
            No. Invoice: ' . $invoice_number . "\n" .
            'Tanggal: ' . $createdAt->format('d-m-Y H:i:s') . "\n" .
            str_repeat('-', 32) . "\n";

        // ✅ Daftar Item
        foreach ($cart as $item) {
            $subtotalItem = $item['price'] * $item['qty'];
            $nameLine = htmlspecialchars($item['name']) . ' (' . $item['qty'] . 'x)';
            $html .= $pad($nameLine, 'Rp' . number_format($subtotalItem, 0, ',', '.')) . "\n";
        }

        // ✅ Total, bayar, kembali
        $html .= str_repeat('-', 32) . "\n" .
            $pad('Subtotal', 'Rp ' . number_format($subtotal, 0, ',', '.')) . "\n" .
            $pad('PPN (10%)', 'Rp ' . number_format($tax, 0, ',', '.')) . "\n" .
            $pad('Total', 'Rp ' . number_format($total, 0, ',', '.')) . "\n" .
            $pad('Bayar', 'Rp ' . number_format($payment, 0, ',', '.')) . "\n" .
            $pad('Kembali', 'Rp ' . number_format($change, 0, ',', '.')) . "\n" .
            str_repeat('-', 32) . "\n" . '
            <div class="footer">
                Terima kasih sudah berbelanja!<br>
                Semoga hari Anda menyenangkan :)
            </div>

            <div class="actions">
                <button onclick="window.print()">Cetak Ulang</button>
                <button onclick="window.close()">Tutup</button>
            </div>
        </body>
        </html>';

        // Simpan ke file public
        $filename = 'receipts/receipt_' . Str::uuid() . '.html';
        Storage::disk('public')->put($filename, $html);

        // Return URL ke browser
        return asset('storage/' . $filename);
    }
}
