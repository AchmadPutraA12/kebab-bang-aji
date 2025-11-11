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
                            <h5 class="mb-0">Daftar Produk Dengan Stock</h5>
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
                                    <div>
                                        <label for="monthFilter" class="form-label mb-1">Filter Bulan & Tahun</label>
                                        <input type="month" id="monthFilter" class="form-control" style="width: 200px;">
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="productStockTable" class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Invoice</th>
                                            <th>Cabang</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
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
                url: '{{ route('owner.transaction.index') }}',
                data: function(d) {
                    d.branch_id = $('#branchFilter').val();
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
                    data: 'invoice_number',
                    name: 'invoice_number'
                },
                {
                    data: 'branch_name',
                    name: 'branch.name'
                },
                {
                    data: 'price_format',
                    name: 'price_format'
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
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        const show = `{{ url('owner/transaction') }}/${row.invoice_number}`;
                        return `
                        <a href="${show}" class="btn btn-sm btn-info">Show</a>
                    `;
                    }
                }
            ]
        });

        $('#branchFilter').on('change', function() {
            table.ajax.reload();
        });
        $('#branchFilter, #monthFilter').on('change', function() {
            table.ajax.reload();
        });
    </script>
@endpush
