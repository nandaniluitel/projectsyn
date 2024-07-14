<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accepted Files</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('nav.create')
  @include('teachersidebar.create')
  <div class="content-wrapper" style="width: 110%;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Accepted Files</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Accepted Files</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Accepted Files</h3>
              </div>
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
                      <th>Project ID</th>
                      <th>Title</th>
                      <th>Report Type</th>
                      <th>Report File</th>
                      <th>Slides File</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($acceptedFiles as $file)
  <tr>
    <td>{{ $file->id }}</td>
    <td>
      @if ($file->projectGroup)
        {{ $file->projectGroup->title }} {{-- Assuming title is a property of ProjectGroup --}}
      @else
        N/A
      @endif
    </td>
    <td>{{ $file->report_type }}</td>
    <td><a href="{{ Storage::url($file->report_file) }}">Download</a></td>
    <td>
      @if ($file->slides_file)
        <a href="{{ Storage::url($file->slides_file) }}">Download</a>
      @else
        N/A
      @endif
    </td>
  </tr>
@endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
