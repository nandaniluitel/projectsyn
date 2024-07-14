<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rejected Files</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('nav.create')
    @include('teachersidebar.create')

    <div class="content-wrapper" style="width: 110%;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Rejected Files</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Rejected Files</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Project ID</th>
                                <th>Title</th>
                                <th>Report Type</th>
                                <th>Report File</th>
                                <th>Slides File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rejectedProjects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>
                                        @if ($project->projectGroup)
                                            {{ $project->projectGroup->title }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $project->report_type }}</td>
                                    <td>
                                        <a href="{{ Storage::url($project->report_file) }}">Download</a>
                                    </td>
                                    <td>
                                        @if ($project->slides_file)
                                            <a href="{{ Storage::url($project->slides_file) }}">Download</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <strong>Footer Text</strong>
    </footer>
</div>

<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
