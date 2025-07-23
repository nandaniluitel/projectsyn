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
  <style>
    .accordion .btn-link {
      color: black !important;
      text-decoration: none;
    }
  </style>
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

        {{-- Top Buttons --}}
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                {{-- This column can be used for the title if needed, or left empty --}}
            </div>
            <div class="col-sm-6 text-right">
                {{-- Filter Button --}}
                <button id="filter-toggle-btn" class="btn btn-info" type="button" data-toggle="collapse" data-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
                    Show Filters
                </button>
            </div>
        </div>

        {{-- Collapsible Filter Form --}}
        <div class="collapse" id="filterForm">
            <div class="card card-body">
                <form method="GET" action="{{ route('supervisor.assignedgroups') }}" class="form-inline" id="filterFormElement">
                    <div class="form-group mx-2 mb-2">
                        <label for="title" class="mr-2">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ request('title') }}" placeholder="Search by title">
                    </div>
                    <div class="form-group mx-2 mb-2">
                        <label for="year" class="mr-2">Year</label>
                        <select name="year" id="year" class="form-control">
                            <option value="">-- Select Year --</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mx-2 mb-2">
                        <label for="level" class="mr-2">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="">-- Select Level --</option>
                            @foreach($levels as $level)
                                <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="view_mode" value="{{ request('view_mode', 'accordion') }}">
                    <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    <a href="{{ route('supervisor.assignedgroups') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
                </form>
            </div>
        </div>

        {{-- Bottom Button --}}
        <div class="row mt-2">
            <div class="col-sm-12 text-right">
                {{-- Switch View Button --}}
                <form method="GET" action="{{ route('supervisor.assignedgroups') }}" style="margin-bottom:0;">
                    <input type="hidden" name="title" value="{{ request('title') }}">
                    <input type="hidden" name="year" value="{{ request('year') }}">
                    <input type="hidden" name="level" value="{{ request('level') }}">
                    <input type="hidden" name="view_mode" value="{{ $view_mode === 'table' ? 'accordion' : 'table' }}">
                    <button type="submit" class="btn btn-secondary">
                        Switch to {{ $view_mode === 'table' ? 'Accordion' : 'Table' }} View
                    </button>
                </form>
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

                @if ($view_mode === 'table')
                    {{-- Table View --}}
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Group Title</th>
                          <th>Description</th>
                          <th>Level</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($assignedGroups as $group)
                          <tr>
                            <td>{{ $group->id }}</td>
                            <td><a href="{{ route('supervisor.assignedgroups.reports', ['groupId' => $group->id]) }}">{{ $group->title }}</a></td>
                            <td>{{ $group->description }}</td>
                            <td>{{ $group->level }}</td>
                            <td>
                                <a href="{{ route('feedback.create', ['groupId' => $group->id]) }}" class="btn btn-primary">Feedback</a>
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="5">No assigned groups found.</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                @else
                    {{-- Accordion View --}}
                    <div class="accordion" id="assignedGroupsAccordion">
                        @forelse ($assignedGroups as $group)
                            <div class="card">
                                <div class="card-header" id="heading{{ $group->id }}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $group->id }}">
                                            {{ $group->title }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{ $group->id }}" class="collapse" data-parent="#assignedGroupsAccordion">
                                    <div class="card-body">
                                        <p><strong>Description:</strong> {{ $group->description }}</p>
                                        <p><strong>Level:</strong> {{ $group->level }}</p>
                                        <p><strong>Year:</strong> {{ $group->year }}</p>
                                        <a href="{{ route('supervisor.assignedgroups.reports', ['groupId' => $group->id]) }}" class="btn btn-info btn-sm">View Reports</a>
                                        <a href="{{ route('feedback.create', ['groupId' => $group->id]) }}" class="btn btn-primary btn-sm">Feedback</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No assigned groups found.</p>
                        @endforelse
                    </div>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">ProjectSynergy</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>

{{-- JavaScript for filter button text --}}
@section('scripts')
<script>
    $(document).ready(function() {
        $('#filterForm').on('shown.bs.collapse', function () {
            $('#filter-toggle-btn').text('Hide Filters');
        }).on('hidden.bs.collapse', function () {
            $('#filter-toggle-btn').text('Show Filters');
        });

        // Keep filter section open if filters are active
        if ($('#year').val() || $('#level').val()) {
            $('#filterForm').collapse('show');
        }
    });
</script>
@endsection

</body>
</html>
