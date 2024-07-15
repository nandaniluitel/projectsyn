<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search Results</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <!-- Navbar -->
  @include('nav.create')
  @include('teachersidebar.create')

  <!-- Content Wrapper. Contains page content -->
  <div class="header">
    <h1>Search Results</h1>
  </div>
  
  <div class="wrapper">
    <div class="content-wrapper">
      <div class="fullContainer">

        @if($student)
          <h5>Student Details:</h5>
          <p><strong>ID:</strong> {{ $student->user->id }}</p>
          <p><strong>Name:</strong> {{ $student->user->name }}</p>
          <p><strong>Email:</strong> {{ $student->user->email }}</p>
          <p><strong>Phone Number:</strong> {{ $student->user->phone_number }}</p>

          <h5>Projects:</h5>
          <ul>
            @foreach($projectTitles as $projectId => $projectTitle)
              <li>{{ $projectTitle }}</li>
            @endforeach
          </ul>

          @if(!empty($evaluationDetails))
            <h5>Projects and Evaluation Details:</h5>
            <ul>
              @foreach($evaluationDetails as $evaluation)
                <li>
                  <strong>Project Title:</strong> {{ $evaluation['project']->title }}<br>
                  <strong>Project Phase:</strong> {{ $evaluation['phase'] }}<br>
                  <strong>Project Final Status:</strong> {{ $evaluation['status'] }}
                </li>
              @endforeach
            </ul>
          @else
            <p>No evaluations found for the projects.</p>
          @endif

        @else
          <p>No student found with the given ID.</p>
        @endif

      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/adminlte/dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
</body>
</html>
