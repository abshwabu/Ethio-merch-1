<aside class="main-sidebar sidebar-dark-primary elevation-4 fixed-sidebar">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
   

    <img src="{{ asset('assets/images/admin_imgs/t-shirtLogo.png') }}" alt="EthioMerch Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
          
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>

              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('admin/edit-profile/'.Auth::user()->id) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>update profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/update-password') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>change password</p>
              </a>
            </li>
           
          </ul>
        </li>
        <li class="nav-item menu-open">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Catalogues
              <i class="fas fa-angle-left right"></i>
              {{-- <span class="badge badge-info right">6</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('section') }}" class="nav-link {{ Request::is('admin/section') ? 'active' : '' }}" >
                <i class="far fa-circle nav-icon"></i>
                <p>Sections</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category') }}" class="nav-link {{ Request::is('admin/categories') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('product') }}" class="nav-link {{ Request::is('admin/products') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Products</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('template') }}" class="nav-link {{ Request::is('admin/templates') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Templates</p>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item {{ Request::is('admin/users/admin') || Request::is('admin/users/creator') ||  Request::is('admin/users/customer') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Users
              <i class="fas fa-angle-left right"></i>
              {{-- <span class="badge badge-info right">6</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin') }}" class="nav-link {{ Request::is('admin/users/admin') ? 'active' : '' }}" >
                <i class="far fa-circle nav-icon"></i>
                <p>Admins</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('creator') }}" class="nav-link {{ Request::is('admin/users/creator') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Creators</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('customer') }}" class="nav-link {{ Request::is('admin/users/customer') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Customers</p>
              </a>
            </li>
            
          </ul>
        </li>
        
        <li class="nav-item {{ Request::is('admin/orders/ordered') || Request::is('admin/orders/canceled') ||  Request::is('admin/orders/delivered')  ||  Request::is('admin/orders/all_orders') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Orders
              <i class="fas fa-angle-left right"></i>
              {{-- <span class="badge badge-info right">6</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('admin/orders/ordered') }}" class="nav-link {{ Request::is('admin/orders/ordered') ? 'active' : '' }}" >
                <i class="far fa-circle nav-icon"></i>
                <p>pending </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/orders/canceled') }}" class="nav-link {{ Request::is('admin/orders/canceled') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>canceled</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/orders/delivered') }}" class="nav-link {{ Request::is('admin/orders/delivered') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Delivered</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin/orders/all_orders') }}" class="nav-link {{ Request::is('admin/orders/all_orders') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>all</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
