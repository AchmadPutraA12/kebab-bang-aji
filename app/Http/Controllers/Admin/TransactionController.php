<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\TransactionDatatable;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Transaction::with(['branch'])->orderBy('created_at', 'desc');

            if ($request->has('branch_id') && $request->branch_id) {
                $query->where('branch_id', $request->branch_id);
            }

            if ($request->has('month') && $request->month) {
                [$year, $month] = explode('-', $request->month);
                $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month);
            }

            return TransactionDatatable::make($query);
        }

        return view('admin.transaction.index', [
            'title' => 'Data Transaksi',
            'branches' => Branch::all(),
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
        $transaction = Transaction::where('invoice_number', $id)->with(['branch', 'user'])->firstOrFail();

        return view('admin.transaction.detail', [
            'title' => 'Data Transaksi',
            'transaction' => $transaction,
        ]);
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
