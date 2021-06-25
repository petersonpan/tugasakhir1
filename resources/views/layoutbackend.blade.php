<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="robots" content="noindex,nofollow">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <title> @yield('titlebackend','Admin Dashboard')</title>
  <!-- Tell the browser to be responsive to screen width -->
  @include('layouts.meta')
  @stack('style')
</head>
<body class="hold-transition sidebar-mini pace-primary">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      @include('layouts.brandlogo')
      <!-- Sidebar -->
      @include('layouts.sidebar')
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{$message}}</p>
      </div>
      @endif
      @yield('contentbackend')
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
@include('layouts.js')
@stack('scripts')
</body>
</html>