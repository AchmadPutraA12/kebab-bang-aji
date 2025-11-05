<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchStock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        $salesByBranch = Branch::with(['transactions' => function ($q) use ($tahun) {
            $q->whereYear('created_at', $tahun);
        }])->get()->map(function ($branch) {
            $total = $branch->transactions->sum('total');
            return (object)[
                'branch' => $branch,
                'total_sales' => $total,
            ];
        });

        $totalTrx = Transaction::whereYear('created_at', $tahun)->count();
        $topBranch = $salesByBranch->sortByDesc('total_sales')->first();

        $outOfStock = BranchStock::with('branch', 'product')
            ->where('stock', '<=', 0)->get();

        $trxPerMonthLabels = [];
        $trxPerMonthData = [];
        for ($m = 1; $m <= 12; $m++) {
            $trxPerMonthLabels[] = Carbon::create()->month($m)->locale('id')->isoFormat('MMMM');
            $trxPerMonthData[] = Transaction::whereYear('created_at', $tahun)->whereMonth('created_at', $m)->count();
        }

        return view('admin.dashboard.index', [
            'tahun' => $tahun,
            'salesByBranch' => $salesByBranch,
            'totalTrx' => $totalTrx,
            'topBranch' => $topBranch,
            'outOfStock' => $outOfStock,
            'trxPerMonthLabels' => $trxPerMonthLabels,
            'trxPerMonthData' => $trxPerMonthData,
        ]);
    }

    public function ajaxData(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $branchId = $request->input('branch_id');

        if ($branchId) {
            // Filter data hanya untuk 1 cabang
            $branch = Branch::with(['transactions' => function ($q) use ($tahun) {
                $q->whereYear('created_at', $tahun);
            }])->find($branchId);

            if (!$branch) {
                return response()->json([
                    'error' => 'Cabang tidak ditemukan.'
                ], 404);
            }

            $salesByBranch = collect([(object)[
                'branch' => $branch,
                'total_sales' => $branch->transactions->sum('total')
            ]]);

            $totalTrx = $branch->transactions->count();
            $topBranch = $salesByBranch->first();

            $outOfStock = BranchStock::with('branch', 'product')
                ->where('branch_id', $branchId)
                ->where('stock', '<=', 0)
                ->get();

            $trxPerMonthLabels = [];
            $trxPerMonthData = [];
            for ($m = 1; $m <= 12; $m++) {
                $trxPerMonthLabels[] = Carbon::create()->month($m)->locale('id')->isoFormat('MMMM');
                $trxPerMonthData[] = $branch->transactions->filter(function ($trx) use ($m) {
                    return Carbon::parse($trx->created_at)->month === $m;
                })->count();
            }
        } else {
            // Semua cabang
            $salesByBranch = Branch::with(['transactions' => function ($q) use ($tahun) {
                $q->whereYear('created_at', $tahun);
            }])->get()->map(function ($branch) {
                $total = $branch->transactions->sum('total');
                return (object)[
                    'branch' => $branch,
                    'total_sales' => $total,
                ];
            });

            $totalTrx = Transaction::whereYear('created_at', $tahun)->count();
            $topBranch = $salesByBranch->sortByDesc('total_sales')->first();

            $outOfStock = BranchStock::with('branch', 'product')
                ->where('stock', '<=', 0)->get();

            $trxPerMonthLabels = [];
            $trxPerMonthData = [];
            for ($m = 1; $m <= 12; $m++) {
                $trxPerMonthLabels[] = Carbon::create()->month($m)->locale('id')->isoFormat('MMMM');
                $trxPerMonthData[] = Transaction::whereYear('created_at', $tahun)->whereMonth('created_at', $m)->count();
            }
        }

        return response()->json([
            'totalOmzet' => $salesByBranch->sum('total_sales'),
            'totalTrx' => $totalTrx,
            'topBranchName' => $topBranch ? ($topBranch->branch->name ?? '-') : '-',
            'topBranchTotal' => $topBranch ? ($topBranch->total_sales ?? 0) : 0,
            'cabangStokHabis' => $outOfStock->unique('branch_id')->count(),
            'outOfStock' => $outOfStock->map(function ($item) {
                return [
                    'branch' => $item->branch->name ?? '-',
                    'product' => $item->product->name ?? '-',
                    'stock' => $item->stock
                ];
            })->values(),
            'branchLabels' => $salesByBranch->pluck('branch.name')->toArray(),
            'branchSales' => $salesByBranch->pluck('total_sales')->toArray(),
            'monthLabels' => $trxPerMonthLabels,
            'trxPerMonthData' => $trxPerMonthData,
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
