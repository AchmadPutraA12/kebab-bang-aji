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
                            <h5 class="mb-0">Daftar History Barang {{ $barang }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3 gap-3">
                                <div>
                                    <label for="branchFilter" class="form-label mb-1">Filter Cabang</label>
                                    <select id="branchFilter" class="form-select" style="width: 250px;">
                                        <option value="">Semua Cabang</option>
                                        @foreach ($branches as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="dateFilter" class="form-label mb-1">Filter Tanggal</label>
                                    <input type="date" id="dateFilter" class="form-control" style="width: 200px;">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="productStockTable" class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Jenis Barang</th>
                                            <th>Kategori Produk</th>
                                            <th>Harga</th>
                                            <th>Gambar</th>
                                            <th>Cabang</th>
                                            <th>Stok</th>
                                            <th>Tanggal Dan Jam Transaksi</th>
                                            <th>Status</th>
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
                url: '{{ $ajaxUrl }}',
                data: function(d) {
                    d.branch_id = $('#branchFilter').val();
                    d.date = $('#dateFilter').val();
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
                    data: 'category_id',
                    name: 'category_id',
                    render: function(data, type, row, meta) {
                        if (data == 1) {
                            return `<span style="display:inline-block; border:2px solid #28a745; border-radius:5px; padding:2px 10px; color:#28a745;">Barang Masuk</span>`;
                        }
                        if (data == 2) {
                            return `<span style="display:inline-block; border:2px solid #dc3545; border-radius:5px; padding:2px 10px; color:#dc3545;">Barang Keluar</span>`;
                        }
                        return `<span style="display:inline-block; border:2px solid #6c757d; border-radius:5px; padding:2px 10px; color:#6c757d;">-</span>`;
                    }
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
                    name: 'stock',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        let d = dayjs.utc(data).tz('Asia/Jakarta');
                        let tanggal = d.date();
                        let bulan = d.month() + 1;
                        let tahun = d.year();
                        let jam = ('0' + d.hour()).slice(-2);
                        let menit = ('0' + d.minute()).slice(-2);
                        return `${tanggal} ${namaBulan[bulan]} ${tahun} Jam ${jam}.${menit} WIB`;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (data == 0) {
                            return `<span class="badge bg-warning text-black">Produk Belum Dicek</span>`;
                        } else if (data == 1) {
                            return `<span class="badge bg-success">Produk Sudah di check</span>`;
                        } else if (data == 2) {
                            return `<span class="badge bg-danger">Produk Ditolak</span>`;
                        } else {
                            return `<span class="badge bg-secondary">Status Tidak Dikenal</span>`;
                        }
                    }
                }
            ]
        });

        $('#branchFilter').on('change', function() {
            table.ajax.reload();
        });
        $('#dateFilter').on('change', function() {
            table.ajax.reload();
        });
    </script>
@endpush
