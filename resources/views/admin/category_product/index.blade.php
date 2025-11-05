@extends('layout.admin_layout')

@section('title', $title)

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Category Produk</h5>
                            <button onclick="openCreateModal()" class="btn btn-primary">
                                <i class="material-icons-outlined me-1">add_circle</i> Tambah Category Produk
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="categoyPoductTable" class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    @include('admin.category_product.create')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const storeUrl = @json(route('admin.category-product.store'));
        const updateUrlTemplate = @json(route('admin.category-product.update', ['id' => '__ID__']));
        const deleteUrlTemplate = @json(route('admin.category-product.destroy', ['id' => '__ID__']));

        const table = $('#categoyPoductTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.category-product.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                        <button class="btn btn-sm btn-warning" onclick='openEditModal(${JSON.stringify(row)})'>Edit</button>
                        <button class="btn btn-sm btn-danger" onclick='deleteResource("${deleteUrlTemplate}", ${row.id}, "${row.name.replace(/"/g, '\\"')}", "#categoyPoductTable")'>Hapus</button>
                    `;
                    }
                }
            ]
        });

        submitFormAjax({
            formSelector: '#formCategoryProduct',
            storeRoute: storeUrl,
            updateRouteTemplate: updateUrlTemplate,
            modalSelector: '#addCategoryProductModal',
            tableSelector: '#categoyPoductTable',
            successMessage: 'Kategory Produk Berhasil Ditambahkan',
        });

        function openCreateModal() {
            $('#addCategoryProductModalLabel').text('Tambah Kategori Produk');
            $('#formCategoryProduct')[0].reset();
            $('#id').val('');
            $('#addCategoryProductModal').modal('show');
        }

        function openEditModal(categori) {
            $('#addCategoryProductModalLabel').text('Edit Kategori Produk');
            $('#id').val(categori.id);
            $('[name="name"]').val(categori.name);
            $('#addCategoryProductModal').modal('show');
        }
    </script>
@endpush
