@extends('layout.admin_layout')

@section('title', $title)

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Cabang</h5>
                            <button onclick="openCreateModal()" class="btn btn-primary">
                                <i class="material-icons-outlined me-1">add_circle</i> Tambah Cabang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="branchTable" class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    @include('admin.branch.create')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const storeUrl = @json(route('admin.branch.store'));
        const updateUrlTemplate = @json(route('admin.branch.update', ['id' => '__ID__']));
        const deleteUrlTemplate = @json(route('admin.branch.destroy', ['id' => '__ID__']));

        const table = $('#branchTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.branch.index') }}',
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
                    data: 'address',
                    name: 'address'
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                        <button class="btn btn-sm btn-warning" onclick='openEditModal(${JSON.stringify(row)})'>Edit</button>
                        <button class="btn btn-sm btn-danger" onclick='deleteResource("${deleteUrlTemplate}", ${row.id}, "${row.name.replace(/"/g, '\\"')}", "#branchTable")'>Hapus</button>
                    `;
                    }
                }
            ]
        });

        submitFormAjax({
            formSelector: '#formBranch',
            storeRoute: storeUrl,
            updateRouteTemplate: updateUrlTemplate,
            modalSelector: '#addBranchModal',
            tableSelector: '#branchTable',
            successMessage: 'User berhasil disimpan'
        });

        function openCreateModal() {
            $('#addBranchModalLabel').text('Tambah Categori');
            $('#formBranch')[0].reset();
            $('#id').val('');
            $('#addBranchModal').modal('show');
        }

        function openEditModal(categori) {
            $('#addBranchModalLabel').text('Edit Categori');
            $('#id').val(categori.id);
            $('[name="name"]').val(categori.name);
            $('[name="address"]').val(categori.address);
            $('#addBranchModal').modal('show');
        }
    </script>
@endpush
