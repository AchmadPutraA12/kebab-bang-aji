@extends('layout.admin_layout')

@section('title', $title)

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Categori Admin</h5>
                            <button onclick="openCreateModal()" class="btn btn-primary">
                                <i class="material-icons-outlined me-1">add_circle</i> Tambah Categori
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="categoryTable" class="table-bordered table">
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

                    @include('admin.category_admin.create')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const storeUrl = @json(route('admin.category-admin.store'));
        const updateUrlTemplate = @json(route('admin.category-admin.update', ['id' => '__ID__']));
        const deleteUrlTemplate = @json(route('admin.category-admin.destroy', ['id' => '__ID__']));

        const table = $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.category-admin.index') }}',
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
                        <button class="btn btn-sm btn-danger" onclick='deleteResource("${deleteUrlTemplate}", ${row.id}, "${row.name.replace(/"/g, '\\"')}", "#categoryTable")'>Hapus</button>
                    `;
                    }
                }
            ]
        });

        submitFormAjax({
            formSelector: '#formCategori',
            storeRoute: storeUrl,
            updateRouteTemplate: updateUrlTemplate,
            modalSelector: '#addUserModal',
            tableSelector: '#categoryTable',
            successMessage: 'User berhasil disimpan'
        });

        function openCreateModal() {
            $('#addCategoriModalLabel').text('Tambah Categori');
            $('#formCategori')[0].reset();
            $('#id').val('');
            $('#addUserModal').modal('show');
        }

        function openEditModal(categori) {
            $('#addCategoriModalLabel').text('Edit Categori');
            $('#id').val(categori.id);
            $('[name="name"]').val(categori.name);
            $('#addUserModal').modal('show');
        }
    </script>
@endpush
