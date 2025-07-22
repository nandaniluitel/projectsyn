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
<style>
.accordion .btn-link {
  color: black !important;
  text-decoration: none;
}

.accordion .card-body {
  color: black;
}
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('nav.create')
  @include('teachersidebar.create')

  <div class="content-wrapper">
    <section class="content-header">
    <div class="container-fluid">
        {{-- Top Buttons --}}
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1>Evaluations Index</h1>
            </div>
            <div class="col-sm-6 text-right d-flex justify-content-end align-items-center gap-2">
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
                    Show Filters
                </button>
            </div>
        </div>

        {{-- Collapsible Filter Form --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="collapse" id="filterForm">
                    <form method="GET" action="{{ route('evaluations.index') }}" class="form-inline mt-3 justify-content-end">
                        <div class="form-group mx-2 mb-2">
                            <select name="year" class="form-control" onchange="this.form.submit()">
                                <option value="">-- Year --</option>
                                @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mx-2 mb-2">
                            <select name="level" class="form-control" onchange="this.form.submit()">
                                <option value="">-- Level --</option>
                                @foreach ($levels as $level)
                                <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="view_mode" value="{{ request('view_mode', 'table') }}">
                        <a href="{{ route('evaluations.index') }}" class="btn btn-secondary mb-2">Reset</a>
                    </form>
                     <div class="mt-2 text-right">
                      <a href="{{ route('evaluations.rejected') }}" class="btn btn-danger">View Rejected Projects</a>
                      <a href="{{ route('evaluations.accepted') }}" class="btn btn-success">View Accepted Projects</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- View Mode Switcher --}}
        <div class="row mt-2">
            <div class="col-sm-12 text-right">
                <form method="GET" action="{{ route('evaluations.index') }}" class="d-inline">
                    <input type="hidden" name="year" value="{{ request('year') }}">
                    <input type="hidden" name="level" value="{{ request('level') }}">
                    <input type="hidden" name="view_mode" value="{{ request('view_mode') === 'table' ? 'accordion' : 'table' }}">
                    <button type="submit" class="btn btn-secondary">
                        Switch to {{ request('view_mode') === 'table' ? 'Accordion' : 'Table' }} View
                    </button>
                </form>
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

    @if ($evaluations->isEmpty())
        <div class="alert alert-info">
            No evaluations found.
        </div>
    @else
        @if(request('view_mode', 'table') === 'table')
            {{-- Table View --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Evaluator</th>
                        <th>Project</th>
                        <th>Phase</th>
                        <th>Marks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluations as $evaluation)
                    <tr>
                        <td>{{ $evaluation->evaluator->teacher->user->name ?? 'N/A' }}</td>
                        <td>{{ $evaluation->project->group->title ?? 'N/A' }}</td>
                        <td>{{ ucfirst($evaluation->phase) }}</td>
                        <td>
                            Report: {{ $evaluation->reportMarks }} <br>
                            Presentation: {{ $evaluation->presentationMarks }} <br>
                            QA: {{ $evaluation->qaMarks }} <br>
                            Demo: {{ $evaluation->demoMarks }}
                        </td>
                        <td>
                            <span class="badge @if($evaluation->status == 'approved') badge-success @elseif($evaluation->status == 'rejected') badge-danger @else badge-warning @endif">
                                {{ ucfirst($evaluation->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            {{-- Accordion View --}}
            <div class="accordion" id="evaluationAccordion">
                @foreach ($evaluations as $index => $evaluation)
                <div class="card">
                    <div class="card-header" id="heading{{ $index }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $index }}">
                                {{ $evaluation->project->group->title ?? 'N/A' }} ({{ ucfirst($evaluation->phase) }})
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}" data-parent="#evaluationAccordion">
                        <div class="card-body">
                            <p><strong>Evaluator:</strong> {{ $evaluation->evaluator->teacher->user->name ?? 'N/A' }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge @if($evaluation->status == 'approved') badge-success @elseif($evaluation->status == 'rejected') badge-danger @else badge-warning @endif">
                                    {{ ucfirst($evaluation->status) }}
                                </span>
                            </p>
                            <p><strong>Marks:</strong>
                                Report: {{ $evaluation->reportMarks }}, 
                                Presentation: {{ $evaluation->presentationMarks }}, 
                                QA: {{ $evaluation->qaMarks }}, 
                                Demo: {{ $evaluation->demoMarks }}
                            </p>
                            <p><strong>Feedback:</strong> {{ $evaluation->feedback ?? 'N/A' }}</p>
                            <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    @endif
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
<script>
  $(document).ready(function() {
    $('#filterForm').on('show.bs.collapse', function () {
      $('[data-target="#filterForm"]').text('Hide Filters');
    });
    $('#filterForm').on('hide.bs.collapse', function () {
      $('[data-target="#filterForm"]').text('Show Filters');
    });
  });
</script>
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
