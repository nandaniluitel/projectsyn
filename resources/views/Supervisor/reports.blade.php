<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Reports for Group: {{ $group->title }}</title>

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
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('teachersidebar.create')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="width: 110%;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reports for Group: {{ $group->title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('Supervisor.assignedgroups') }}">Assigned Groups</a></li>
              <li class="breadcrumb-item active">Reports for Group: {{ $group->title }}</li>
            </ol>
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
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Report File</th>
                      <th>Slides File</th>
                      <th>Supervisor</th>
                      <th>Uploaded At</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($reports as $report)
                      <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->report_file }}</td>
                        <td>{{ $report->slides_file }}</td>
                        <td>
                          @if ($report->supervisor && $report->supervisor->teacher && $report->supervisor->teacher->user)
                            {{ $report->supervisor->teacher->user->name }}
                          @else
                            N/A
                          @endif
                        </td>
                        <td>{{ $report->created_at }}</td>
                        <td>
                          <form action="{{ route('report.update-status', $report->id) }}" method="POST">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="form-control">
                              <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                              <option value="accepted" {{ $report->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                              <option value="rejected" {{ $report->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                          </form>
                        </td>
                        <td>
                          @if ($report->status == 'reject')
                            <a href="{{ route('feedback.create', ['groupId' => $group->id]) }}" class="btn btn-primary">Feedback</a>
                          @else
                            <span class="text-muted">Not available</span>
                          @endif
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7">No reports found for this group.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
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
 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
