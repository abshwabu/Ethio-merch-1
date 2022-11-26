<aside class="main-sidebar bg-info elevation-4 fixed-sidebar text-white">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">


    <img src="{{ asset('assets/images/admin_imgs/t-shirtLogo.png') }}" alt="EthioMerch Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Ethio Merch</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/images/admin_imgs/avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon text-white class
               with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="{{ url('creator/dashboard') }}" class="nav-link {{ Request::is('creator/dashboard') ? 'active' : '' }}">
            <i class="nav-icon text-white fas fa-tachometer-alt"></i>
            <p class="text-white">
              Dashboard
            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="{{ url('creator/products') }}" class="nav-link {{ Request::is('creator/products') ? 'active' : '' }}">
            <i class="nav-icon text-white fas fa-tshirt"></i>
            <p class="text-white">
              Products
              
            </p>
          </a>
          
        </li>
        <li class="nav-item">
          <a href="{{ url('creator/statistics') }}" class="nav-link {{ Request::is('creator/statistics') ? 'active' : '' }}">
            <i class="nav-icon text-white ion ion-stats-bars"></i>
            <p class="text-white">
              Statistics
              
            </p>
          </a>
          
        </li>
        <li class="nav-item">
          <a href="{{ url('creator/shop') }}" class="nav-link {{ Request::is('creator/shop') ? 'active' : '' }}">
            <i class="nav-icon text-white fas fa-store"></i>
            <p class="text-white">
              Shop
            </p>
          </a>
          
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon text-white fas fa-user"></i>
            <p class="text-white">
              Account
              <i class="fas fa-angle-left right"></i>

              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('creator/personal-information/'.Auth::user()->id) }}" class="nav-link" >
                <i class="far fa-circle nav-icon text-white"></i>
                <p class="text-white">Personal Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('creator/account-setting') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-white"></i>
                <p class="text-white">Account settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('creator/payment-data') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-white"></i>
                <p class="text-white">Payment data</p>
              </a>
            </li>

          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>