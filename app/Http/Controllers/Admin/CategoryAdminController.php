<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\CategoryAdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryUserRequest;
use App\Models\CategoryAdmin;
use Illuminate\Http\Request;

class CategoryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = CategoryAdmin::select('id', 'name');
            return CategoryAdminDataTable::make($query);
        }

        return view('admin.category_admin.index', ['title' => 'Data Kategori Admin']);
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
    public function store(CategoryUserRequest $request)
    {
        CategoryAdmin::create([
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
    public function update(CategoryUserRequest $request, $id)
    {
        $categoryAdmin = CategoryAdmin::findOrFail($id);

        $categoryAdmin->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Category Admin berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoryAdmin = CategoryAdmin::findOrFail($id);
        $categoryAdmin->delete();
        return response()->json(['message' => 'Categori Admin berhasil dihapus']);
    }
}
