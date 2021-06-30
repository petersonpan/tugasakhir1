<div class="sidebar">
  <!-- Sidebar user (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{url('backend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">@if (Session::has('adminData')) 
        {{session('adminData')->username}}

      @endif
    </a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  @include('layouts.navsidebar')
  <!-- /.sidebar-menu -->
</div>