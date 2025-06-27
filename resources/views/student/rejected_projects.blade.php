<!-- <!DOCTYPE html>
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
  @include('sidebar.create')
  <div class="content-wrapper" style="width: 110%;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rejected Projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rejected Projects</li>
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
                <h3 class="card-title">List of Rejected Projects</h3>
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
                    <th>Project Title</th>
                <th>Phase</th>
                <th>Feedback</th>
                <th>Rejected On</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($rejectedProjects as $project)
                <tr>
                    <td>{{ $project['title'] }}</td>
                    <td>{{ ucfirst($project['phase']) }}</td>
                    <td>{{ $project['feedback'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($project['rejected_at'])->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No rejected evaluations found.</td>
                </tr>
            @endforelse

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html> -->
