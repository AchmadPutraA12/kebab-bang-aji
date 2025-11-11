@extends('layout.admin_layout')

@section('title', $title)

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border">
                        <div class="card-header">
                            <h5 class="mb-0">Detail Transaksi</h5>
                        </div>
                        <div class="card-body">

                            <a href="{{ route('owner.transaction.index') }}" class="btn btn-secondary mb-3">Kembali</a>

                            <table class="table-bordered table">
                                <tr>
                                    <th>Invoice Number</th>
                                    <td>{{ $transaction->invoice_number }}</td>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <td>{{ $transaction->user->name ?? 'Unknown' }}</td>
                                </tr>
                                <tr>
                                    <th>Branch</th>
                                    <td>{{ $transaction->branch ? $transaction->branch->name : 'No Branch' }}</td>
                                </tr>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>Rp. {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <td>Rp. {{ number_format($transaction->tax, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>Rp. {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Payment</th>
                                    <td>Rp. {{ number_format($transaction->payment, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Change</th>
                                    <td>Rp. {{ number_format($transaction->change, 0, ',', '.') }}</td>
                                </tr>
                            </table>

                            <h5 class="mt-4">Detail Item Transaksi</h5>
                            <table class="table-bordered table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->items as $item)
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
