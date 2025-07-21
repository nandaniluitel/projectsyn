<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ProjEase | Coordinator Dashboard</title>

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
      margin: 0;
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
    .search-container {
      margin-bottom: 30px;
      text-align: center;
    }
    .search-container input[type="text"] {
        width: 300px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }
    .search-container button {
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        background-color: #2575fc;
        color: white;
        font-size: 1rem;
        cursor: pointer;
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
  @include('nav.create')
  @include('teachersidebar.create')

  <div class="header">
    <h1>Coordinator Page</h1>
  </div>
  
  <div class="content-wrapper">
    <div class="fullContainer">
        <div class="search-container">
            <form action="{{ route('coordinator.search') }}" method="GET">
                <input type="text" name="student_id" placeholder="Enter Student ID">
                <button type="submit">Search</button>
            </form>
        </div>

      <div class="actions-container">
        <a href="{{ route('assignroles.index') }}" class="action-button">Assign Roles</a>
        <a href="{{ route('projects.index') }}" class="action-button">View Registered Groups</a>
        <a href="{{ route('coordinator.accepted-projects') }}" class="action-button">View Accepted Projects</a>
        <a href="{{ route('assignroles.coordinators') }}" class="action-button">View Coordinators</a>
        <a href="{{ route('notification.create') }}" class="action-button">Send Notifications</a>
        <a href="{{ route('scanner.capture') }}" class="action-button">Scan Student ID</a>
        <a href="{{ route('assignroles.evaluators') }}" class="action-button">View Evaluators</a>
        <a href="{{ route('assignsupervisor.index') }}" class="action-button">View Supervisors</a>
        <a href="{{ route('evaluations.index') }}" class="action-button">View Evaluated Marks</a>
        <a href="{{ route('coordinator.proposal-reports') }}" class="action-button">View Proposal and Slides</a>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
