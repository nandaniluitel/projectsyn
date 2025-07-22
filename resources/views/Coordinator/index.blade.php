<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ProjEase | Coordinator Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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

    /* Updated search + scan container */
    .search-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      margin-bottom: 30px;
    }
    .search-container form {
      display: flex;
    }
    .search-container input[type="text"] {
      width: 300px;
      padding: 10px;
      border-radius: 5px 0 0 5px;
      border: 1px solid #ccc;
      font-size: 1rem;
      border-right: none;
    }
    .search-container button.search-btn {
      padding: 10px 20px;
      border-radius: 0 5px 5px 0;
      border: 1px solid #2575fc;
      background-color: #2575fc;
      color: white;
      font-size: 1rem;
      cursor: pointer;
    }
    .search-container a.scan-btn {
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      background-color: #28a745;
      color: white;
      font-size: 1rem;
      text-decoration: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .search-container a.scan-btn:hover {
      background-color: #218838;
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

      {{-- SEARCH + SCAN BAR --}}
      <div class="search-container">
        <form action="{{ route('coordinator.search') }}" method="GET">
          <input type="text" name="student_id" placeholder="Enter User ID">
          <button type="submit" class="search-btn">Search</button>
        </form>
        <a href="{{ route('scanner.capture') }}" class="scan-btn">
          <i class="fas fa-qrcode"></i> Scan Student ID
        </a>
      </div>

      <div class="actions-container">
        <a href="{{ route('assignroles.index') }}" class="action-button">Assign Roles</a>
        <a href="{{ route('projects.index') }}" class="action-button">View Registered Groups</a>
        <a href="{{ route('coordinator.accepted-projects') }}" class="action-button">View Accepted Projects</a>
        <a href="{{ route('assignroles.coordinators') }}" class="action-button">View Coordinators</a>
        <a href="{{ route('notification.create') }}" class="action-button">Send Notifications</a>
        {{-- Removed Scan button from here since it’s now in the top bar --}}
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
