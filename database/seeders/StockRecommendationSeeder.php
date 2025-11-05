<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productId = 1;
        $branchId  = 1;

        $minStock = 5;
        $maxStock = 100;

        $start = Carbon::create(2024, 1, 1)->startOfMonth();
        $end   = Carbon::create(2025, 12, 1)->startOfMonth();

        $rows = [];
        $period = CarbonPeriod::create($start, '1 month', $end);

        foreach ($period as $date) {
            $ts = $date->copy()->startOfDay();

            $rows[] = [
                'product_id'          => $productId,
                'branch_id'           => $branchId,
                'recommended_stock'   => random_int($minStock, $maxStock),
                'recommendation_date' => $date->toDateString(),
                'created_at'          => $ts,
                'updated_at'          => $ts,
            ];
        }

        DB::table('stock_recommendations')->insert($rows);
    }
}
