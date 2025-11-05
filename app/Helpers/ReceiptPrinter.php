<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ReceiptPrinter
{
    public static function print($invoice_number, $cart, $subtotal, $tax, $total, $payment, $change, $createdAt, $user)
    {
        try {
            $connector = new WindowsPrintConnector("POS-58");
            $printer = new Printer($connector);

            $branchAddress = $user->branch?->address ?? 'Alamat tidak tersedia';
            $nameUser = $user->name ?? 'nama tidak tersedia';

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("KEBAB BANG AJI\n");
            $printer->text($branchAddress . "\n");
            $printer->text("Operator:" . $nameUser . "\n");
            $printer->text("Telp: 0812-3456-7890\n");
            $printer->text("------------------------------\n");

            $printer->text("No. Invoice: {$nameUser}-{$invoice_number}\n");
            $printer->text($createdAt->format('d-m-Y H:i:s') . "\n");
            $printer->text("------------------------------\n");

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            foreach ($cart as $item) {
                $name = wordwrap($item['name'], 20, "\n", true);
                $qty = $item['qty'];
                $price = number_format($item['price']);
                $subtotalItem = number_format($item['price'] * $item['qty']);

                $printer->text("{$name}\n");
                $printer->text("  {$qty} x Rp{$price} = Rp{$subtotalItem}\n");
            }

            $printer->text("------------------------------\n");
            $printer->text("Subtotal : Rp " . number_format($subtotal) . "\n");
            $printer->text("PPN 10%  : Rp " . number_format($tax) . "\n");
            $printer->text("Total    : Rp " . number_format($total) . "\n");
            $printer->text("Bayar    : Rp " . number_format($payment) . "\n");
            $printer->text("Kembali  : Rp " . number_format($change) . "\n");
            $printer->text("------------------------------\n");

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Terima kasih\n");
            $printer->text("Sudah berbelanja\n\n");

            $printer->cut();
            $printer->close();
        } catch (\Exception $e) {
            Log::error('Gagal cetak struk: ' . $e->getMessage());
        }
    }
}
