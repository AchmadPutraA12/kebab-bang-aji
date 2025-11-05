@extends('layout.admin_layout')
@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border">
                        <div class="card-header">
                            <h5 class="mb-0">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}</h5>
                        </div>
                        <div class="card-body">
                            <form id="formProduct" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id ?? '' }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $product->name ?? '') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description ?? '') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga (Rupiah)</label>
                                    <input type="text" name="price" class="form-control"
                                        value="{{ old('price', isset($product) ? number_format($product->price, 0, ',', '.') : '') }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Produk</label>
                                    <input type="file" name="image" accept="image/*" class="form-control"
                                        id="imageInput">
                                    <div id="imagePreview" class="mt-2">
                                        @if (isset($product) && $product->image)
                                            <div class="position-relative d-inline-block" id="existingImageWrapper">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    class="img-thumbnail mb-2" width="120" id="existingImage">
                                                <span onclick="removeImage()"
                                                    style="
                                            position: absolute;
                                            top: 2px;
                                            right: 6px;
                                            cursor: pointer;
                                            color: white;
                                            background: rgba(0,0,0,0.6);
                                            border-radius: 50%;
                                            padding: 2px 8px;
                                            font-weight: bold;">&times;</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <span class="spinner-border spinner-border-sm d-none me-1" id="spinner"
                                        role="status"></span>
                                    <span id="submitBtnText">{{ isset($product) ? 'Update' : 'Simpan' }}</span>
                                </button>
                                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">← Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.getElementById('imageInput')?.addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            if (e.target.files.length > 0) {
                const file = e.target.files[0];

                const wrapper = document.createElement('div');
                wrapper.classList.add('position-relative', 'd-inline-block');

                const img = document.createElement('img');
                img.classList.add('img-thumbnail', 'mb-2');
                img.style.width = '120px';
                img.src = URL.createObjectURL(file);
                wrapper.appendChild(img);

                const closeBtn = document.createElement('span');
                closeBtn.innerHTML = '&times;';
                closeBtn.style.position = 'absolute';
                closeBtn.style.top = '2px';
                closeBtn.style.right = '6px';
                closeBtn.style.cursor = 'pointer';
                closeBtn.style.color = 'white';
                closeBtn.style.background = 'rgba(0, 0, 0, 0.6)';
                closeBtn.style.borderRadius = '50%';
                closeBtn.style.padding = '2px 8px';
                closeBtn.style.fontWeight = 'bold';
                closeBtn.onclick = function() {
                    document.getElementById('imageInput').value = '';
                    preview.innerHTML = '';
                };

                wrapper.appendChild(closeBtn);
                preview.appendChild(wrapper);
            }
        });

        function removeImage() {
            document.getElementById('imageInput').value = '';
            document.getElementById('imagePreview').innerHTML = '';
        }

        document.querySelector('input[name="price"]').addEventListener('input', function(e) {
            const raw = e.target.value.replace(/\D/g, '');
            e.target.value = formatRupiah(raw);
        });

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        submitFormAjax({
            formSelector: '#formProduct',
            storeRoute: @json(route('admin.product.store')),
            updateRouteTemplate: @json(route('admin.product.update', ['id' => '__ID__'])),
            successMessage: '{{ isset($product) ? 'Produk berhasil diperbarui' : 'Produk berhasil ditambahkan' }}',
            redirectUrl: @json(route('admin.product.index'))
        });
    </script>
@endpush
