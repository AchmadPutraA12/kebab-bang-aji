<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\BranchDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Branch::select('id', 'name', 'address');
            return BranchDatatable::make($query);
        }

        return view('admin.branch.index', ['title' => 'Data Cabang']);
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
    public function store(BranchRequest $request)
    {
        Branch::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return response()->json(['message' => 'Cabang berhasil ditambahkan']);
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
    public function update(BranchRequest $request, string $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return response()->json(['message' => 'Cabang berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cabang = Branch::findOrFail($id);
        $cabang->delete();
        return response()->json(['message' => 'Cabang berhasil dihapus']);
    }
}
