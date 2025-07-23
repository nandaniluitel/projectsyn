<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Synergy | Accepted Reports</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <style>
    .accordion .btn-link {
      color: black !important;
      text-decoration: none;
    }

    .accordion .card-body {
      color: black;
    }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('nav.create')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('teachersidebar.create')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="width: 104%;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                {{-- Top Buttons --}}
                <div class="row mb-2 align-items-center">
                  <div class="col-sm-6">
                    <h1>Accepted Reports</h1>
                  </div>

                  <div class="col-sm-6 text-right d-flex justify-content-end align-items-center gap-2">
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
                      Show Filters
                    </button>
                  </div>
                </div>

                {{-- Collapsible Filter Form --}}
                <div class="row">
                  <div class="col-sm-12">
                    <div class="collapse" id="filterForm">
                      <form method="GET" action="{{ route('coordinator.accepted-projects') }}" class="form-inline mt-3 justify-content-end" id="filterFormElement">
                        <div class="form-group mx-2 mb-2">
                            <input type="text" name="title" class="form-control" placeholder="Search by Title" value="{{ request('title') }}">
                        </div>
                        <div class="form-group mx-2 mb-2">
                          <select name="year" class="form-control">
                            <option value="">-- Year --</option>
                            @foreach ($years as $year)
                              <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group mx-2 mb-2">
                          <select name="level" class="form-control">
                            <option value="">-- Level --</option>
                            @foreach ($levels as $level)
                              <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group mx-2 mb-2">
                          <select name="report_type" class="form-control">
                            <option value="">-- Report Type --</option>
                            @foreach ($report_types as $report_type)
                              <option value="{{ $report_type }}" {{ request('report_type') == $report_type ? 'selected' : '' }}>{{ $report_type }}</option>
                            @endforeach
                          </select>
                        </div>
                        <input type="hidden" name="view_mode" value="{{ request('view_mode', 'accordion') }}">
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                        <a href="{{ route('coordinator.accepted-projects') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
                      </form>
                    </div>
                  </div>
                </div>

                {{-- Bottom Button --}}
                <div class="row mt-2">
                  <div class="col-sm-12 text-right">
                    <form method="GET" action="{{ route('coordinator.accepted-projects') }}" style="margin-bottom:0;">
                      <input type="hidden" name="year" value="{{ request('year') }}">
                      <input type="hidden" name="level" value="{{ request('level') }}">
                      <input type="hidden" name="view_mode" value="{{ request('view_mode') === 'table' ? 'accordion' : 'table' }}">
                      <button type="submit" class="btn btn-secondary">
                        Switch to {{ request('view_mode') === 'table' ? 'Accordion' : 'Table' }} View
                      </button>
                    </form>
                  </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List of Accepted Reports</h3>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if(request('view_mode') === 'table')
                                  {{-- Table View --}}
                                  <table class="table table-bordered">
                                      <thead>
                                      <tr>
                                          <th>Group ID</th>
                                          <th>Group Title</th>
                                          <th>Project Level</th>
                                          <th>Report File</th>
                                          <th>Slides File</th>
                                          <th>Supervisor</th>
                                          <th>Report Type</th>
                                          <th>Uploaded At</th>
                                          <th>Status</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      @forelse ($projects as $project)
                                          <tr>
                                              <td>{{ $project->groupId }}</td>
                                              <td>{{ $project->group->title }}</td>
                                              <td>{{ $project->group->level }}</td>
                                              <td><a href="{{ Storage::url($project->_file) }}" target="_blank">View Report</a></td>
                                              <td>
                                              @if ($project->slides_file)
                                                          <a href="{{ Storage::url($project->slides_file) }}" target="_blank">View Slides</a>
                                              @else
                                                        No Slides
                                              @endif
                                              </td>
                                              <td>
                                                  @if ($project->supervisor)
                                                      {{ $project->supervisor->teacher->user->name }}
                                                  @else
                                                      N/A
                                                  @endif
                                              </td>
                                              <td>{{ $project->report_type }}</td>
                                              <td>{{ $project->created_at }}</td>
                                              <td>{{ $project->status }}</td>
                                          </tr>
                                      @empty
                                          <tr>
                                              <td colspan="9">No reports found.</td>
                                          </tr>
                                      @endforelse
                                      </tbody>
                                  </table>
                                @else
                                  {{-- Accordion View --}}
                                  <div class="accordion" id="projectAccordion">
                                    @forelse ($projects as $project)
                                      <div class="card">
                                        <div class="card-header" id="heading{{ $project->id }}">
                                          <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $project->id }}">
                                              Title: {{ $project->group->title }}
                                            </button>
                                          </h2>
                                        </div>
                                        <div id="collapse{{ $project->id }}" class="collapse" data-parent="#projectAccordion">
                                          <div class="card-body">
                                            <p><strong>Group ID:</strong> {{ $project->groupId }}</p>
                                            <p><strong>Project Level:</strong> {{ $project->group->level }}</p>
                                            <p><strong>Report File:</strong> <a href="{{ Storage::url($project->_file) }}" target="_blank">View Report</a></p>
                                            <p><strong>Slides File:</strong>
                                              @if ($project->slides_file)
                                                <a href="{{ Storage::url($project->slides_file) }}" target="_blank">View Slides</a>
                                              @else
                                                No Slides
                                              @endif
                                            </p>
                                            <p><strong>Supervisor:</strong>
                                              @if ($project->supervisor)
                                                {{ $project->supervisor->teacher->user->name }}
                                              @else
                                                N/A
                                              @endif
                                            </p>
                                            <p><strong>Report Type:</strong> {{ $project->report_type }}</p>
                                            <p><strong>Uploaded At:</strong> {{ $project->created_at }}</p>
                                            <p><strong>Status:</strong> {{ $project->status }}</p>
                                          </div>
                                        </div>
                                      </div>
                                    @empty
                                      <p>No reports found.</p>
                                    @endforelse
                                  </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Footer Text</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#filterForm').on('show.bs.collapse', function () {
      $('[data-target="#filterForm"]').text('Hide Filters');
    });
    $('#filterForm').on('hide.bs.collapse', function () {
      $('[data-target="#filterForm"]').text('Show Filters');
    });
  });
</script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
