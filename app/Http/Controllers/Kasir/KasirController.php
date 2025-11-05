<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\BranchStock;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\ReceiptPrinter;
use Illuminate\Support\Str;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branch_id = Auth::user()->branch_id ?? 1;

        $categories = CategoryProduct::orderBy('name')->get();

        $products = Product::with([
            'categoryProduct',
            'branchStocks' => function ($q) use ($branch_id) {
                $q->where('branch_id', $branch_id);
            }
        ])->get();

        return view('kasir.dashboard.index', compact('categories', 'products'));
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
        $data = $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|integer|exists:products,id',
            'cart.*.name' => 'required|string',
            'cart.*.price' => 'required|integer',
            'cart.*.qty' => 'required|integer|min:1',
            'cart.*.stock' => 'required|integer',
            'cart.*.image' => 'nullable|string',
            'payment' => 'required|integer|min:0',
        ]);

        $cart = $data['cart'];
        $payment = $data['payment'];

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        $tax = intval(round($subtotal * 0.10));
        $total = $subtotal + $tax;
        $change = $payment - $total;

        if ($payment < $total) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran kurang dari total.'
            ]);
        }

        $trx = null;

        try {
            DB::transaction(function () use ($cart, $subtotal, $tax, $total, $payment, $change, &$trx) {
                $user = Auth::user();
                $now  = now();

                $operator = Str::upper(Str::slug(Str::ascii($user->name), ''));
                $seq = Transaction::where('user_id', $user->id)
                    ->whereDate('created_at', $now->toDateString())
                    ->lockForUpdate()
                    ->count() + 1;

                $invoice_number = sprintf('TRX-%s-%03d-%s', $operator, $seq, $now->format('dmY-Hi'));

                $trx = Transaction::create([
                    'invoice_number' => $invoice_number,
                    'user_id'  => $user->id,
                    'branch_id' => $user->branch_id ?? null,
                    'subtotal' => $subtotal,
                    'tax'      => $tax,
                    'total'    => $total,
                    'payment'  => $payment,
                    'change'   => $change,
                ]);

                foreach ($cart as $item) {
                    $trx->items()->create([
                        'product_id'   => $item['id'],
                        'product_name' => $item['name'],
                        'price'        => $item['price'],
                        'qty'          => $item['qty'],
                        'subtotal'     => $item['price'] * $item['qty'],
                    ]);

                    BranchStock::where('product_id', $item['id'])
                        ->where('branch_id', $user->branch_id ?? 1)
                        ->decrement('stock', $item['qty']);
                }

                ReceiptPrinter::print(
                    $invoice_number,
                    $cart,
                    $subtotal,
                    $tax,
                    $total,
                    $payment,
                    $change,
                    $trx->created_at,
                    $user
                );
            });

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil!',
                'invoice_number' => $trx?->invoice_number,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage(),
            ]);
        }
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
