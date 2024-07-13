<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Submit Feedback</title>

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
                            <h1>Submit Feedback</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Submit Feedback</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create New Feedback</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    {{-- Display success message if it exists --}}
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    {{-- Feedback creation form --}}
                                    <form action="{{ route('feedback.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="group_id">Select Project</label>
                                            <select name="group_id" id="group_id" class="form-control" required>
                                                <option value="">Choose...</option> {{-- Placeholder --}}
                                                <option value="{{ $group->id }}">{{ $group->title }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="feedback_text">Feedback</label>
                                            <textarea name="feedback_text" id="feedback_text" class="form-control" rows="4" required></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Footer information &copy; 2024 </strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.min.js"></script>

    <!-- Display success message script -->
    @if(session('success'))
    <script>
        $(function () {
            toastr.success('{{ session('success') }}');
        });
    </script>
    @endif
</body>

</html>
