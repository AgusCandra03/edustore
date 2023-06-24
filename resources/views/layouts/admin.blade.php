
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('assets/dist/img/edustore-logo.png') }}" type="image/x-icon">
  <title>
    EduStore | Point Of Sale
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('plugins/dropzone/min/dropzone.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('assets/dist/img/edustore-logo.png')}}" alt="Edustore Logo" height="150" width="150">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      {{-- Profile --}}
      <div class="collapse navbar-collapse" id="navbar-list-4">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle form-control" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('assets/dist/img/admin-logo.png')}}" style="width: 2vw" class="img-circle" alt="User Image">
              {{ auth()->user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ url('edit-profile') }}">Edit Profile</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                Log Out
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </div>
          </li>
        </ul>
      </div>
    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('assets/dist/img/edustore-logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      @php
        $setting = App\Models\Setting::first();
      @endphp
      <span class="brand-text font-weight-light"><b> {{ $setting->name }}</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/admin-logo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-header">MAIN MENU</li>

          <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('suppliers') }}" class="nav-link {{ request()->is('suppliers') ? 'active' : '' }}">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('members') }}" class="nav-link {{ request()->is('members') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Member
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('products', 'categories') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Management Product
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('products') }}" class="nav-link {{ request()->is('products') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('categories') }}" class="nav-link {{ request()->is('categories') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('stocks') }}" class="nav-link {{ request()->is('stocks') ? 'active' : '' }}">
              <i class="nav-icon fas fa-download"></i>
              <p>
                Input Stock
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('sales') }}" class="nav-link {{ request()->is('sales') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('sale_details') }}" class="nav-link {{ request()->is('sale_details') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Report Sales
              </p>
            </a>
          </li>

          @can('get admin')
          <li class="nav-header">CONFIGURATION</li>

          <li class="nav-item">
            <a href="{{ url('registers') }}" class="nav-link {{ request()->is('registers') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users / Employees
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('settings') }}" class="nav-link {{ request()->is('settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-edit"></i>
              <p>Setting</p>
            </a>
          </li>
          @endcan

        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('header')</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section id="app" class="content">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  {{-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
{{-- CDN Vue JS dan CD Axios JS --}}
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@yield('js')
</body>
</html>
