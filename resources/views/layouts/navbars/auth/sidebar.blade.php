<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-light shadow-lg" id="sidenav-main">
  <!-- Header Section -->
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
      <img src="../assets/img/logo_lldikti_iv.jpg" class="navbar-brand-img h-100" alt="Logo">
      <span class="ms-3 font-weight-bold">SENAD4</span>
    </a>
  </div>

  <hr class="horizontal dark mt-0">

  <!-- Navigation Links -->
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <!-- Dashboard Link -->
      <li class="nav-item mb-2">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-grey text-center me-2 d-flex align-items-center justify-content-center {{ Request::is('dashboard') ? 'bg-purple' : '' }}">
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <!-- Data Kerjasama Link -->
      <li class="nav-item mb-2">
        <a class="nav-link {{ Request::is('datamou') ? 'active' : '' }}" href="{{ url('datamou') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-grey text-center me-2 d-flex align-items-center justify-content-center {{ Request::is('datamou') ? 'bg-purple' : '' }}">
          </div>
          <span class="nav-link-text ms-1">Data Kerjasama</span>
        </a>
      </li>

      <!-- Kerjasama PT Link -->
      <li class="nav-item mb-2">
        <a class="nav-link {{ Request::is('') ? 'active' : '' }}" href="{{ url('') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-grey text-center me-2 d-flex align-items-center justify-content-center {{ Request::is('') ? 'bg-purple' : '' }}">
          </div>
          <span class="nav-link-text ms-1">Kerjasama PT</span>
        </a>
      </li>

      <!-- Data Users Link -->
      @if(Auth::user() && Auth::user()->privilege === 'Super Admin')
      <li class="nav-item mb-2">
        <a class="nav-link {{ Request::is('datausers') ? 'active' : '' }}" href="{{ url('datausers') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-grey text-center me-2 d-flex align-items-center justify-content-center {{ Request::is('datausers') ? 'bg-purple' : '' }}">
          </div>
          <span class="nav-link-text ms-1">Data Users</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</aside>