<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Assigned Groups</title>

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
            <h1>Assigned Groups</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assigned Groups</li>
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
                <h3 class="card-title">List of Assigned Groups</h3>
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
                      <th>ID</th>
                      <th>Group Title</th>
                      <th>Description</th>
                      <th>Level</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($assignedGroups as $group)
                      <tr>
                        <td>{{ $group->id }}</td>
                        <td><a href="{{ route('Supervisor.assignedgroups.reports', ['groupId' => $group->id]) }}">{{ $group->title }}</a></td>
                        <td>{{ $group->description }}</td>
                        <td>{{ $group->level }}</td>
                        <td>
                        <a href="{{ route('feedback.create', ['groupId' => $group->id]) }}" class="btn btn-primary">Feedback</a>
                        </td>

                      </tr>
                    @empty
                      <tr>
                        <td colspan="4">No assigned groups found.</td>
                      </tr>
                    @endforelse
                  </
