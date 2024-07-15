<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @auth
                    @if(Auth::user()->Photo)
                        <img src="{{ asset('images/' . Auth::user()->Photo) }}" class="img-circle elevation-2" alt="User Image" >
                    @else
                        <img src="{{ asset('images/images.png') }}" class="img-circle elevation-2" alt="User Image">
                    @endif
                @endauth
            </div>
            <div class="info">
                @auth
                    <a href="{{ url('/profile') }}" class="d-block">{{ Auth::user()->name }}</a>
                @endauth
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
                    <a href="/dashboard/create" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/projects/create" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Register Group
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/uploadfiles/create" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Upload Files
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/supervisor/profile" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            View Supervisor Info
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/feedback/index" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Feedback
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <div class="form-inline">
            @auth
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <button class="btn btn-sidebar">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </button>
            @endauth
        </div>
    </div>
    <!-- /.sidebar -->
</aside>

<style>
    .nav-sidebar .nav-link p {
        line-height: 3;
    }
</style>
