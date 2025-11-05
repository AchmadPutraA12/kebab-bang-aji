<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\ProductStockDataTable;
use App\Datatables\Admin\RecommendationProductStockDataTable;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchStock;
use App\Models\HistoryStockBranch;
use App\Models\Product;
use App\Models\StockRecommendation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = BranchStock::with(['product.categoryProduct', 'branch'])
                ->whereHas('product')
                ->whereHas('branch');

            if ($request->has('branch_id') && $request->branch_id) {
                $query->where('branch_id', $request->branch_id);
            }

            if ($request->has('product_id') && $request->product_id) {
                $query->where('product_id', $request->product_id);
            }

            return ProductStockDataTable::make($query);
        }

        return view('admin.product_stock.index', [
            'title' => 'Data Produk',
            'branches' => Branch::select('id', 'name')->get(),
            'products' => Product::select('id', 'name')->get(),
        ]);
    }

    public function indexHistoryIn(Request $request)
    {
        if ($request->ajax()) {
            $query = HistoryStockBranch::with(['product.categoryProduct', 'branch'])
                ->whereHas('product')
                ->whereHas('branch')
                ->where('category_id', 1)
                ->orderBy('created_at', 'desc');

            if ($request->has('branch_id') && $request->branch_id) {
                $query->where('branch_id', $request->branch_id);
            }

            if ($request->has('date') && $request->date) {
                $query->whereDate('created_at', $request->date);
            }

            return ProductStockDataTable::make($query);
        }

        return view('admin.history_product_stock.index', [
            'title' => 'Data History Stock',
            'barang' => 'Masuk',
            'branches' => Branch::all(),
            'ajaxUrl' => route('admin.history-product-stock.indexHistoryIn')
        ]);
    }

    public function indexHistoryOut(Request $request)
    {
        if ($request->ajax()) {
            $query = HistoryStockBranch::with(['product.categoryProduct', 'branch'])
                ->whereHas('product')
                ->whereHas('branch')
                ->where('category_id', 2)
                ->orderBy('created_at', 'desc');

            if ($request->has('branch_id') && $request->branch_id) {
                $query->where('branch_id', $request->branch_id);
            }

            return ProductStockDataTable::make($query);
        }

        return view('admin.history_product_stock.index', [
            'title' => 'Data History Stock',
            'barang' => 'Keluar',
            'branches' => Branch::all(),
            'ajaxUrl' => route('admin.history-product-stock.indexHistoryOut')
        ]);
    }

    public function indexRecommendation(Request $request)
    {
        if ($request->ajax()) {
            $query = StockRecommendation::with(['product.categoryProduct', 'branch'])
                ->whereHas('product')
                ->whereHas('branch');

            if ($request->has('branch_id') && $request->branch_id) {
                $query->where('branch_id', $request->branch_id);
            }

            if ($request->has('product_id') && $request->product_id) {
                $query->where('product_id', $request->product_id);
            }

            if ($request->has('month') && $request->month) {
                [$year, $month] = explode('-', $request->month);
                $query->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            }

            return RecommendationProductStockDataTable::make($query);
        }

        return view('admin.recommendation_product_stock.index', [
            'title' => 'Data Produk',
            'branches' => Branch::select('id', 'name')->get(),
            'products' => Product::select('id', 'name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
