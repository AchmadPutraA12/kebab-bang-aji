@extends('layout.admin_layout')

@section('title', 'Kasir POS')

@section('css')
    @include('kasir.dashboard.style')
@endsection

@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="container-fluid" style="padding-top:26px;">
                <div class="d-flex justify-content-between flex-row flex-wrap">
                    <div style="flex: 1 1 60%; min-width: 340px; max-width: 860px;">
                        <div class="search-row">
                            <div class="search-box-container">
                                <span class="search-icon">
                                    <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="8.5" cy="8.5" r="7.5" stroke="#b3b3c9" stroke-width="2" />
                                        <path d="M16.2 16.2L13.13 13.13" stroke="#b3b3c9" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </span>
                                <input type="text" id="searchProduct" class="search-input"
                                    placeholder="Cari nama produk atau kata kunci..." autocomplete="off">
                            </div>
                        </div>

                        <div class="category-row mb-2">
                            <button type="button" class="category-btn active" data-category="all">Semua</button>
                            @foreach ($categories as $cat)
                                <button type="button" class="category-btn"
                                    data-category="{{ $cat->id }}">{{ $cat->name }}</button>
                            @endforeach
                        </div>

                        <div class="product-list" id="productList">
                            @foreach ($products as $product)
                                <div class="product-card {{ ($product->branchStocks->first()->stock ?? 0) < 1 ? 'unavailable' : '' }}"
                                    data-category="{{ $product->category_id }}"
                                    data-name="{{ strtolower($product->name) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="product-img"
                                        alt="{{ $product->name }}">
                                    <div class="product-info">
                                        <div class="product-title">{{ $product->name }}</div>
                                        <div class="product-cat">{{ $product->categoryProduct->name ?? '-' }}</div>
                                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </div>
                                        <div class="product-stock-row">
                                            <span class="product-stock">Stok:
                                                {{ $product->branchStocks->first()->stock ?? 0 }}</span>
                                        </div>
                                        <button class="btn btn-tambah add-to-cart" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                            data-stock="{{ $product->branchStocks->first()->stock ?? 0 }}"
                                            data-image="{{ asset('storage/' . $product->image) }}"
                                            @if (($product->branchStocks->first()->stock ?? 0) < 1) disabled @endif>
                                            Tambah
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div style="flex: 1 1 32%; max-width: 490px;">
                        <div class="cart-panel position-relative">
                            <div class="cart-title">Keranjang</div>
                            <button class="cart-clear-btn" style="display:none;">Clear All</button>
                            <div class="cart-items-container" id="cart-items"></div>
                            <div class="cart-summary-panel" id="cart-summary-panel" style="display:none;">
                                <div class="summary-row">
                                    <div>Subtotal</div>
                                    <div id="cart-subtotal">Rp 0</div>
                                </div>
                                <div class="summary-row">
                                    <div>Tax (10%)</div>
                                    <div id="cart-tax">Rp 0</div>
                                </div>
                                <div class="summary-total">
                                    <div>Total</div>
                                    <div id="cart-total">Rp 0</div>
                                </div>
                            </div>
                            <div class="cart-form-label" style="margin-top:10px;">Pembayaran</div>
                            <input type="text" class="cart-input" id="payment" placeholder="Nominal bayar">
                            <div class="cart-form-label" style="margin-top:8px;">Kembalian</div>
                            <input type="text" class="cart-input" id="change" readonly>
                            <button type="button" class="btn-checkout" id="checkout-btn">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString();
            let split = number_string.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah ? 'Rp ' + rupiah : '';
        }

        function parseRupiah(rupiahString) {
            return parseInt(rupiahString.replace(/[^0-9]/g, '')) || 0;
        }


        window.addEventListener('DOMContentLoaded', function() {
            let cart = {};

            // Search product
            document.getElementById('searchProduct').addEventListener('input', function(e) {
                let search = this.value.trim().toLowerCase();
                document.querySelectorAll('.product-card').forEach(function(card) {
                    let name = card.dataset.name;
                    let cat = document.querySelector('.category-btn.active').dataset.category;
                    let visible = name.includes(search) && (cat === "all" || card.dataset
                        .category === cat);
                    card.style.display = visible ? 'flex' : 'none';
                });
            });

            // Category filter
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.category-btn').forEach(b => b.classList.remove(
                        'active'));
                    this.classList.add('active');
                    let cat = this.dataset.category;
                    let search = document.getElementById('searchProduct').value.trim()
                        .toLowerCase();
                    document.querySelectorAll('.product-card').forEach(function(card) {
                        let matchCat = (cat === 'all' || card.dataset.category == cat);
                        let matchSearch = card.dataset.name.includes(search);
                        card.style.display = (matchCat && matchSearch) ? 'flex' : 'none';
                    });
                });
            });

            function renderCartItems() {
                let html = '';
                let isEmpty = Object.keys(cart).length === 0;
                let $clearBtn = document.querySelector('.cart-clear-btn');
                let $summary = document.getElementById('cart-summary-panel');
                if (isEmpty) {
                    html = `<div class="cart-empty-row">Keranjang kosong</div>`;
                    $clearBtn.style.display = "none";
                    $summary.style.display = "none";
                } else {
                    $clearBtn.style.display = "block";
                    $summary.style.display = "block";
                    Object.values(cart).forEach(item => {
                        html += `
                <div class="cart-item-row">
                    <div class="cart-item-img-wrap">
                        <img src="${item.image}" class="cart-item-img" alt="${item.name}">
                        <button class="cart-remove-btn" onclick="window.removeCart('${item.id}')">
                            &times;
                        </button>
                    </div>
                    <div class="cart-item-main">
                        <div class="cart-item-title">${item.name}</div>
                        <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</div>
                    </div>
                    <div class="cart-qty-control">
                        <button onclick="window.updateQty('${item.id}',-1)">-</button>
                        <span class="mx-2" style="font-size:1.08rem;width:25px;display:inline-block;text-align:center">${item.qty}</span>
                        <button onclick="window.updateQty('${item.id}',1)">+</button>
                    </div>
                </div>
                `;
                    });
                }
                document.getElementById('cart-items').innerHTML = html;
            }

            function renderSummary() {
                let subtotal = 0;
                Object.values(cart).forEach(item => subtotal += item.price * item.qty);
                let tax = Math.round(subtotal * 0.10);
                let total = subtotal + tax;
                document.getElementById('cart-subtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                document.getElementById('cart-tax').innerText = 'Rp ' + tax.toLocaleString('id-ID');
                document.getElementById('cart-total').innerText = 'Rp ' + total.toLocaleString('id-ID');
                return {
                    subtotal,
                    tax,
                    total
                };
            }

            function updateChange() {
                let {
                    total
                } = renderSummary();
                let pay = parseRupiah(document.getElementById('payment').value);

                let change = pay - total;
                document.getElementById('change').value = (change >= 0) ? 'Rp ' + change.toLocaleString('id-ID') :
                    'Pembayaran kurang';
            }

            const paymentInput = document.getElementById('payment');

            paymentInput.addEventListener('input', function(e) {
                const cursorPosition = this.selectionStart;
                const originalLength = this.value.length;

                // Format ulang jadi Rupiah
                this.value = formatRupiah(this.value);

                // Update kembalian
                updateChange();

                // Kembalikan posisi kursor
                const newLength = this.value.length;
                this.setSelectionRange(cursorPosition + (newLength - originalLength), cursorPosition + (
                    newLength - originalLength));
            });


            // Add to cart
            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    let id = this.dataset.id;
                    let name = this.dataset.name;
                    let price = parseInt(this.dataset.price);
                    let stock = parseInt(this.dataset.stock);
                    let image = this.dataset.image;
                    if (stock < 1) return;
                    if (!cart[id]) cart[id] = {
                        id,
                        name,
                        price,
                        qty: 1,
                        stock,
                        image
                    };
                    else if (cart[id].qty < stock) cart[id].qty++;
                    else Swal.fire('Stok tidak mencukupi!', '', 'warning');
                    renderCartItems();
                    renderSummary();
                    updateChange();
                });
            });

            // Clear All
            document.querySelector('.cart-clear-btn').addEventListener('click', function() {
                cart = {};
                renderCartItems();
                renderSummary();
                updateChange();
            });

            // Checkout AJAX
            document.getElementById('checkout-btn').addEventListener('click', function() {
                let {
                    total
                } = renderSummary();
                let payment = parseRupiah(document.getElementById('payment').value);

                if (Object.keys(cart).length === 0) return Swal.fire('Keranjang masih kosong!', '',
                    'warning');
                if (payment < total) return Swal.fire('Pembayaran kurang!', '', 'warning');
                fetch('{{ route('kasir.checkout') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            cart: Object.values(cart),
                            payment: payment
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message || 'Transaksi berhasil!',
                                timer: 1800,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message || 'Transaksi gagal!',
                                confirmButtonColor: '#d33',
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal terhubung ke server!',
                            confirmButtonColor: '#d33',
                        });
                    });
            });

            window.updateQty = function(id, delta) {
                if (cart[id]) {
                    let maxStock = cart[id].stock;
                    let next = cart[id].qty + delta;
                    if (next <= 0) {
                        delete cart[id];
                    } else if (next <= maxStock) {
                        cart[id].qty = next;
                    } else Swal.fire('Stok tidak cukup!', '', 'warning');
                    renderCartItems();
                    renderSummary();
                    updateChange();
                }
            }
            window.removeCart = function(id) {
                delete cart[id];
                renderCartItems();
                renderSummary();
                updateChange();
            }

            renderCartItems();
            renderSummary();
            updateChange();
        });
    </script>
@endsection
