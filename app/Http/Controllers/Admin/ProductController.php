<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\ProductDataTable;
use App\Datatables\Admin\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchStock;
use App\Models\CategoryAdmin;
use App\Models\CategoryProduct;
use App\Models\HistoryStockBranch;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('categoryProduct');

            if ($request->filled('category_id')) {
                $product->where('category_id', $request->category_id);
            }

            return ProductDataTable::make($product);
        }

        $users = User::select('id', 'name')
            ->whereNotNull('branch_id')
            ->get();

        return view('admin.product.index', [
            'title' => 'Data Produk',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryProduct::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category_products,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1|max:2147483647',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['price'] = (int) str_replace('.', '', $validated['price']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return response()->json(['message' => 'Produk berhasil ditambahkan']);
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
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $categories = CategoryProduct::all();
        return view('admin.product.create', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->merge([
            'price' => preg_replace('/[^0-9]/', '', $request->price)
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category_products,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1|max:2147483647',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['price'] = (int) str_replace('.', '', $validated['price']);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return response()->json(['message' => 'Produk berhasil diperbarui']);
    }

    public function getStock($productId, $branchId)
    {
        $user = User::where('branch_id', $branchId)->first();
        $stock = BranchStock::where('product_id', $user->branch_id)
            ->where('branch_id', $branchId)
            ->first();

        return response()->json([
            'stock' => $stock ? $stock->stock : 0
        ]);
    }


    public function updateStock(Request $request, $id)
    {
        $request->merge([
            'stock' => preg_replace('/[^0-9]/', '', $request->stock)
        ]);

        $request->validate([
            'user_id' => 'required|integer',
            'stock' => 'required|integer|min:0|max:2147483647',
            'mode' => 'nullable|in:set,retur',
        ]);

        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->user_id);
            $branchId = $user->branch_id;
            $stockInput = (int)$request->stock;
            $mode = $request->mode ?? 'set';

            $branchStock = BranchStock::withTrashed()
                ->where('product_id', $id)
                ->where('branch_id', $branchId)
                ->first();

            if (!$branchStock) {
                $branchStock = new BranchStock([
                    'product_id' => $id,
                    'branch_id' => $branchId,
                    'stock' => 0
                ]);
                $branchStock->save();
            } elseif ($branchStock->trashed()) {
                $branchStock->restore();
            }

            HistoryStockBranch::create([
                'category_id' => ($mode === 'retur') ? 2 : 1,
                'product_id' => $id,
                'user_id'    => $user->id,
                'branch_id' => $branchId,
                'stock' => $stockInput,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Histori stok berhasil disimpan.',
                'data' => $branchStock,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan histori stok.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
