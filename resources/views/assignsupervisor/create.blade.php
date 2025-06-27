<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy| Assign Supervisor</title>
 
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2 align-items-center">
      <div class="col-sm-6">
        <h1>Assign Supervisor</h1> {{-- or Assign Roles --}}
      </div>
      <div class="col-sm-6 text-right">
        <!-- Toggle Filters Button -->
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
          Show Filters
        </button>
      </div>
    </div>

    <!-- Collapsible Filter Form -->
    <div class="row">
      <div class="col-sm-12">
        <div class="collapse" id="filterForm">
          <form method="GET" action="{{ route('assignsupervisor.create') }}" class="form-inline mt-3 justify-content-end">
            <div class="form-group mx-2">
              <select name="year" class="form-control" onchange="this.form.submit()">
                <option value="">-- Year --</option>
                @foreach ($years as $year)
                  <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mx-2">
              <select name="level" class="form-control" onchange="this.form.submit()">
                <option value="">-- Level --</option>
                @foreach ($levels as $level)
                  <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                @endforeach
              </select>
            </div>
            <a href="{{ route('assignsupervisor.create') }}" class="btn btn-secondary ml-2">Reset</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Project Groups</h3>
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
                                        <th>Title</th>
                                        <th>Assign Supervisor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $group)
                                        <tr>
                                            <td>{{ $group->id }}</td>
                                            <td>{{ $group->title }}</td>
                                            <td>
                                                <form action="{{ route('assignsupervisor.assign') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <select name="supervisorId" class="form-control">
                                                            <option value="" disabled selected>Choose</option>
                                                            @foreach($supervisors as $supervisor)
                                                                <option value="{{ $supervisor->teacherId }}">{{ $supervisor->supervisorName }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="groupId" value="{{ $group->id }}">
                                                </td>
                                            <td>
                                                <!-- Action Buttons or Links -->
                                                <button type="submit" class="btn btn-primary">Assign</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <a href="{{ route('assignsupervisor.index') }}" class="btn btn-info">View Assigned Groups</a>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Footer information &copy; 2024 </strong>
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
