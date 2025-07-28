<aside class="main-sidebar sidebar-light-indigo">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @auth
                @if(Auth::user()->Photo)
                    <img src="{{ asset('images/' . Auth::user()->Photo) }}" class="img-circle" alt="User Image">
                @else
                    <img src="{{ asset('images/images.png') }}" class="img-circle" alt="User Image">
                @endif
            @endauth
        </div>
        <div class="info">
          <a href="{{ url('/profile') }}" class="d-block">{{ Auth::user()->name }}</a>
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
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
                    <a href="{{ route('dashboard.create') }}" class="nav-link {{ request()->routeIs('dashboard.create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
            </a>
          </li>
          <li class="nav-item">
                    <a href="/projects/create" class="nav-link {{ request()->is('projects/create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Register Group
                        </p>
            </a>
          </li>
          <li class="nav-item">
                    <a href="/uploadfiles/create" class="nav-link {{ request()->is('uploadfiles/create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Upload Files
                        </p>
            </a>
          </li>

          

          <li class="nav-item">
          <a href="/supervisor/profile" class="nav-link {{ request()->is('supervisor/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            View Supervisor Info
                        </p>
            </a>
          </li>

          <li class="nav-header">ACCOUNT</li>
          <li class="nav-item">
            <a href="{{ url('/profile') }}" class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/feedback/index" class="nav-link {{ request()->is('feedback/index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                    Feedback
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
                <li class="nav-item">
                    <a href="{{ route('chat.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Chat</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<style>
    .nav-sidebar .nav-link p {
        line-height: 3;
    }
</style>
