<?php

namespace App\Datatables\Admin;

use Yajra\DataTables\DataTables;

class UserDataTable
{
    public static function make($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('category_name', fn($row) => $row->category->name ?? '-')
            ->addColumn('branch_name', fn($row) => $row->branch->name ?? '-')
            ->make(true);
    }
}
