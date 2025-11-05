<?php

namespace App\Datatables\Admin;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductDataTable
{
    public static function make($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('category_name', fn($row) => $row->categoryProduct->name ?? '-')
            ->addColumn('image', function ($row) {
                if ($row->image && Storage::disk('public')->exists($row->image)) {
                    $url = Storage::url($row->image);
                    return '<img src="' . $url . '" width="100" class="img-thumbnail" />';
                } else {
                    return '<span class="text-muted">Tidak ada gambar</span>';
                }
            })
            ->addColumn('price_format', fn($row) => 'Rp ' . number_format($row->price, 0, ',', '.'))
            ->rawColumns(['image'])
            ->make(true);
    }
}
