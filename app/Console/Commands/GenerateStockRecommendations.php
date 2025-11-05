<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Models\StockRecommendation;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Log;

class GenerateStockRecommendations extends Command
{
    protected $signature = 'stock:recommendation';
    protected $description = 'Generate rekomendasi stok bulanan berdasarkan rata-rata 3 bulan terakhir';

    public function handle()
    {
        Log::info('[REKOM] stock:recommendation DIJALANKAN pada: ' . now());

        $windowStart = now()->subMonthsNoOverflow(3)->startOfMonth();
        $windowEnd   = now()->subMonth()->endOfMonth();

        $recommendationMonth = now()->startOfMonth()->toDateString();

        $sales = TransactionItem::selectRaw('
                transaction_items.product_id,
                transactions.branch_id,
                SUM(transaction_items.qty) AS total_qty_3mo
            ')
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$windowStart, $windowEnd])
            ->groupBy('transaction_items.product_id', 'transactions.branch_id')
            ->get();

        $months = 3;

        foreach ($sales as $sale) {
            $avgMonthly = (int) ceil($sale->total_qty_3mo / $months);

            StockRecommendation::updateOrCreate(
                [
                    'product_id' => $sale->product_id,
                    'branch_id'  => $sale->branch_id,
                    'recommendation_date' => $recommendationMonth,
                ],
                [
                    'recommended_stock' => $avgMonthly,
                ]
            );
        }

        $this->info(sprintf(
            'Rekomendasi stok (rata-rata %d bulan) digenerate untuk window %s s/d %s.',
            $months,
            $windowStart->toDateString(),
            $windowEnd->toDateString()
        ));
    }
}
