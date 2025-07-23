<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy | Teacher Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  
  <!-- Custom Notification Styles -->
  <style>
    /* Purple Harmony Notification Theme */
    .notification-card {
      background: #f8f6ff !important;
      border: 1px solid #d9d1f2 !important;
      border-radius: 8px;
      padding: 16px 20px;
      margin-bottom: 12px;
      color: #2d3748;
      box-shadow: none;
    }
    
    .notification-card .badge-important {
      background-color: #dc3545 !important; /* Red for high priority */
      color: white !important;
      padding: 5px 8px;
      border-radius: 4px;
      font-size: 16px;
      font-weight: bold;
      border: none;
    }
    
    .notification-card .badge-teachers,
    .notification-card .badge-students,
    .notification-card .badge-all {
      background-color: #28a745 !important; /* Green for audience */
      color: white !important;
      padding: 5px 8px;
      border-radius: 4px;
      font-size: 16px;
      font-weight: bold;
      border: none;
    }
    
    .notification-card .badge-year {
      background-color: #ffc107 !important; /* Yellow for info */
      color: white !important;
      padding: 5px 8px;
      border-radius: 4px;
      font-size: 16px;
      font-weight: bold;
      border: none;
    }
    
    .notification-card .btn-download {
      background-color: #8b5cf6 !important;
      color: white !important;
      border: none;
      padding: 8px 14px;
      border-radius: 4px;
      font-size: 16px;
      margin-top: 8px;
      text-decoration: none !important;
    }
    
    .notification-card .btn-download:hover {
      background-color: #7c3aed !important;
      text-decoration: none !important;
    }
    
    .notification-card .text-muted {
      color: #6b7280 !important;
      font-size: 14px;
    }
    
    .notification-card p {
      margin-bottom: 8px;
      line-height: 1.4;
      font-size: 17px;
    }
    
    /* Remove default alert styling */
    .notification-card.alert {
      border-left: none;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('nav.create')

  <!-- Main Sidebar -->
  @include('teachersidebar.create')

  <!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Teacher Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container">

        <div class="row">
          <div class="col-md-12">
            <div id="notifications">

              @forelse ($notifications as $notification)
                <div class="alert notification-card" role="alert">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <p class="mb-1">
                        {{ $notification->message }}

                        {{-- Important Badge --}}
                        @if($notification->is_important)
                          <span class="badge badge-important ml-2">Important</span>
                        @endif

                        {{-- Audience Badge --}}
                        @if($notification->target_audience === 'teachers')
                          <span class="badge badge-teachers ml-1">For Teachers</span>
                        @elseif($notification->target_audience === 'students')
                          <span class="badge badge-students ml-1">For Students</span>
                        @else
                          <span class="badge badge-all ml-1">All</span>
                        @endif

                        {{-- Student Year --}}
                        @if($notification->student_year)
                          <span class="badge badge-year ml-1">Year {{ $notification->student_year }}</span>
                        @endif
                      </p>

                      {{-- File Link --}}
                      @if (!empty($notification->file))
                        <a href="{{ asset('storage/' . $notification->file) }}" download class="btn btn-sm btn-download">
                          Download Attachment
                        </a>
                      @endif
                    </div>

                    {{-- Time --}}
                    <small class="text-muted">
                      {{ $notification->created_at->diffForHumans() }}
                    </small>
                  </div>
                </div>
              @empty
                <p>No notifications found.</p>
              @endforelse

            </div>
          </div>
        </div>

      </div>
    </section>

  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Project Synergy
    </div>
    <strong>&copy; 2024 Project Synergy</strong> All rights reserved.
  </footer>

</div>

<!-- jQuery -->
<!-- <script src="/adminlte/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="/adminlte/dist/js/adminlte.min.js"></script> -->

</body>
</html>