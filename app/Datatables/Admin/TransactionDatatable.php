<?php

namespace App\Datatables\Admin;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TransactionDatatable
{
    public static function make($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('branch_name', function ($q) {
                return $q->branch->name ?? '-';
            })
            ->addColumn('price_format', function ($q) {
                $total = $q->total ?? 0;
                return 'Rp ' . number_format($total, 0, ',', '.');
            })
            ->make(true);
    }
}
