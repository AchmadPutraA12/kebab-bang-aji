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

        // buat HTML struk
        $html = '
        <html>
        <head>
            <title>Struk ' . $invoice_number . '</title>
            <style>
                body { font-family: monospace; font-size: 12px; }
                .center { text-align: center; }
                .line { border-top: 1px dashed #000; margin: 6px 0; }
                .right { text-align: right; }
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
            <div class="line"></div>
        ';

        foreach ($cart as $item) {
            $subtotalItem = $item['price'] * $item['qty'];
            $html .= '
                <div>' . htmlspecialchars($item['name']) . '</div>
                <div class="right">' . $item['qty'] . ' x Rp' . number_format($item['price'], 0, ',', '.') .
                ' = Rp' . number_format($subtotalItem, 0, ',', '.') . '</div>';
        }

        $html .= '
            <div class="line"></div>
            <div>Subtotal: <span class="right">Rp ' . number_format($subtotal, 0, ',', '.') . '</span></div>
            <div>PPN (10%): <span class="right">Rp ' . number_format($tax, 0, ',', '.') . '</span></div>
            <div>Total: <span class="right">Rp ' . number_format($total, 0, ',', '.') . '</span></div>
            <div>Bayar: <span class="right">Rp ' . number_format($payment, 0, ',', '.') . '</span></div>
            <div>Kembali: <span class="right">Rp ' . number_format($change, 0, ',', '.') . '</span></div>
            <div class="line"></div>
            <div class="center">Terima kasih sudah berbelanja!</div>
        </body>
        </html>
        ';

        // simpan ke file sementara (public/receipts)
        $filename = 'receipts/receipt_' . Str::uuid() . '.html';
        Storage::disk('public')->put($filename, $html);

        // return URL-nya untuk dibuka di browser
        return asset('storage/' . $filename);
    }
}

