<!--start header-->
<header class="top-header">
    <nav class="navbar navbar-expand align-items-center gap-4">
        <div class="btn-toggle">
            <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
        </div>
        <div class="notify-close position-absolute end-0 me-3">
        </div>
        <div class="notify-close position-absolute end-0 me-3">
            <div class="search-bar flex-grow-1">
                <div class="position-relative">
                    <div class="card-body search-content"></div>
                    <li class="nav-item dropdown">
                        <a href="javascript:;" class="dropdown-toggle dropdown-toggle-nocaret"
                            data-bs-toggle="dropdown">
                            <h5 class="user-name fw-bold mb-0">Hello, {{ Auth::user()->name }}</h5>
                        </a>
                        <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                            <a class="dropdown-item gap-2 py-2" href="javascript:;">
                                <div class="text-center">
                                    <h5 class="user-name fw-bold mb-0">{{ Auth::user()->email }}</h5>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="material-icons-outlined">power_settings_new</i> Logout
                            </a>
                        </div>
                    </li>
                </div>
            </div>
        </div>
        <div class="notify-list">
            <div class="notify-close position-absolute end-0 me-3">
            </div>
        </div>
        </ul>
    </nav>
</header>
<!--end top header-->
