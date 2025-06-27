<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy | Projects Index</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<style>
.accordion .btn-link {
  color: black !important;
  text-decoration: none;
}

.accordion .card-body {
  color: black;
}
</style>

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
        <h1>Projects Index</h1>
      </div>

      <div class="col-sm-6 text-right d-flex justify-content-end align-items-center gap-2">
        <!-- Toggle Filters Button only -->
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
          Show Filters
        </button>
      </div>
    </div>

    {{-- Collapsible Filter Form --}}
    <div class="row">
      <div class="col-sm-12">
        <div class="collapse" id="filterForm">
          <form method="GET" action="{{ route('projects.index') }}" class="form-inline mt-3 justify-content-end" id="filterFormElement">
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
            <input type="hidden" name="view_mode" value="{{ request('view_mode', 'accordion') }}">
            <a href="{{ route('projects.index') }}" class="btn btn-secondary mb-2">Reset</a>
          </form>
        </div>
      </div>
    </div>

    {{-- Bottom Button --}}
    <div class="row mt-2">
      <div class="col-sm-12 text-right">
        <!-- View Mode Toggle Form only -->
        <form method="GET" action="{{ route('projects.index') }}" style="margin-bottom:0;">
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
                <h3 class="card-title">List of Project Groups</h3>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                @if ($view_mode === 'table')
                  {{-- Table View --}}
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Project Group Title</th>
                        <th>Description</th>
                        <th>Level</th>
                        <th>Students</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($project_groups as $project_group)
                        <tr>
                          <td>{{ $project_group->title }}</td>
                          <td>{{ $project_group->description }}</td>
                          <td>{{ $project_group->level }}</td>
                          <td>
                            <ul>
                              @forelse ($project_group->students as $student)
                                <li>{{ $student->user->name }} ({{ $student->id }})</li>
                              @empty
                                <li>No students assigned</li>
                              @endforelse
                            </ul>
                          </td>
                          <td>
                            <a href="{{ route('projects.edit', $project_group->id) }}" class="btn btn-primary btn-sm">Edit</a>
                          </td>
                        </tr>
                      @empty
                        <tr><td colspan="5">No project groups found.</td></tr>
                      @endforelse
                    </tbody>
                  </table>
                @else
                  {{-- Accordion View --}}
                  <div class="accordion" id="projectAccordion">
                    @forelse ($project_groups as $project_group)
                      <div class="card">
                        <div class="card-header" id="heading{{ $project_group->id }}">
                          <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $project_group->id }}">
                              Title: {{ $project_group->title }}
                            </button>
                          </h2>
                        </div>
                        <div id="collapse{{ $project_group->id }}" class="collapse" data-parent="#projectAccordion">
                          <div class="card-body">
                            <p><strong>Description:</strong> {{ $project_group->description }}</p>
                            <p><strong>Level:</strong> {{ $project_group->level }}</p>
                            <p><strong>Year:</strong> {{ $project_group->year }}</p>
                            <p><strong>Students:</strong></p>
                            <ul>
                              @forelse ($project_group->students as $student)
                                <li>{{ $student->user->name }} ({{ $student->id }})</li>
                              @empty
                                <li>No students assigned</li>
                              @endforelse
                            </ul>
                            <a href="{{ route('projects.edit', $project_group->id) }}" class="btn btn-primary btn-sm">Edit</a>
                          </div>
                        </div>
                      </div>
                    @empty
                      <p>No project groups found.</p>
                    @endforelse
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">Anything you want</div>
    <strong>Footer information &copy; 2024</strong>
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
