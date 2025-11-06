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
                    margin: 0 auto; /* ✅ posisi tengah */
                    text-align: center; /* ✅ konten rata tengah */
                    padding: 4px;
                    color: #000;
                }

                .line {
                    border-top: 1px dashed #000;
                    margin: 6px 0;
                }

                .right {
                    text-align: right;
                    width: 100%;
                    display: block;
                }

                .item {
                    text-align: left;
                    width: 100%;
                    display: block;
                }

                .item-price {
                    text-align: right;
                    width: 100%;
                    display: block;
                }

                .footer {
                    margin-top: 10px;
                    text-align: center;
                }
            </style>
        </head>
        <body onload="window.print(); window.close();">

            <div>
                <strong>KEBAB BANG AJI</strong><br>
                ' . $branchAddress . '<br>
                Operator: ' . $nameUser . '<br>
                <small>Telp: 0812-3456-7890</small><br>
            </div>

            <div class="line"></div>
            <div>No. Invoice: ' . $invoice_number . '</div>
            <div>Tanggal: ' . $createdAt->format('d-m-Y H:i:s') . '</div>
            <div class="line"></div>
        ';

        foreach ($cart as $item) {
            $subtotalItem = $item['price'] * $item['qty'];
            $html .= '
                <div class="item">' . htmlspecialchars($item['name']) . '</div>
                <div class="item-price">' . $item['qty'] . ' x Rp' . number_format($item['price'], 0, ',', '.') .
                ' = Rp' . number_format($subtotalItem, 0, ',', '.') . '</div>';
        }

        $html .= '
            <div class="line"></div>
            <div class="right">Subtotal: Rp ' . number_format($subtotal, 0, ',', '.') . '</div>
            <div class="right">PPN (10%): Rp ' . number_format($tax, 0, ',', '.') . '</div>
            <div class="right"><b>Total: Rp ' . number_format($total, 0, ',', '.') . '</b></div>
            <div class="right">Bayar: Rp ' . number_format($payment, 0, ',', '.') . '</div>
            <div class="right">Kembali: Rp ' . number_format($change, 0, ',', '.') . '</div>
            <div class="line"></div>

            <div class="footer">
                <b>Terima kasih!</b><br>
                Sudah berbelanja di Kebab Bang Aji<br>
            </div>
        </body>
        </html>
        ';

        $filename = 'receipts/receipt_' . Str::uuid() . '.html';
        Storage::disk('public')->put($filename, $html);

        return asset('storage/' . $filename);
    }
}
