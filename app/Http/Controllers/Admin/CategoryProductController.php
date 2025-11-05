<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\CategoryProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = CategoryProduct::select('id', 'name');
            return CategoryProductDataTable::make($query);
        }

        return view('admin.category_product.index', ['title' => 'Data Kategori Produk']);
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
        $request->validate(
            [
                'name' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.string' => 'Nama kategori harus berupa teks.',
                'name.max' => 'Nama kategori maksimal 255 karakter.',
            ]
        );

        CategoryProduct::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Categori berhasil ditambahkan']);
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

        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.string' => 'Nama kategori harus berupa teks.',
            'name.max' => 'Nama kategori maksimal 255 karakter.',
        ]);

        $category = CategoryProduct::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori Produk tidak ditemukan']);
        }

        $category->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Kategori Produk berhasil ditambahkan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoryProduct = CategoryProduct::findOrFail($id);
        $categoryProduct->delete();
        return response()->json(['message' => 'Kategori Produk berhasil dihapus']);
    }
}
