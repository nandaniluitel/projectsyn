<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Proposal Reports</title>

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
    <div class="content-wrapper" style="width: 104%;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Proposal Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Supervisor.assignedgroups') }}">Assigned Groups</a></li>
                            <li class="breadcrumb-item active">Proposal Reports</li>
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
                                        <th>Group ID</th>
                                        <th>Group Title</th>
                                        <th>Level</th> <!-- New column for Level -->
                                        <th>Report File</th>
                                        <th>Slides File</th>
                                        <th>Report Type</th>
                                        <th>Uploaded At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($proposalReports as $report)
                                        <tr>
                                            <td>{{ $report->groupId }}</td>
                                            <td>{{ $report->group->title }}</td>
                                            <td>{{ $report->group->level }}</td> <!-- Display Level -->
                                            <td><a href="{{ asset('storage/' . $report->report_file) }}" target="_blank">View Report</a></td>
                                            <td><a href="{{ asset('storage/' . $report->slides_file) }}" target="_blank">View Slides</a></td>
                                            <td>{{ $report->report_type }}</td>
                                            <td>{{ $report->created_at }}</td>
                                            <td>
                                                @if ($report->status == 'accept')
                                                    <a href="{{ route('report.view', $report->id) }}" class="btn btn-primary">View</a>
                                                @else
                                                    <span class="text-muted">Not available</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">No proposal reports found.</td>
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
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
