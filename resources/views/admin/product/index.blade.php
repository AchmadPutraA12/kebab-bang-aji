@extends('layout.admin_layout')

@section('title', $title)

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Produk</h5>
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                                <i class="material-icons-outlined me-1">add_circle</i> Tambah Produk
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-end mb-3 gap-3">
                                <div>
                                    <label for="categoryFilter" class="form-label">Filter Kategori</label>
                                    <select id="categoryFilter" class="form-select" style="width: 250px;">
                                        <option value="">Semua Kategori</option>
                                        @foreach (\App\Models\CategoryProduct::all() as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="productTable" class="table-bordered table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Produk</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Gambar</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.product.stock')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const deleteUrlTemplate = @json(route('admin.product.destroy', ['id' => '__ID__']));
        const updateUrlTemplate = @json(route('admin.product.updateStock', ['id' => '__ID__']));

        const table = $('#productTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('admin.product.index') }}',
                data: function(d) {
                    d.category_id = $('#categoryFilter').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'price_format',
                    name: 'price',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        const editUrl = `{{ url('admin/product') }}/${row.slug}/edit`;
                        return `
                        <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger" onclick='deleteResource("${deleteUrlTemplate}", ${row.id}, "${row.name.replace(/"/g, '\\"')}", "#productTable", "Hapus Produk?")'>Hapus</button>
                        <button class="btn btn-sm btn-info" onclick='openStockModal(${JSON.stringify(row)})'>Stock</button>
                    `;
                    }
                }
            ]
        });
        $('#categoryFilter').on('change', function() {
            table.ajax.reload();
        });

        function openStockModal(product) {
            $('#editStockModalLabel').text('Edit Stock');
            $('#id').val(product.id);
            $('#stockInput').val('');
            $('select[name="user_id"]').val('');
            $('#editStockModal').modal('show');
        }

        $(document).on('input', '#stockInput', function() {
            let value = $(this).val().replace(/[^0-9]/g, '');
            value = value.replace(/^0+/, '');
            if (value) {
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            $(this).val(value);
        });

        $('select[name="user_id"]').on('change', function() {
            const branchId = $(this).val();
            const productId = $('#id').val();
            if (branchId && productId) {
                $.get(`/admin/product/${productId}/stock/${branchId}`, function(response) {
                    let stock = response.stock ? response.stock.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                        ".") : '';
                    $('#stockInput').val(stock);
                });
            } else {
                $('#stockInput').val('');
            }
        });

        $('#editStockModal').on('shown.bs.modal', function() {
            $('select[name="user_id"]').trigger('change');
        });

        $(document).off('submit', '#formStock').on('submit', '#formStock', function(e) {
            e.preventDefault();

            let stock = $('#stockInput').val().replace(/\./g, '');
            $('#stockInput').val(stock);

            let mode = $('select[name="mode"]').val();
            let branchName = $('select[name="user_id"] option:selected').text();
            let actionText = '';
            let confirmText = '';

            if (mode === 'set') {
                actionText = 'MENAMBAHKAN';
                confirmText =
                    `Anda akan <b>${actionText}</b> stok sebanyak <b>${stock}</b> untuk Kasir <b>${branchName}</b>.<br>Lanjutkan?`;
            } else if (mode === 'retur') {
                actionText = 'MENGURANGI';
                confirmText =
                    `Anda akan <b>${actionText}</b> stok sebanyak <b>${stock}</b> untuk Kasir <b>${branchName}</b>.<br>Lanjutkan?`;
            } else {
                confirmText = 'Anda yakin ingin mengupdate stok?';
            }

            Swal.fire({
                title: 'Konfirmasi Update Stok',
                html: confirmText,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let $form = $(this);
                    const submitBtn = $form.find('#submitBtn');
                    const spinner = submitBtn.find('#spinner');
                    const btnText = submitBtn.find('#submitBtnText');
                    submitBtn.prop('disabled', true);
                    spinner.removeClass('d-none');
                    btnText.text('Menyimpan...');

                    const id = $form.find('input[name="id"]').val();
                    const url = updateUrlTemplate.replace('__ID__', id);
                    const method = 'POST';
                    const formData = new FormData(this);

                    if (id) {
                        formData.append('_method', 'PUT');
                    }

                    $.ajax({
                        url,
                        type: method,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Toastify({
                                text: response.message ||
                                    'Stock Product Berhasil disimpan',
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                duration: 3000
                            }).showToast();

                            $('#editStockModal').modal('hide');
                            $('#productTable').DataTable().ajax.reload();
                            $form[0].reset();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON
                                .errors) {
                                const errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    Toastify({
                                        text: value[0],
                                        backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                                        duration: 4000
                                    }).showToast();
                                });
                            } else if (xhr.status === 400 && xhr.responseJSON && xhr
                                .responseJSON.message) {
                                Toastify({
                                    text: xhr.responseJSON.message,
                                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                                    duration: 4000
                                }).showToast();
                            } else {
                                Toastify({
                                    text: "Terjadi kesalahan server. Silakan coba lagi.",
                                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                                    duration: 4000
                                }).showToast();
                                console.error("AJAX ERROR:", xhr);
                            }

                            submitBtn.prop('disabled', false);
                            spinner.addClass('d-none');
                        },
                        complete: function() {
                            submitBtn.prop('disabled', false);
                            spinner.addClass('d-none');
                            btnText.text('Simpan');
                        }
                    });
                }
            });
        });
    </script>
@endpush
