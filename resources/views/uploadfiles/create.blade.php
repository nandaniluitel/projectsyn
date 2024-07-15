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
    @include('sidebar.create')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>General Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
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
                                <h3 class="card-title">Upload Files Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- Form start -->
                            <form method="POST" action="{{ route('uploadfiles.store') }}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body" id="maincard">

                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <!-- Project Title Dropdown -->
                                    <div class="form-group row">
                                        <label for="projectTitle" class="col-sm-2 col-form-label">Select Your Project Title</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="projectTitle" name="projectTitle" required>
                                                <option value="" disabled selected>Select Your Project Title</option>
                                                @foreach($projectTitles as $projectId => $projectTitle)
                                                    <option value="{{ $projectId }}">{{ $projectTitle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Supervisor ID Dropdown -->
                                    <div class="form-group row">
                                        <label for="supervisor_id" class="col-sm-2 col-form-label">Select Your Supervisor Name</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="supervisor_id" name="supervisor_id" required>
                                                <option value="" disabled selected>Select Your Supervisor</option>
                                                @foreach($supervisors as $supervisor)
                                                    <option value="{{ $supervisor->id }}">{{ $supervisor->teacher->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <!-- Upload Report -->
                                    <div class="form-group row">
                                        <label for="reportType" class="col-sm-2 col-form-label">Report Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="reportType" name="reportType" onchange="toggleSupervisorField()">
                                                <option value="proposal">Proposal</option>
                                                <option value="midterm">Midterm</option>
                                                <option value="final">Final</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="reportFile" class="col-sm-2 col-form-label">Report File</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="reportFile" name="reportFile" required>
                                        </div>
                                    </div>

                                    <!-- Optional Slide Section -->
                                    <div id="slideSection" style="display: none;">
                                        <div class="form-group row">
                                            <label for="slideType" class="col-sm-2 col-form-label">Slide Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="slideType" name="slideType">
                                                    <option value="proposal">Proposal</option>
                                                    <option value="midterm">Midterm</option>
                                                    <option value="final">Final</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="slideFile" class="col-sm-2 col-form-label">Slide File</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" id="slideFile" name="slideFile">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button to show optional slide section -->
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button type="button" class="btn btn-primary" id="addSlideButton" onclick="showSlideSection()">Add Slide</button>
                                        </div>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="reset" class="btn btn-default float-right">Cancel</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>

                            <script>
                                function showSlideSection() {
                                    var slideSection = document.getElementById('slideSection');
                                    slideSection.style.display = 'block';
                                    var addSlideButton = document.getElementById('addSlideButton');
                                    addSlideButton.style.display = 'none';
                                }

                                function toggleSupervisorField() {
                                    var reportType = document.getElementById('reportType').value;
                                    var supervisorField = document.getElementById('supervisor_id');

                                    if (reportType === 'proposal') {
                                        supervisorField.required = false;
                                        supervisorField.parentNode.parentNode.style.display = 'none';
                                    } else {
                                        supervisorField.required = true;
                                        supervisorField.parentNode.parentNode.style.display = 'flex';
                                    }
                                }

                                // Call toggleSupervisorField on page load to set initial state
                                window.onload = toggleSupervisorField;
                            </script>

                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo1.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
</body>
</html>
