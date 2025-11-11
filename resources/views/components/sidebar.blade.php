<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header" style="display: flex; justify-content: center; align-items: center;">
        <div class="logo-icon" style="display: flex; justify-content: center; align-items: margin-bottom: 4 rem; center;">
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-img img-fluid" alt="Logo"
                style="height: 3.8em; width: auto;">
        </div>
        <div class="sidebar-close" margin-top: 0.5rem;>
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        @if (Auth::user()->category_id == 1)
            <ul class="metismenu" id="sidenav" style="padding: 0; margin: 0;">
                <li style="margin-bottom: 0.5rem;">
                    <a href="{{ route('admin.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">dashboard</i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <li style="margin-bottom: 0.5rem;">
                    <a href="javascript:void(0);" class="has-arrow">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">supervisor_account</i>
                        </div>
                        <div class="menu-title">Manajemen User</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.category-admin.index') }}">
                                <i class="material-icons-outlined">category</i> Kategori Admin
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.branch.index') }}">
                                <i class="material-icons-outlined">apartment</i> Cabang
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.user.index') }}">
                                <i class="material-icons-outlined">account_circle</i> Manage User
                            </a>
                        </li>
                    </ul>
                </li>

                <li style="margin-bottom: 0.5rem;">
                    <a href="javascript:void(0);" class="has-arrow">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">inventory</i>
                        </div>
                        <div class="menu-title">Manajemen Produk</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.category-product.index') }}">
                                <i class="material-icons-outlined">folder</i> Kategori Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.index') }}">
                                <i class="material-icons-outlined">inventory_2</i> Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product-stock.index') }}">
                                <i class="material-icons-outlined">warehouse</i> Stok Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.recommendation-product-stock.index') }}">
                                <i class="material-icons-outlined">bar_chart</i>Rekomendasi Stok Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.history-product-stock.indexHistoryIn') }}">
                                <span class="child-icon">
                                    <i class="material-icons-outlined text-success"
                                        style="font-size:1.1rem;vertical-align:middle;">call_received</i>
                                </span>
                                <span style="margin-left:6px;">History Produk Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.history-product-stock.indexHistoryOut') }}">
                                <span class="child-icon">
                                    <i class="material-icons-outlined text-danger"
                                        style="font-size:1.1rem;vertical-align:middle;">call_made</i>
                                </span>
                                <span style="margin-left:6px;">History Produk Keluar/Return</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li style="margin-bottom: 0.5rem;">
                    <a href="{{ route('admin.transaction.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">receipt_long</i>
                        </div>
                        <div class="menu-title">Transaksi</div>
                    </a>
                </li>
            </ul>
        @elseif (Auth::user()->category_id == 2)
            <ul class="metismenu" id="sidenav">
                <li style="margin-bottom: 0.5rem;">
                    <a href="{{ route('stok-kasir.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">warehouse</i>
                        </div>
                        <div class="menu-title">Stok Produk</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kasir.index') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">shopping_cart</i>
                        </div>
                        <div class="menu-title">Cashier</div>
                    </a>
                </li>
            </ul>
        @elseif (Auth::user()->category_id == 3)
            <ul class="metismenu" id="sidenav" style="padding: 0; margin: 0;">
                <li style="margin-bottom: 0.5rem;">
                    <a href="{{ route('owner.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">dashboard</i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li style="margin-bottom: 0.5rem;">
                    <a href="{{ route('owner.transaction.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">receipt_long</i>
                        </div>
                        <div class="menu-title">Transaksi</div>
                    </a>
                </li>
            </ul>
        @endif
    </div>
</aside>
