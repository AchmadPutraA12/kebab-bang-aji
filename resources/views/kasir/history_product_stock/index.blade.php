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
                            <h5 class="mb-0">Daftar History Barang </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-end mb-3 gap-3">
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
                                    <label for="statusFilter" class="form-label">Filter status</label>
                                    <select id="statusFilter" class="form-select" style="width: 250px;">
                                        <option value="">Semua status</option>
                                        <option value="0">belum di check</option>
                                        <option value="1">sudah di cehck</option>
                                        <option value="2">di tolak</option>
                                    </select>
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
                ajax: '{{ route('stok-kasir.index') }}',
                data: function(d) {
                    d.product_id = $('#productFilter').val();
                    d.status = $('#statusFilter').val();
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
                            return `
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="btn btn-success btn-sm btn-approve" data-id="${row.id}" data-product="${row.product_name}">
                                        ✔
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-reject" data-id="${row.id}" data-product="${row.product_name}">
                                        ✖
                                    </button>
                                </div>
                            `;
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

        $('#productFilter').on('change', function() {
            table.ajax.reload();
        });
        $('#statusFilter').on('change', function() {
            table.ajax.reload();
        });

        $(document).on('click', '.btn-approve, .btn-reject', function() {
            const id = $(this).data('id');
            const product = $(this).data('product');
            const isApprove = $(this).hasClass('btn-approve');

            const title = isApprove ? 'Tambah Produk' : 'Tolak Produk';
            const text = isApprove ?
                `Anda yakin ingin <b>menambahkan</b> stok untuk produk <b>${product}</b>?` :
                `Anda yakin ingin <b>menolak</b> stok untuk produk <b>${product}</b>?`;

            Swal.fire({
                title: title,
                html: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: isApprove ? 'Ya, Tambah!' : 'Ya, Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('stok-kasir.store') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            status: isApprove ? 1 : 2
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: isApprove ? 'Berhasil!' : 'Ditolak!',
                                text: response.message || (isApprove ?
                                    'Stok berhasil divalidasi.' :
                                    'Stok ditolak dan dicatat.')
                            });
                            $('#productStockTable').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: xhr.responseJSON?.message ||
                                    'Terjadi kesalahan saat menyimpan data.'
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
