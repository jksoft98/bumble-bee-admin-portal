
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/theme-default/dist/img/bumble-bee-logo.png">

  <title>Bumble Bee | {{ $title }}</title>


  @foreach ($css as $path)
    <link href="{{ $path }}" rel="stylesheet">
  @endforeach

  <script>
    var token = "{{ csrf_token() }}"; 
  </script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/assets/theme-default/dist/img/bumble-bee-logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
       <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Admin Portal</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->
     
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown" id="notification-area">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge pending">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">3 Notifications</span>
        <div class="overflow-auto" style="max-width: 300px; max-height: 250px;">
        <span class="notification-body">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted text-right"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted text-right"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted text-right"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          </span>
          </div>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link" style="margin-top: 5px;">
      <img src="/assets/theme-default/dist/img/bumble-bee-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><img src="/assets/theme-default/dist/img/bee-logo.png" alt="AdminLTE Logo" style="height:30px"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/assets/theme-default/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{session()->get('username')}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           @if(in_array('dashboard-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
          <li class="nav-item">
            <a href="/" class="nav-link  {{ (request()->is('/')) ? 'active' : '' }} ">
              <i class="nav-icon fas fa-th"></i>
              <p>
               Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @endif
          @if(in_array('user-create-view', session()->get('user_permissions')) || in_array('user-create-view', session()->get('user_permissions')) || in_array('user-role-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
          <li class="nav-item {{ (request()->is('user-create') || request()->is('user-list') || request()->is('user-edit/*') || request()->is('user-role-list') || request()->is('user-role-create') || request()->is('user-role-edit/*')) ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(in_array('user-create-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
              <li class="nav-item">
                <a href="/user-create" class="nav-link">
                  <i class="far {{ (request()->is('user-create')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
            @endif
            @if(in_array('user-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
              <li class="nav-item">
                <a href="/user-list" class="nav-link">
                  <i class="far {{ (request()->is('user-list')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            @endif
            @if(in_array('user-role-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
              <li class="nav-item">
                <a href="/user-role-list" class="nav-link">
                  <i class="far {{ (request()->is('user-role-list')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                  <p>User Roles</p>
                </a>
              </li>
            @endif
            </ul>
          </li>
          @endif
          
          @if(in_array('customer-create-view', session()->get('user_permissions')) || in_array('customer-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
          <li class="nav-item {{ (request()->is('customer-create') || request()->is('customer-list') || request()->is('customer-edit/*')) ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array('customer-create-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                <li class="nav-item">
                  <a href="/customer-create" class="nav-link">
                    <i class="far {{ (request()->is('customer-create')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
              @endif
              @if(in_array('customer-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
              <li class="nav-item">
                <a href="/customer-list" class="nav-link">
                  <i class="far {{ (request()->is('customer-list')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if(in_array('product-create-view', session()->get('user_permissions')) || in_array('product-list-view', session()->get('user_permissions')) || in_array('brand-list-view', session()->get('user_permissions')) || in_array('category-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
          <li class="nav-item {{ (request()->is('product-create') || request()->is('product-list') || request()->is('product-list/*') || request()->is('product-edit/*') || request()->is('brand-list') || request()->is('category-list') ) ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array('product-create-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                <li class="nav-item">
                  <a href="/product-create" class="nav-link">
                    <i class="far {{ (request()->is('product-create')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
              @endif
              @if(in_array('product-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
              <li class="nav-item">
                <a href="/product-list" class="nav-link">
                  <i class="far {{ request()->is('product-list') || (request()->is('product-list/*')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              @endif
              @if(in_array('brand-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
              <li class="nav-item">
                <a href="/brand-list" class="nav-link">
                  <i class="far {{ (request()->is('brand-list')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
              @endif
              @if(in_array('category-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
              <li class="nav-item">
                <a href="/category-list" class="nav-link">
                  <i class="far {{ (request()->is('category-list')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if(in_array('order-create-view', session()->get('user_permissions')) || in_array('order-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
          <li class="nav-item {{ (request()->is('order-create') || request()->is('order-list') || request()->is('order-edit/*')) ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(in_array('order-create-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
                <li class="nav-item">
                  <a href="/order-create" class="nav-link">
                    <i class="far {{ (request()->is('order-create')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
              @endif
              @if(in_array('order-list-view', session()->get('user_permissions')) || session()->get('user_role') == 1)
              <li class="nav-item">
                <a href="/order-list" class="nav-link">
                  <i class="far {{ (request()->is('order-list')) ? 'fa-dot-circle' : 'fa-circle' }} nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          <li class="nav-item">
            <a href="/logout" class="nav-link"> &nbsp
              <i class="fas fa-sign-out-alt"></i>
              <p> &nbsp Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @include($view)  
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#">Janith Kavinda</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  @foreach ($script as $path)
    <script src="{{ $path }}"></script>
  @endforeach
  <script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<!-- Notification sound -->
<audio id="failed-sound">
  <source src="/assets/custom/sound/failed.mp3" type="audio/mpeg">
  <source src="/assets/custom/sound/failed.ogg" type="audio/ogg">
</audio>
<audio id="success-sound">
  <source src="/assets/custom/sound/success.mp3" type="audio/mpeg">
  <source src="/assets/custom/sound/success.ogg" type="audio/ogg">
</audio>
<script type="text/javascript">
  var failed_sound  = document.getElementById("failed-sound"); 
  var success_sound = document.getElementById("success-sound"); 
  var userRoleId = "{{session()->get('user_role')}}";
</script>

@if(session('success'))
  <script>
      $(document).ready(function() {
        toastr.success( "{{ session('success') }}");
        success_sound.play();
      });
  </script>
@endif

@if(session('error'))
  <script>
      $(document).ready(function() {
        toastr.error( "{{ session('error') }}");
        failed_sound.play();
      });
  </script>
@endif

@if(session('warning'))
  <script>
      $(document).ready(function() {
        toastr.error( "{{ session('warning') }}");
      });
  </script>
@endif

</body>
</html>
