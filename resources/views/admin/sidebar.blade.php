<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('images/logo_white_v2.svg')}}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard("admin")->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
            <li class="nav-item">
                <a href="{{route('admin.vcards')}}" class="nav-link {{ Request::path() ==  'admin/vcards' ? 'active' : ''  }}">
                <i class="fa-solid fa-address-card"></i>
                <p>
                    Vcard
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.traffics')}}" class="nav-link {{ Request::path() ==  'admin/traffics' ? 'active' : ''  }}">
                <i class="fa-solid fa-chart-line"></i>
                <p>
                    Traffic
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.customers')}}" class="nav-link {{ Request::path() ==  'admin/customers' ? 'active' : ''  }}">
                <i class="fa-solid fa-user"></i>
                <p>
                    Customers
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.social')}}" class="nav-link {{ Request::path() ==  'admin/social' ? 'active' : ''  }}">
                <i class="fa-solid fa-share-nodes"></i>
                <p>
                    Social Media Customers
                </p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>