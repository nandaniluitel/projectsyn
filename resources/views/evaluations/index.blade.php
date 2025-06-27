{{-- resources/views/evaluations/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy | Evaluations Index</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('nav.create')
  @include('teachersidebar.create')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Evaluations Index</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Evaluations Index</li>
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
                <h3 class="card-title">List of Evaluations</h3>
              </div>

              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Evaluator Name</th>
                      <th>Project Title</th>
                      <th>Phase</th>
                      <th>Report</th>
                      <th>Presentation</th>
                      <th>QA</th>
                      <th>Demo</th>
                      <th>Feedback</th>
                      <th>Status</th>
                      <th>Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($evaluations as $evaluation)
                      <tr>
                        <td>{{ $evaluation->evaluator->teacher->user->name ?? 'N/A' }}</td>
                        <td>{{ $evaluation->project->group->title ?? 'N/A' }}</td>
                        <td>{{ ucfirst($evaluation->phase) }}</td>
                        <td>{{ $evaluation->reportMarks }}</td>
                        <td>{{ $evaluation->presentationMarks }}</td>
                        <td>{{ $evaluation->qaMarks }}</td>
                        <td>{{ $evaluation->demoMarks }}</td>
                        <td>{{ $evaluation->feedback }}</td>
                        <td>
                          <span class="badge 
                            @if($evaluation->status == 'approved') badge-success 
                            @elseif($evaluation->status == 'rejected') badge-danger 
                            @else badge-warning @endif">
                            {{ ucfirst($evaluation->status) }}
                          </span>
                        </td>
                        <td>{{ $evaluation->created_at->format('Y-m-d') }}</td>
                        <td>
                          <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-sm btn-primary">
                            Edit
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <!-- Filter Buttons -->
                <div class="mt-4">
                  <a href="{{ route('evaluations.rejected') }}" class="btn btn-danger">View Rejected Projects</a>
                  <a href="{{ route('evaluations.accepted') }}" class="btn btn-success">View Accepted Projects</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">Powered by Laravel</div>
    <strong>Project Synergy &copy; 2024</strong>
  </footer>
</div>

<!-- Scripts -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
