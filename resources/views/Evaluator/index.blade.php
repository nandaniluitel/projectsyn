<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ProjEase | Evaluator Dashboard</title>

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
    /* Header now stacked vertically */
    .header {
      display: flex;
      flex-direction: column;
      align-items: center;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .header h1 {
      margin: 0;
      font-size: 2rem;
      font-weight: 600;
    }
    .header a.scan-btn {
      margin-top: 15px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      border-radius: 5px;
      background-color: #28a745;
      color: white;
      font-size: 1rem;
      text-decoration: none;
      transition: background-color 0.3s;
    }
    .header a.scan-btn:hover {
      background-color: #218838;
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
  @include('nav.create')
  @include('teachersidebar.create')

  <div class="header">
    <h1>Evaluator Page</h1>
  </div>
  


  <div class="content-wrapper">
    <div class="fullContainer">
      <div class="actions-container">
        <a href="{{ route('scanner.capture') }}" class="scan-btn">
      <i class="fas fa-qrcode"></i> Scan Student ID
    </a>
        <a href="{{ route('projects.index') }}" class="action-button">View Registered Groups</a>
        <a href="{{ route('uploadfiles.index1') }}" class="action-button">View Project Files</a>
        <a href="{{ route('evaluations.create') }}" class="action-button">Evaluate Group</a>
        {{-- Scan link removed from here --}}
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
