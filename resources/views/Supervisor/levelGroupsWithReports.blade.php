<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Synergy | All Groups and Reports</title>

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
                        <h1>All Assigned Groups and Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">All Assigned Groups and Reports</li>
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
                            <div class="card-header">
                                <h3 class="card-title">List of Assigned Groups and Reports</h3>
                                <div class="card-tools">
                                    <form action="{{ route('supervisor.levelGroups') }}" method="GET" class="input-group input-group-sm" style="width: 150px;">
                                        <input type="number" name="level" class="form-control float-right" placeholder="Enter Level">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group ID</th>
                                            <th>Group Title</th>
                                            <th>Description</th>
                                            <th>Level</th>
                                            <th>Project Type</th>
                                            <th>Report File</th>
                                            <th>Slides File</th>
                                            <th>Supervisor</th>
                                            <th>Uploaded At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($assignedGroups as $group)
                                            @foreach ($group->projects as $report)
                                                <tr>
                                                    <td>{{ $group->id }}</td>
                                                    <td>{{ $group->title }}</td>
                                                    <td>{{ $group->description }}</td>
                                                    <td>{{ $group->level }}</td>
                                                    <td>{{ $report->report_type }}</td>
                                                    <td>
                                                        <a href="{{ Storage::url($report->report_file) }}" target="_blank">View Report</a>
                                                    </td>
                                                    <td>
                                                        @if ($report->slides_file)
                                                            <a href="{{ Storage::url($report->slides_file) }}" target="_blank">View Slides</a>
                                                        @else
                                                            No Slides
                                                        @endif
                                                    </td>
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
                                                            <select name="status" onchange="this.form.submit()" class="form-control" {{ $report->status == 'accepted' ? 'disabled' : '' }}>
                                                                <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="accepted" {{ $report->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                                                <option value="rejected" {{ $report->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        @if ($report->status == 'rejected')
                                                            <a href="{{ route('feedback.create', ['groupId' => $group->id]) }}" class="btn btn-primary">Feedback</a>
                                                        @else
                                                            <span class="text-muted">Not available</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="11">No assigned groups found.</td>
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
