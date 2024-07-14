
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy | General Form Elements</title>

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
            <h1>Evaluation Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
<section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Evaluation Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('evaluations.store') }}" class="form-horizontal">
    @csrf
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <input type="hidden" name="evaluatorId" value="{{ $evaluatorId }}">
        <div class="form-group">
                                    <label for="ProjectID">Project Title:</label>
                                    <select class="form-control" id="ProjectID" name="ProjectID" required>
                                        <option value="" disabled selected>Select Project Title</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

        <div class="form-group">
            <label for="Phase">Phase:</label>
            <select class="form-control" id="Phase" name="Phase" required>
                <option value="" disabled selected>Select Phase</option>
                <option value="proposal">Proposal</option>
                <option value="midterm">Mid Term</option>
                <option value="final">Final</option>
            </select>
        </div>
        <div class="form-group">
            <label for="reportMarks">Report Marks:</label>
            <input type="number" class="form-control" id="reportMarks" name="reportMarks" required>
        </div>
        <div class="form-group">
            <label for="presentationMarks">Presentation Marks:</label>
            <input type="number" class="form-control" id="presentationMarks" name="presentationMarks" required>
        </div>
        <div class="form-group">
            <label for="qaMarks">Q&A Marks:</label>
            <input type="number" class="form-control" id="qaMarks" name="qaMarks" required>
        </div>
        <div class="form-group">
            <label for="demoMarks">Demo Marks:</label>
            <input type="number" class="form-control" id="demoMarks" name="demoMarks" required>
        </div>
        <div class="form-group">
            <label for="feedback">Feedback:</label>
            <textarea class="form-control" id="feedback" name="feedback" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>                     
</section>
</body>
</html>






