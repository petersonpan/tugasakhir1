
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="admin/dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="{{url('admin/products')}}" class="nav-link {{$menu_active == 'products' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Product
                <span class="right badge badge-danger">Beta</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/categories/')}}" class="nav-link {{$menu_active == 'category' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Category
                <span class="right badge badge-success">New</span>
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{url('admin/user/')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                User
                <span class="right badge badge-success">New</span>
              </p>
            </a>
          </li> -->

          <li class="nav-item has-treeview {{$menu_active[0] == 'active' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/view')}}" class="nav-link {{$menu_active[1] == 'admin' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/user/')}}" class="nav-link {{$menu_active[1] == 'user' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>