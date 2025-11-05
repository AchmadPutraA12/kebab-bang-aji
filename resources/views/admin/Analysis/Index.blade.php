@extends('Admin.Layout_admin.Main')

@section('title')
    Analysis
@endsection
@section('css')
    <style>
        /* Membatasi tinggi dropdown dan menambahkan scrollbar */
        #yearFilter {
            max-height: 50px;
            overflow-y: auto;
        }
    </style>
@endsection
@section('content')
    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <!-- First Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Analisis Penjualan & Pendapatan <h1>(cabang 1)</h1>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Rekomendasi stok -->
                                <div class="col-md-6 border-end">
                                    <div class="table-responsive mt-3">
                                        <table id="RekomendasiStok1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Item</th>
                                                    <th>Jumlah Terjual Bulan Lalu</th>
                                                    <th>Rekomendasi Stok Bulan Depan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>1</th>
                                                    <th>Kebab XL</th>
                                                    <th>3</th>
                                                    <th>5</th>
                                                </tr>
                                                <tr>
                                                    <th>2</th>
                                                    <th>Kebab Besar</th>
                                                    <th>4</th>
                                                    <th>6</th>
                                                </tr>
                                                <tr>
                                                    <th>3</th>
                                                    <th>Burger</th>
                                                    <th>7</th>
                                                    <th>10</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Bar Chart dengan Filter Tahun -->
                                <div class="col-md-6">
                                    <h5>Pendapatan Tahunan</h5>
                                    </hr>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5>Filter Tahun:</h5>
                                        <select id="yearFilter" class="form-select w-50" size="1">
                                            <!-- Tahun dari 2021 hingga 2030 -->
                                            <script>
                                                for (let year = 2030; year >= 2024; year--) {
                                                    document.write(`<option value="${year}">${year}</option>`);
                                                }
                                            </script>
                                        </select>
                                    </div>
                                    <div id="barChart" style="height: 400px;"></div>
                                </div>
                            </div>

                            <!-- Tabel Penghasilan Bulanan -->
                            <hr>
                            <div class="card-header">
                                <h5>Data Penghasilan Bulanan</h5>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="monthlyEarningsTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan - Tahun</th>
                                            <th>Total Pendapatan</th>
                                            <th>Nama Item</th>
                                            <th>Jumlah Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <th>November 2024</th>
                                            <th>Rp. 4.000.000</th>
                                            <th>
                                                <div>(makanan) Kebab XL</div>
                                                <div>(makanan) Kebab Besar</div>
                                                <div>(makanan) Kebab Kecil</div>
                                                <div>(makanan) Kebab Mini</div>
                                                <div>(makanan) Burger</div>
                                                <div>(makanan) Super Burger</div>
                                                <div>(makanan) Hot Dog</div>
                                                <div>(toping) Keju</div>
                                                <div>(toping) Telur</div>
                                            </th>
                                            <th>
                                                <div>3</div>
                                                <div>4</div>
                                                <div>5</div>
                                                <div>6</div>
                                                <div>7</div>
                                                <div>8</div>
                                                <div>2</div>
                                                <div>7</div>
                                                <div>8</div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <th>Desember 2024</th>
                                            <th>Rp. 4.000.000</th>
                                            <th>
                                                <div>(makanan) Kebab XL</div>
                                                <div>(makanan) Kebab Besar</div>
                                                <div>(makanan) Kebab Kecil</div>
                                                <div>(makanan) Kebab Mini</div>
                                                <div>(makanan) Burger</div>
                                                <div>(makanan) Super Burger</div>
                                                <div>(makanan) Hot Dog</div>
                                                <div>(toping) Keju</div>
                                                <div>(toping) Telur</div>
                                            </th>
                                            <th>
                                                <div>3</div>
                                                <div>4</div>
                                                <div>5</div>
                                                <div>6</div>
                                                <div>7</div>
                                                <div>8</div>
                                                <div>2</div>
                                                <div>7</div>
                                                <div>8</div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Card (same content as the first one) -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Analisis Penjualan & Pendapatan <h1>(cabang 2)</h1>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Rekomendasi Stok -->
                                <div class="col-md-6 border-end">
                                    <div class="table-responsive mt-3">
                                        <table id="RekomendasiStok2" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Item</th>
                                                    <th>Jumlah Terjual Bulan Lalu</th>
                                                    <th>Rekomendasi Stok Bulan Depan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>1</th>
                                                    <th>Kebab XL</th>
                                                    <th>3</th>
                                                    <th>5</th>
                                                </tr>
                                                <tr>
                                                    <th>2</th>
                                                    <th>Kebab Besar</th>
                                                    <th>4</th>
                                                    <th>6</th>
                                                </tr>
                                                <tr>
                                                    <th>3</th>
                                                    <th>Burger</th>
                                                    <th>7</th>
                                                    <th>10</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Bar Chart dengan Filter Tahun -->
                                <div class="col-md-6">
                                    <h5>Pendapatan Tahunan</h5>
                                    </hr>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5>Filter Tahun:</h5>
                                        <select id="yearFilter2" class="form-select w-50" size="1">
                                            <!-- Tahun dari 2024 hingga 2030 -->
                                            <script>
                                                for (let year = 2030; year >= 2024; year--) {
                                                    document.write(`<option value="${year}">${year}</option>`);
                                                }
                                            </script>
                                        </select>
                                    </div>
                                    <div id="barChart2" style="height: 400px;"></div>
                                </div>
                            </div>

                            <!-- Tabel Penghasilan Bulanan -->
                            <hr>
                            <div class="card-header">
                                <h5>Data Penghasilan Bulanan</h5>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="monthlyEarningsTable2" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan - Tahun</th>
                                            <th>Total Pendapatan</th>
                                            <th>Nama Item</th>
                                            <th>Jumlah Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <th>November 2024</th>
                                            <th>Rp. 4.000.000</th>
                                            <th>
                                                <div>(makanan) Kebab XL</div>
                                                <div>(makanan) Kebab Besar</div>
                                                <div>(makanan) Kebab Kecil</div>
                                                <div>(makanan) Kebab Mini</div>
                                                <div>(makanan) Burger</div>
                                                <div>(makanan) Super Burger</div>
                                                <div>(makanan) Hot Dog</div>
                                                <div>(toping) Keju</div>
                                                <div>(toping) Telur</div>
                                            </th>
                                            <th>
                                                <div>3</div>
                                                <div>4</div>
                                                <div>5</div>
                                                <div>6</div>
                                                <div>7</div>
                                                <div>8</div>
                                                <div>2</div>
                                                <div>7</div>
                                                <div>8</div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <th>Desember 2024</th>
                                            <th>Rp. 4.000.000</th>
                                            <th>
                                                <div>(makanan) Kebab XL</div>
                                                <div>(makanan) Kebab Besar</div>
                                                <div>(makanan) Kebab Kecil</div>
                                                <div>(makanan) Kebab Mini</div>
                                                <div>(makanan) Burger</div>
                                                <div>(makanan) Super Burger</div>
                                                <div>(makanan) Hot Dog</div>
                                                <div>(toping) Keju</div>
                                                <div>(toping) Telur</div>
                                            </th>
                                            <th>
                                                <div>3</div>
                                                <div>4</div>
                                                <div>5</div>
                                                <div>6</div>
                                                <div>7</div>
                                                <div>8</div>
                                                <div>2</div>
                                                <div>7</div>
                                                <div>8</div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--end main wrapper-->
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Bar Chart for Cabang 1
            let barData = {
                2026: [500000, 700000, 300000, 800000],
                2025: [400000, 600000, 200000, 750000],
                2024: [350000, 550000, 250000, 700000]
            };

            let barOptions = {
                series: [{
                    name: 'Pendapatan',
                    data: barData[2024]
                }],
                chart: {
                    type: 'bar',
                    height: 400
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%'
                    }
                },
                xaxis: {
                    categories: ['Januari', 'Februari', 'Maret', 'April']
                }
            };

            let barChart = new ApexCharts(document.querySelector("#barChart"), barOptions);
            barChart.render();

            // Event Listener for Filter Tahun
            document.getElementById("yearFilter").addEventListener("change", function() {
                let selectedYear = this.value;
                barChart.updateSeries([{
                    name: 'Pendapatan',
                    data: barData[selectedYear]
                }]);
            });

            // datables cabang 1 (hasil bulanan)
            $(document).ready(function() {
                $('#monthlyEarningsTable').DataTable({
                    "paging": true, // Mengaktifkan pagination
                    "lengthMenu": [10, 25, 50, 100], // Opsi show entries
                    "searching": true, // Mengaktifkan fitur pencarian
                    "ordering": true, // Mengaktifkan pengurutan kolom
                    "info": true // Menampilkan informasi tabel
                });
            });
            // datables cabang 1 (rekomendasi stok)
            $(document).ready(function() {
                $('#RekomendasiStok1').DataTable({
                    "paging": true, // Mengaktifkan pagination
                    "lengthMenu": [10, 25, 50, 100], // Opsi show entries
                    "searching": true, // Mengaktifkan fitur pencarian
                    "ordering": true, // Mengaktifkan pengurutan kolom
                    "info": true // Menampilkan informasi tabel
                });
            });

            // Bar Chart for Cabang 2
            let barData2 = {
                2026: [500000, 700000, 300000, 800000],
                2025: [400000, 600000, 200000, 750000],
                2024: [350000, 550000, 250000, 700000]
            };

            let barOptions2 = {
                series: [{
                    name: 'Pendapatan',
                    data: barData2[2024]
                }],
                chart: {
                    type: 'bar',
                    height: 400
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%'
                    }
                },
                xaxis: {
                    categories: ['Januari', 'Februari', 'Maret', 'April']
                }
            };

            let barChart2 = new ApexCharts(document.querySelector("#barChart2"), barOptions2);
            barChart2.render();

            // Event Listener for Filter Tahun (Cabang 2)
            document.getElementById("yearFilter2").addEventListener("change", function() {
                let selectedYear = this.value;
                barChart2.updateSeries([{
                    name: 'Pendapatan',
                    data: barData2[selectedYear]
                }]);
            });

            // datables cabang 2 (hasil bulanan)
            $(document).ready(function() {
                $('#monthlyEarningsTable2').DataTable({
                    "paging": true, // Mengaktifkan pagination
                    "lengthMenu": [10, 25, 50, 100], // Opsi show entries
                    "searching": true, // Mengaktifkan fitur pencarian
                    "ordering": true, // Mengaktifkan pengurutan kolom
                    "info": true // Menampilkan informasi tabel
                });
            });
            // datables cabang 2 (rekomendasi stok)
            $(document).ready(function() {
                $('#RekomendasiStok2').DataTable({
                    "paging": true, // Mengaktifkan pagination
                    "lengthMenu": [10, 25, 50, 100], // Opsi show entries
                    "searching": true, // Mengaktifkan fitur pencarian
                    "ordering": true, // Mengaktifkan pengurutan kolom
                    "info": true // Menampilkan informasi tabel
                });
            });
        });
    </script>
@endsection
