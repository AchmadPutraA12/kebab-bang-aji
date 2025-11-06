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

        // ✅ Buat HTML rapi dengan table layout 58mm
        $html = '
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Struk ' . $invoice_number . '</title>
            <style>
                @page {
                    size: 58mm auto;
                    margin: 0;
                }
                body {
                    font-family: "Courier New", Courier, monospace;
                    margin: 0;
                    padding: 0;
                    font-size: 11px;
                    width: 58mm;
                    color: #000;
                }
                .container {
                    width: 58mm;
                    padding: 3mm;
                    box-sizing: border-box;
                    text-align: left;
                }
                h1 {
                    font-size: 13px;
                    margin: 0 0 4px 0;
                    text-align: center;
                }
                .address {
                    font-size: 10px;
                    text-align: center;
                    margin-bottom: 4px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 4px;
                }
                th, td {
                    padding: 2px 0;
                    text-align: left;
                    font-weight: normal;
                    vertical-align: top;
                }
                th {
                    width: 40%;
                }
                .item-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }
                .item-list li {
                    display: flex;
                    justify-content: space-between;
                    padding: 1px 0;
                    word-wrap: break-word;
                }
                .line {
                    border-top: 1px dashed #000;
                    margin: 6px 0;
                }
                .total {
                    font-weight: bold;
                }
                .footer {
                    text-align: center;
                    margin-top: 10px;
                    font-size: 10px;
                }
                @media print {
                    .no-print { display: none; }
                }
            </style>
        </head>
        <body onload="window.print();">
            <div class="container">
                <h1>KEBAB BANG AJI</h1>
                <div class="address">
                    ' . nl2br(e($branchAddress)) . '<br>
                    Operator: ' . e($nameUser) . '<br>
                    Telp: 0812-3456-7890
                </div>

                <div class="line"></div>
                <table>
                    <tr><th>No. Invoice</th><td>' . e($invoice_number) . '</td></tr>
                    <tr><th>Tanggal</th><td>' . e($createdAt->format("d-m-Y H:i:s")) . '</td></tr>
                </table>
                <div class="line"></div>

                <table>
                    <tr><th>Item</th><td>
                        <ul class="item-list">';

        // ✅ Loop item transaksi
        foreach ($cart as $item) {
            $subtotalItem = $item["price"] * $item["qty"];
            $html .= '
                <li>
                    ' . htmlspecialchars($item["name"]) . '
                    <span>' . $item["qty"] . ' x ' . number_format($item["price"], 0, ",", ".") . '</span>
                </li>
                <li style="justify-content:flex-end;">
                    Rp' . number_format($subtotalItem, 0, ",", ".") . '
                </li>';
        }

        $html .= '
                        </ul>
                    </td></tr>
                    <tr><th>Subtotal</th><td>Rp ' . number_format($subtotal, 0, ',', '.') . '</td></tr>
                    <tr><th>PPN (10%)</th><td>Rp ' . number_format($tax, 0, ',', '.') . '</td></tr>
                    <tr><th class="total">Total</th><td class="total">Rp ' . number_format($total, 0, ',', '.') . '</td></tr>
                    <tr><th>Bayar</th><td>Rp ' . number_format($payment, 0, ',', '.') . '</td></tr>
                    <tr><th>Kembali</th><td>Rp ' . number_format($change, 0, ',', '.') . '</td></tr>
                </table>

                <div class="line"></div>

                <div class="footer">
                    Terima kasih sudah berbelanja!<br>
                    Semoga hari Anda menyenangkan :)
                </div>

                <div class="no-print" style="text-align:center; margin-top:10px;">
                    <button onclick="window.print()">Cetak Ulang</button>
                    <button onclick="window.close()">Tutup</button>
                </div>
            </div>
        </body>
        </html>';

        // ✅ Simpan ke file sementara
        $filename = 'receipts/receipt_' . Str::uuid() . '.html';
        Storage::disk('public')->put($filename, $html);

        // ✅ Kembalikan URL-nya untuk dibuka di tab baru
        return asset('storage/' . $filename);
    }
}
