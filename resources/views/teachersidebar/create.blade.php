<aside class="main-sidebar sidebar-light-indigo">
    <!-- Brand Logo -->
    <a href="{{ url('/teacher/dashboard') }}" class="brand-link">
      <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ProjEase</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @auth
                @if(Auth::user()->Photo)
                    <img src="{{ asset('images/' . Auth::user()->Photo) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('images/images.png') }}" class="img-circle elevation-2" alt="User Image">
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
          
          <li class="nav-header">MAIN NAVIGATION</li>
          <li class="nav-item">
            <a href="{{ url('/teacherdashboard') }}" class="nav-link {{ request()->is('/teacherdashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">ROLES</li>
          <li class="nav-item">
            <a href="{{ url('/Coordinator/index') }}" class="nav-link {{ request()->is('Coordinator*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>Coordinator</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/Supervisor/index') }}" class="nav-link {{ request()->is('Supervisor*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Supervisor</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/Evaluator/index') }}" class="nav-link {{ request()->is('Evaluator*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Evaluator</p>
            </a>
          </li>

          <li class="nav-header">PROJECTS & FILES</li>
          <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>All Projects</p>
            </a>
          </li>

          <li class="nav-item">
    <a href="{{ url('/report-format') }}" class="nav-link {{ request()->is('report-format') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Report Format</p>
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
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>{{ __('Logout') }}</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo1.js"></script>
<style>
    .nav-sidebar .nav-link p {
        line-height: 3;
    }
  </style>