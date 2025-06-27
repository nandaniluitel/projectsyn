{{-- resources/views/uploadfiles/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy | Uploaded Files</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('nav.create')

  <!-- Main Sidebar Container -->
  @include('teachersidebar.create')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Uploaded Files</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Uploaded Files</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content section -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Uploaded Files</h3>
              </div>

              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                @if ($projects->count() > 0)
                  <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th>ID</th>
                        <th>Project Title</th>
                        <th>Report File</th>
                        <th>Slides File</th>
                        <th>Report Type</th>
                        <th>Supervisor ID</th>
                        <th>Uploaded At</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($projects as $project)
                        <tr>
                          <td>{{ $project->id }}</td>
                          <td>{{ $project->group->title }}</td>

                          {{-- Report File --}}
                          <td>
                            @if ($project->report_file)
                              <a href="{{ asset('storage/' . $project->report_file) }}" 
                                 target="_blank" 
                                 class="btn btn-outline-primary btn-sm">
                                📄 View Report
                              </a>
                            @else
                              <span class="text-muted">No Report</span>
                            @endif
                          </td>

                          {{-- Slides File --}}
                          <td>
                            @if ($project->slides_file)
                              <a href="{{ asset('storage/' . $project->slides_file) }}" 
                                 target="_blank" 
                                 class="btn btn-outline-success btn-sm">
                                📊 View Slides
                              </a>
                            @else
                              <span class="text-muted">No Slides</span>
                            @endif
                          </td>

                          <td>{{ ucfirst($project->report_type) }}</td>
                          <td>{{ $project->supervisor_id ?? 'N/A' }}</td>
                          <td>{{ $project->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <p>No files uploaded yet.</p>
                @endif
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Empowering Innovation
    </div>
    <strong>&copy; 2024 Project Synergy</strong>
  </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
