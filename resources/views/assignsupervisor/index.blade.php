

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Assigned Supervisors Index</title>

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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assigned Supervisors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assigned Supervisors</li>
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
                <h3 class="card-title">List of Assigned Supervisors</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if ($assignedGroups->isEmpty())
                  <div class="alert alert-info">
                    No supervisors assigned yet.
                  </div>
                @else
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Group ID</th>
                        <th>Supervisor Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($assignedGroups as $assignedGroup)
                        <tr>
                          <td>{{ $assignedGroup->groupId }}</td>
                          <td>
                            @if ($assignedGroup->teacher && $assignedGroup->teacher->user)
                              {{ $assignedGroup->teacher->user->name }}
                            @else
                              No Supervisor Assigned
                            @endif
                          </td>
                          <td>
                            <!-- Action Buttons or Links -->
                            <form action="{{ route('assignsupervisor.remove', $assignedGroup->groupId) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this supervisor?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @endif
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


@push('scripts')
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
@endpush

@push('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
@endpush
