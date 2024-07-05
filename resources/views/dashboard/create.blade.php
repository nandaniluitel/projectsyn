
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

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

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Student Dashboard</h1>
                <div id="notifications">
                    @foreach ($notifications as $notification)
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">{{ $notification->title }}</h4>
                            <p>{{ $notification->message }}</p>
                        </div>
                    @endforeach

                    @if (empty($notifications))
                        <p>No notifications found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

</body>
</html>
