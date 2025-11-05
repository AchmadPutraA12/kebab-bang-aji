<?php

namespace App\Http\Controllers\Kasir;

use App\Datatables\Admin\ProductStockDataTable;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Product;
use App\Models\BranchStock;
use App\Models\HistoryStockBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = HistoryStockBranch::with(['product.categoryProduct', 'branch'])
                ->where('user_id', Auth::user()->id)
                ->whereHas('product')
                ->whereHas('branch')
                ->orderBy('created_at', 'desc');

            if ($request->has('product_id') && $request->product_id) {
                $query->where('product_id', $request->product_id);
            }
            if ($request->has('status') && $request->status !== null) {
                $query->where('status', $request->status);
            }

            return ProductStockDataTable::make($query);
        }

        $products = Product::select('id', 'name')->get();

        return view('kasir.history_product_stock.index', [
            'title' => 'Data History Stock',
            'products' => $products,
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
        $id = $request->id;
        $status = $request->status;

        try {
            DB::beginTransaction();

            $histori = HistoryStockBranch::findOrFail($id);

            if ($histori->status != 0) {
                return response()->json([
                    'message' => 'Data sudah diproses sebelumnya.'
                ], 400);
            }

            if ($status == 2) {
                $histori->status = 2;
                $histori->save();

                DB::commit();

                return response()->json([
                    'message' => 'Stok berhasil ditolak.'
                ]);
            }

            $branchStock = BranchStock::withTrashed()
                ->where('product_id', $histori->product_id)
                ->where('branch_id', $histori->branch_id)
                ->first();

            if (!$branchStock) {
                $branchStock = new BranchStock([
                    'product_id' => $histori->product_id,
                    'branch_id' => $histori->branch_id,
                    'stock' => 0
                ]);
            } elseif ($branchStock->trashed()) {
                $branchStock->restore();
            }

            $currentStock = $branchStock->stock;

            if ($histori->category_id == 1) {
                $branchStock->stock += $histori->stock;
            } elseif ($histori->category_id == 2) {
                if ($currentStock < $histori->stock) {
                    DB::rollBack();
                    return response()->json([
                        'message' => "Stok tidak mencukupi. Saat ini: $currentStock, akan dikurangi: {$histori->stock}"
                    ], 400);
                }
                $branchStock->stock -= $histori->stock;
            }

            $branchStock->save();
            $histori->status = 1;
            $histori->save();

            DB::commit();

            return response()->json([
                'message' => 'Stok berhasil divalidasi.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Terjadi kesalahan saat validasi stok.',
                'error' => $e->getMessage()
            ], 500);
        }
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
