<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProjEase | Assign Roles</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 600;
        }
        .fullContainer {
            padding: 40px 20px;
            max-width: 1200px;
            margin: auto;
        }
        .actions-container {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 30px;
            flex-wrap: wrap;
        }
        .action-card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            width: 350px;
            display: flex;
            flex-direction: column;
            text-align: center;
            padding: 25px;
        }
        .action-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
        }
        .action-card .card-icon {
            font-size: 3rem;
            color: #6a11cb;
            margin-bottom: 20px;
        }
        .action-card .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: auto;
            padding-bottom: 20px;
        }
        .action-card .btn {
            font-weight: bold;
            border-radius: 8px;
            margin-top: 15px;
            background-color: #ffffff;
            color: #333;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .action-card .btn:hover {
            background-color: #6a11cb;
            border-color: #6a11cb;
            color: #ffffff;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('nav.create')
    @include('teachersidebar.create')

    <div class="content-wrapper">
        <div class="header">
            <h1>Assign Roles</h1>
        </div>

        <section class="content">
            <div class="fullContainer">
                <div class="actions-container">
                    <!-- Assign Supervisors Card -->
                    <div class="action-card">
                        <div class="card-icon"><i class="fas fa-user-tie"></i></div>
                        <h2 class="card-title">Assign Supervisors</h2>
                        <a href="{{ route('assignsupervisor.create') }}" class="btn btn-primary">Go to Assignment</a>
                    </div>

                    <!-- Assign Evaluator and Coordinator Card -->
                    <div class="action-card">
                        <div class="card-icon"><i class="fas fa-users-cog"></i></div>
                        <h2 class="card-title">Assign Evaluator & Coordinator</h2>
                        <a href="{{ route('assignroles.create') }}" class="btn btn-primary">Go to Assignment</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            ProjEase
        </div>
        <strong>Copyright &copy; 2023-2024 <a href="#">ProjEase</a>.</strong> All rights reserved.
    </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>