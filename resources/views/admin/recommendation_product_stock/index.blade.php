@extends('layout.admin_layout')

@section('title', $title)

@push('styles')
    <style>
        .stock-empty {
            border: 2px solid #dc3545 !important;
            color: #dc3545;
            padding: 2px 8px;
            border-radius: 5px;
            background: #fff0f1;
            font-weight: bold;
            display: inline-block;
        }
    </style>
@endpush

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Rekomendasi Stok Produk</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-end mb-3 gap-3">
                                <div>
                                    <label for="branchFilter" class="form-label">Filter Cabang</label>
                                    <select id="branchFilter" class="form-select" style="width: 250px;">
                                        <option value="">Semua Cabang</option>
                                        @foreach ($branches as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="productFilter" class="form-label">Filter Produk</label>
                                    <select id="productFilter" class="form-select" style="width: 250px;">
                                        <option value="">Semua Produk</option>
                                        @foreach ($products as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="monthFilter" class="form-label">Filter Bulan & Tahun</label>
                                    <input type="month" id="monthFilter" class="form-control" style="width: 200px;">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="productStockTable" class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Kategori Produk</th>
                                            <th>Harga</th>
                                            <th>Gambar</th>
                                            <th>Cabang</th>
                                            <th>Rekomendasi Stok</th>
                                            <th>Bulan & Tahun</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const namaBulan = [
            '',
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        const table = $('#productStockTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.recommendation-product-stock.index') }}',
                data: function(d) {
                    d.branch_id = $('#branchFilter').val();
                    d.product_id = $('#productFilter').val();
                    d.month = $('#monthFilter').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'product_name',
                    name: 'product.name'
                },
                {
                    data: 'category_name',
                    name: 'product.categoryProduct.name'
                },
                {
                    data: 'price_format',
                    name: 'product.price'
                },
                {
                    data: 'image',
                    name: 'product.image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'branch_name',
                    name: 'branch.name'
                },
                {
                    data: 'stock_format',
                    name: 'recommended_stock',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        let d = dayjs.utc(data).tz('Asia/Jakarta');
                        let bulan = d.month() + 1;
                        let tahun = d.year();
                        return `${namaBulan[bulan]} ${tahun} `;
                    }
                },
            ]
        });

        $('#branchFilter').on('change', function() {
            table.ajax.reload();
        });

        $('#productFilter').on('change', function() {
            table.ajax.reload();
        });
        $('#branchFilter, #productFilter, #monthFilter').on('change', function() {
            table.ajax.reload();
        });
    </script>
@endpush
