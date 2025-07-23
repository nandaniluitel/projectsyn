<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ProjEase | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>

  <!-- Navbar -->
  @include('nav.create')
  @include('teachersidebar.create')
  <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
  }

  .header {
    background: linear-gradient(to right, #795a9cff, #2575fc);
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
    flex-direction: column;
    align-items: stretch;
    gap: 15px;
  }

  .action-button {
    background-color: #ffffff;
    color: #333;
    border: 2px solid #e0e0e0;
    padding: 15px 30px;
    text-align: left;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .action-button:hover {
    background-color: #6a11cb;
    color: white;
    border-color: #6a11cb;
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
  }
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="header">
    <h1>Supervisor Page</h1>
  </div>
<div class="wrapper">

<div class="content-wrapper">
  <div class="fullContainer">
    
    
    <div class="actions-container">

     <a href="{{ route('scanner.capture') }}" class="scan-btn">
      <i class="fas fa-qrcode"></i> Scan Student ID
    </a>

    <a href="{{ route('chat.index') }}" class="scan-btn">
      <i class="fas fa-comments"></i> View Chat Rooms
    </a>
        
        <a href="{{ route('supervisor.assignedgroups') }}" class="action-button">View Assigned groups</a>
        <a href="{{ route('supervisor.reports.all') }}" class="action-button">View Project Files </a>
        <a href="{{ route('supervisor.pendingFiles') }}" class="action-button">View Pending Files</a>
        <a href="{{ route('supervisor.rejectedFiles') }}" class="action-button">View Rejected Files</a>
        
        <a href="{{ route('supervisor.assignedgroups') }}" class="action-button">Send Feedback to students</a>
    </div> 
  </div>


        <!-- <div class="aboutUsContainer">
            <div class="featuredSchoolsHeader">
                <h3>About Us</h3>
            </div>
            <p>Welcome to our platform, a dedicated space designed to streamline the project submission and grading process for students and teachers alike. Our mission is to facilitate seamless interaction between students and educators, enhancing the learning experience through efficient project management and evaluation. From the moment students upload their projects to the time teachers provide their feedback and grades, we are here to support and simplify every step of the educational journey. We believe that a robust educational platform empowers both teaching and learning, and our goal is to provide the tools necessary to make managing educational tasks as straightforward as possible. Dive in and discover how easy and effective educational collaboration can be!</p>
        </div>
    </div> -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
</body>
</html>
