<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Synergy | Proposal Reports</title>

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
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1>Proposal Reports</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
                            Show/Hide Filters
                        </button>
                    </div>
                </div>

                <div class="collapse" id="filterForm">
                    <form method="GET" action="{{ route('coordinator.proposal-reports') }}" class="form-inline mt-3 justify-content-end">
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
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                        <a href="{{ route('coordinator.proposal-reports') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
                    </form>
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
