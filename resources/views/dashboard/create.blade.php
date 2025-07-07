<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy | Student Dashboard</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('nav.create')
  @include('sidebar.create')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Dashboard</h1>
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

    <section class="content">
      <div class="container">

        <div class="row">
          <div class="col-md-12">
          <div id="notifications">

            @forelse ($notifications as $notification)
              <div class="alert alert-info" role="alert">
                <div class="d-flex justify-content-between align-items-start">
                  <div>
                    <p class="mb-1">
                      {{ $notification->message }}

                      {{-- Important Badge --}}
                      @if($notification->is_important)
                        <span class="badge badge-danger ml-2">Important</span>
                      @endif

                      {{-- Audience Badge --}}
                      @if($notification->target_audience === 'teachers')
                        <span class="badge badge-secondary ml-1">For Teachers</span>
                      @elseif($notification->target_audience === 'students')
                        <span class="badge badge-info ml-1">For Students</span>
                      @else
                        <span class="badge badge-success ml-1">All</span>
                      @endif

                      {{-- Student Year Badge --}}
                      @if(!empty($notification->student_year))
                        <span class="badge badge-warning ml-1">Batch {{ $notification->student_year }}</span>
                      @endif
                    </p>

                    {{-- File Link --}}
                    @if (!empty($notification->file))
                      <a href="{{ asset('storage/' . $notification->file) }}" download class="btn btn-sm btn-primary">
                        📎 Download Attachment
                      </a>
                    @endif
                  </div>

                  {{-- Timestamp --}}
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

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Project Synergy
    </div>
    <strong>&copy; 2024 Project Synergy</strong> All rights reserved.
  </footer>

</div>


</body>
</html>
