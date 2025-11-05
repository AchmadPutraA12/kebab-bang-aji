@extends('layout.admin_layout')

@section('title', 'Dashboard Admin')

@section('css')
    <style>
        .card-stat {
            background: linear-gradient(120deg, #3e60ff 0%, #21d189 100%);
            color: #fff;
            border: none;
            border-radius: 18px;
            box-shadow: 0 6px 24px #3e60ff2e;
            margin-bottom: 20px;
        }

        .card-stat .card-body {
            padding: 16px 24px;
        }

        .chart-container {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 10px #0e2e5731;
            margin-bottom: 24px;
        }

        .dashboard-table th,
        .dashboard-table td {
            vertical-align: middle !important;
            color: #222;
        }

        .table-responsive {
            background: #fff;
            border-radius: 16px;
            padding: 10px 18px;
            box-shadow: 0 2px 10px #0e2e5731;
        }

        .filter-tahun-form label {
            font-weight: 600;
            color: #232347;
        }

        .filter-tahun-form select {
            background: #232347;
            color: #fff;
            border: 1px solid #21d189;
            border-radius: 7px;
            padding: 5px 18px;
            min-width: 110px;
            font-size: 1.12rem;
            font-weight: 700;
            margin-right: 10px;
        }

        .filter-tahun-form select:focus {
            outline: 2px solid #3e60ff;
        }

        @media (max-width: 991px) {

            .chart-container,
            .table-responsive {
                padding: 10px;
            }

            .dashboard-table thead {
                font-size: 14px;
            }
        }
    </style>
@endsection

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="container-fluid py-4">
                <div class="d-flex align-items-center mb-3 flex-wrap">
                    <h2 class="mb-0 me-3">Dashboard Admin</h2>
                    <form id="filterForm" class="filter-tahun-form d-flex align-items-center ms-auto" onsubmit="return false;">
                        <label for="tahun" class="me-2 text-white">Filter Tahun:</label>
                        <select name="tahun" id="tahun" class="form-select d-inline-block">
                            @for ($y = date('Y', strtotime('-5 years')); $y <= date('Y', strtotime('+1 years')); $y++)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}
                                </option>
                            @endfor
                        </select>

                        <label for="branch_id" class="me-2 text-white">Cabang:</label>
                        <select name="branch_id" id="branch_id" class="form-select d-inline-block">
                            <option value="">Semua Cabang</option>
                            @foreach (\App\Models\Branch::all() as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="row mb-4" id="statistikRow">
                    <div class="col-md-3 col-6">
                        <div class="card card-stat">
                            <div class="card-body">
                                <div>Total Omzet</div>
                                <h3 class="mb-0 mt-2" id="omzetStat">Rp
                                    {{ number_format($salesByBranch->sum('total_sales'), 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card card-stat">
                            <div class="card-body">
                                <div>Total Transaksi</div>
                                <h3 class="mb-0 mt-2" id="trxStat">{{ $totalTrx }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card card-stat">
                            <div class="card-body">
                                <div>Cabang Terbanyak Transaksi</div>
                                <h5 class="mb-0 mt-2" id="topBranchStat">
                                    {{ $topBranch->branch->name ?? '-' }} <br>
                                    <span
                                        class="fw-light small">({{ $topBranch->total_sales ? 'Rp ' . number_format($topBranch->total_sales, 0, ',', '.') : '-' }})</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card card-stat">
                            <div class="card-body">
                                <div>Cabang Stok Habis</div>
                                <h3 class="mb-0 mt-2" id="stokStat">{{ $outOfStock->unique('branch_id')->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gy-4">
                    <div class="col-lg-8">
                        <div class="chart-container">
                            <canvas id="salesBranchChart" height="100"></canvas>
                        </div>
                        <div class="chart-container mt-3">
                            <canvas id="trxPerMonthChart" height="70"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="chart-container mb-4">
                            <canvas id="salesPieChart" height="170"></canvas>
                        </div>
                        <div class="table-responsive">
                            <h5 class="mt-2 text-black">Produk Stok Habis</h5>
                            <table class="dashboard-table table-sm table">
                                <thead>
                                    <tr>
                                        <th>Cabang</th>
                                        <th>Produk</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody id="outOfStockTable">
                                    @forelse($outOfStock as $item)
                                        <tr>
                                            <td>{{ $item->branch->name ?? '-' }}</td>
                                            <td>{{ $item->product->name ?? '-' }}</td>
                                            <td><span class="badge bg-danger">{{ $item->stock }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center">Semua stok aman</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let salesBarChart, salesPieChart, trxLineChart;

        function renderAllCharts(res, tahun) {
            const ctxBar = document.getElementById('salesBranchChart').getContext('2d');
            if (salesBarChart) salesBarChart.destroy();
            salesBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: res.branchLabels.length ? res.branchLabels : ['-'],
                    datasets: [{
                        label: 'Penjualan',
                        data: res.branchSales.length ? res.branchSales : [0],
                        backgroundColor: '#21d189',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Total Penjualan per Cabang (' + tahun + ')'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });

            const ctxPie = document.getElementById('salesPieChart').getContext('2d');
            if (salesPieChart) salesPieChart.destroy();
            salesPieChart = new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: res.branchLabels.length ? res.branchLabels : ['-'],
                    datasets: [{
                        label: 'Persentase',
                        data: res.branchSales.length ? res.branchSales : [0],
                        backgroundColor: ['#21d189', '#3e60ff', '#ffd600', '#f94f6b', '#8c52ff', '#ff9700',
                            '#00c4cc'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Persentase Penjualan per Cabang'
                        }
                    }
                }
            });

            const ctxLine = document.getElementById('trxPerMonthChart').getContext('2d');
            if (trxLineChart) trxLineChart.destroy();
            trxLineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: res.monthLabels,
                    datasets: [{
                        label: 'Transaksi',
                        data: res.trxPerMonthData,
                        fill: true,
                        borderColor: '#3e60ff',
                        backgroundColor: 'rgba(62,96,255,0.11)',
                        tension: 0.2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Trend Transaksi per Bulan (' + tahun + ')'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function updateStats(res) {
            document.getElementById('omzetStat').innerText = 'Rp ' + (res.totalOmzet ?? 0).toLocaleString('id-ID');
            document.getElementById('trxStat').innerText = res.totalTrx ?? 0;
            document.getElementById('topBranchStat').innerHTML = (res.topBranchName ?? '-') +
                '<br><span class="fw-light small">(' +
                (res.topBranchTotal ? 'Rp ' + Number(res.topBranchTotal).toLocaleString('id-ID') : '-') + ')</span>';
            document.getElementById('stokStat').innerText = res.cabangStokHabis ?? 0;

            let tbody = '';
            if (res.outOfStock && res.outOfStock.length) {
                res.outOfStock.forEach(item => {
                    tbody += `<tr>
                    <td>${item.branch}</td>
                    <td>${item.product}</td>
                    <td><span class="badge bg-danger">${item.stock}</span></td>
                </tr>`;
                });
            } else {
                tbody = `<tr><td colspan="3" class="text-muted text-center">Semua stok aman</td></tr>`;
            }
            document.getElementById('outOfStockTable').innerHTML = tbody;
        }

        function fetchDashboard() {
            let tahun = document.getElementById('tahun').value;
            let branchId = document.getElementById('branch_id').value;

            fetch(`{{ route('admin.dashboard.data') }}?tahun=${tahun}&branch_id=${branchId}`)
                .then(r => r.json())
                .then(res => {
                    updateStats(res);
                    renderAllCharts(res, tahun);
                })
                .catch(() => {
                    Swal.fire('Gagal', 'Gagal mengambil data!', 'error');
                });
        }

        document.getElementById('tahun').addEventListener('change', fetchDashboard);
        document.getElementById('branch_id').addEventListener('change', fetchDashboard);

        document.addEventListener('DOMContentLoaded', function() {
            renderAllCharts({
                branchLabels: @json($salesByBranch->pluck('branch.name')->toArray()),
                branchSales: @json($salesByBranch->pluck('total_sales')->toArray()),
                monthLabels: @json($trxPerMonthLabels),
                trxPerMonthData: @json($trxPerMonthData),
            }, {{ $tahun }});
        });
    </script>
@endsection
