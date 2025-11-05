@extends('layout.admin_layout')

@section('title', $title)

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Pengguna</h5>
                            <button onclick="openCreateModal()" class="btn btn-primary">
                                <i class="material-icons-outlined me-1">add_circle</i> Tambah Akun
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="userTable" class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Kategori</th>
                                            <th>Cabang</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    @include('admin.user.create')
                    @include('admin.user.branch')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const storeUrl = @json(route('admin.user.store'));
        const updateUrlTemplate = @json(route('admin.user.update', ['id' => '__ID__']));
        const updateBranchUrlTemplate = @json(route('admin.user.update-branch', ['id' => '__ID__']));
        const deleteUrlTemplate = @json(route('admin.user.destroy', ['id' => '__ID__']));

        const table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.user.index') }}',
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'branch_name',
                    name: 'branch_name'
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data, type, row) {
                        let buttons = `
                            <button class="btn btn-sm btn-warning" onclick='openEditModal(${JSON.stringify(row)})'>Edit</button>
                            <button class="btn btn-sm btn-danger" onclick='deleteResource("${deleteUrlTemplate}", ${row.id}, "${row.name.replace(/"/g, '\\"')}")'>Hapus</button>
                        `;

                        if (row.category_id == 2) {
                            buttons += `
                                <button class="btn btn-sm btn-info" onclick='openEditBranch(${JSON.stringify(row)})'>Cabang</button>
                            `;
                        }

                        return buttons;
                    }
                }
            ]
        });

        submitFormAjax({
            formSelector: '#formUser',
            storeRoute: storeUrl,
            updateRouteTemplate: updateUrlTemplate,
            modalSelector: '#addUserModal',
            tableSelector: '#userTable',
            successMessage: 'User berhasil disimpan'
        });

        function openCreateModal() {
            $('#addUserModalLabel').text('Tambah User');
            $('#formUser')[0].reset();
            $('#id').val('');
            $('#passwordField').prop('required', true);
            $('#addUserModal').modal('show');
        }

        function openEditModal(user) {
            $('#addUserModalLabel').text('Edit User');
            $('#id').val(user.id);
            $('[name="name"]').val(user.name);
            $('[name="email"]').val(user.email);
            $('[name="username"]').val(user.username);
            $('[name="category_id"]').val(user.category_id);
            $('#passwordField').val('').prop('required', false);
            $('#addUserModal').modal('show');
        }

        function openEditBranch(user) {
            $('#addBranchModalLabel').text('Edit Branch');
            $('#formBranch input[name="id"]').val(user.id);
            $('[name="branch_id"]').val(user.branch_id);
            $('#addBranchModal').modal('show');
        }

        submitFormAjax({
            formSelector: '#formBranch',
            updateRouteTemplate: updateBranchUrlTemplate,
            modalSelector: '#addBranchModal',
            tableSelector: '#userTable',
            successMessage: 'Cabang pengguna berhasil diperbarui'
        });
    </script>
@endpush
