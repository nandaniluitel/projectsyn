<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy | Accepted Evaluations</title>

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
            <h1>Accepted Evaluations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Accepted Evaluations</li>
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
                <h3 class="card-title">List of Accepted Evaluations</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Evaluator Name</th>
                      <th>Project Title</th>
                      <th>Phase</th>
                      <th>Report Marks</th>
                      <th>Presentation Marks</th>
                      <th>QA Marks</th>
                      <th>Demo Marks</th>
                      <th>Feedback</th>
                      <th>Status</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($evaluations as $evaluation)
                      <tr>
                        <td>{{ $evaluation->evaluator->teacher->user->name }}</td>
                        <td>{{ $evaluation->project->group->title }}</td>
                        <td>{{ $evaluation->phase }}</td>
                        <td>{{ $evaluation->reportMarks }}</td>
                        <td>{{ $evaluation->presentationMarks }}</td>
                        <td>{{ $evaluation->qaMarks }}</td>
                        <td>{{ $evaluation->demoMarks }}</td>
                        <td>{{ $evaluation->feedback }}</td>
                        <td>{{ $evaluation->status }}</td>
                        <td>{{ $evaluation->created_at }}</td>
                      </tr>
                    @endforeach
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div
 +