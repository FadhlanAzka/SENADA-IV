<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl bg-light shadow-lg" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
    <li class="nav-item d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" data-bs-toggle="offcanvas" data-bs-target="#sidenavOffcanvas">
            <i class="fa fa-bars me-sm-1"></i>
                <span class="d-sm-inline d-none text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</span>
        </a>
    </li>        
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <div class="nav-item d-flex align-self-end">
                <!-- Additional nav items can be added here -->
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" data-bs-toggle="offcanvas" data-bs-target="#profileOffcanvas">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Profil</span>
                    </a>
                </li>
                <!--<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<!-- Offcanvas Profil -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="profileOffcanvas" aria-labelledby="profileOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="profileOffcanvasLabel">Profil Pengguna</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body text-center">
        <!-- Foto Profil -->
        <div class="d-flex justify-content-center">
            <div class="rounded-circle bg-dark mb-3" style="width: 150px; height: 150px; background-image: url('{{ Auth::user()->profile_photo_path ?? asset('default-avatar.png') }}'); background-size: cover; background-position: center;"></div>
        </div>
        <!-- Nama dan Email -->
        <h5>{{ Auth::user()->name ?? 'Nama Tidak Diketahui' }}</h5>
        <p class="text-muted">{{ Auth::user()->email ?? 'Email Tidak Diketahui' }}</p>
        <!-- Tombol Logout -->
        <a href="{{ url('/logout') }}" class="btn btn-danger w-100 mt-3">Logout</a>
        <!-- Tombol Tutup -->
        <button type="button" class="btn btn-secondary w-100 mt-3" data-bs-dismiss="offcanvas">Tutup</button>
    </div>
</div>
<!-- End Offcanvas Profil -->

<!-- Offcanvas Side Navigation -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidenavOffcanvas" aria-labelledby="sidenavOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidenavOffcanvasLabel">SENADA IV</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <!-- Dashboard Link -->
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <div class="icon-box me-3 d-flex align-items-center justify-content-center {{ Request::is('dashboard') ? 'active-box' : '' }}">
                        <i class="fas fa-industry {{ Request::is('dashboard') ? 'active-icon' : '' }}"></i>
                    </div>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <!-- Data Kerjasama Link -->
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center {{ Request::is('datamou') ? 'active' : '' }}" href="{{ url('datamou') }}">
                    <div class="icon-box me-3 d-flex align-items-center justify-content-center {{ Request::is('datamou') ? 'active-box' : '' }}">
                        <i class="fas fa-file-contract {{ Request::is('datamou') ? 'active-icon' : '' }}"></i>
                    </div>
                    <span class="nav-link-text">Data Kerjasama</span>
                </a>
            </li>

            <!-- Kerjasama PT Link -->
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center {{ Request::is('kerjasama-pt') ? 'active' : '' }}" href="{{ url('kerjasama-pt') }}">
                    <div class="icon-box me-3 d-flex align-items-center justify-content-center {{ Request::is('kerjasama-pt') ? 'active-box' : '' }}">
                        <i class="fas fa-university {{ Request::is('kerjasama-pt') ? 'active-icon' : '' }}"></i>
                    </div>
                    <span class="nav-link-text">Kerjasama PT</span>
                </a>
            </li>

            <!-- Data Users Link -->
            @if(Auth::user() && Auth::user()->privilege === 'Super Admin')
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center {{ Request::is('datausers') ? 'active' : '' }}" href="{{ url('datausers') }}">
                    <div class="icon-box me-3 d-flex align-items-center justify-content-center {{ Request::is('datausers') ? 'active-box' : '' }}">
                        <i class="fas fa-users {{ Request::is('datausers') ? 'active-icon' : '' }}"></i>
                    </div>
                    <span class="nav-link-text">Data Users</span>
                </a>
            </li>
            @endif
        </ul>

        <!-- Close Button -->
        <div class="text-center mt-4">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times me-1"></i>Tutup
            </button>
        </div>
    </div>
</div>
<!-- End Offcanvas Side Navigation -->

<style>
    /* General Icon Box */
    .icon-box {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa; /* Default background */
        color: #6c757d; /* Default color */
    }

    /* Active Icon Box */
    .icon-box.active-box {
        background-color: #6c63ff; /* Purple background for active */
        color: #ffffff; /* White icon color for active */
    }

    /* General Icon Style */
    .icon-box i {
        font-size: 18px;
    }

    /* Active Icon */
    .icon-box .active-icon {
        color: #ffffff; /* Ensure icon stays visible */
    }

    /* Nav Link Style */
    .nav-link {
        font-size: 16px;
        font-weight: 500;
    }

    .nav-link.active {
        font-weight: bold;
        color: #6c63ff;
    }

    /* Maintain consistent spacing */
    .nav-link-text {
        flex-grow: 1;
    }
</style>
