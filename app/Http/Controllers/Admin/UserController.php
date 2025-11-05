<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Branch;
use App\Models\CategoryAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('category', 'branch');
            return UserDataTable::make($users);
        }

        $categories = CategoryAdmin::select('id', 'name')->get();
        $branch = Branch::select('id', 'name')->get();

        return view('admin.user.index', [
            'title' => 'Data User',
            'categories' => $categories,
            'branch' => $branch,
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
    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'category_id' => $request->category_id,
            'is_active' => 1
        ]);

        return response()->json(['message' => 'User berhasil ditambahkan']);
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
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->category_id == 1) {
            $user->branch_id = null;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'category_id' => $request->category_id,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'branch_id'   => $user->branch_id,
        ]);

        return response()->json(['message' => 'User berhasil diperbarui']);
    }

    public function updateBranch(Request $request, $id)
    {
        $request->validate([
            'branch_id' => 'required|integer|exists:branches,id',
        ], [
            'branch_id.required' => 'Cabang harus dipilih.',
            'branch_id.integer'  => 'Cabang harus berupa angka.',
            'branch_id.exists'   => 'Cabang yang dipilih tidak valid.',
        ]);

        $user = User::findOrFail($id);
        $user->branch_id = $request->branch_id;
        $user->save();

        return response()->json(['message' => 'Cabang pengguna berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Akun berhasil dihapus']);
    }
}
