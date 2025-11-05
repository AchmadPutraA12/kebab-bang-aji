<?php

namespace App\Datatables\Admin;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductStockDataTable
{
    public static function make($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('product_name', function ($q) {
                return $q->product->name ?? '-';
            })
            ->addColumn('category_name', function ($q) {
                return $q->product->categoryProduct->name ?? '-';
            })
            ->addColumn('branch_name', function ($q) {
                return $q->branch->name ?? '-';
            })
            ->addColumn('price_format', function ($q) {
                $price = $q->product->price ?? 0;
                return 'Rp ' . number_format($price, 0, ',', '.');
            })
            ->addColumn('image', function ($q) {
                $image = optional($q->product)->image;
                $imageUrl = $image
                    ? asset('storage/' . $image)
                    : 'https://via.placeholder.com/60x60?text=No+Image';
                return '<img src="' . $imageUrl . '" alt="" style="max-width:60px;max-height:60px;border-radius:6px;">';
            })
            ->addColumn('stock_format', function ($q) {
                $stock = $q->stock ?? 0;
                $formatted = number_format($stock, 0, ',', '.');
                if ($stock == 0) {
                    return '<span class="stock-empty">' . $formatted . '</span>';
                }
                return $formatted;
            })
            ->rawColumns(['stock_format', 'image'])
            ->make(true);
    }
}
