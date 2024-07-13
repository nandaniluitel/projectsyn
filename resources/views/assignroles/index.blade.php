<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Roles</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('nav.create')
        <!-- Main Sidebar Container -->
        @include('teachersidebar.create')
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Assign Roles</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Assign Roles</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="custom-card mb-3" style="width: 300px; height: 300px; margin: 2px; text-align: center; padding: 20px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h1 class="card-title mb-4">Assign Supervisor</h1>
                                    <!-- Link to assign supervisors -->
                                    <a href="{{ route('assignsupervisor.create') }}" class="btn btn-primary">Assign Supervisors</a>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="custom-card mb-3" style="width: 300px; height: 300px; margin: 2px; text-align: center; padding: 20px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h1 class="card-title mb-4">Assign Evaluator and Coordinator</h1>
                                    <!-- Link to assign evaluators and coordinators -->
                                    <a href="{{ route('assignroles.create') }}" class="btn btn-primary">Assign Evaluator and Coordinators</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
