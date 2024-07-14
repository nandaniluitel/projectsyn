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
  @include('sidebar.create')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Project Form</h3>
                    </div>
                    <form method="POST" action="{{ route('projects.store') }}" class="form-horizontal">
                        @csrf
                        <div class="card-body" id="maincard">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Project Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" placeholder="Project Title" name="title" required>
                                    @error('title')
                                    <span class="invalid-feedback alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Project Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="description" placeholder="Project Description" name="description">
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="levelSelect" class="col-sm-2 col-form-label">Project Level</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="levelSelect" name="level" required>
                                        <option value="level1">Project-1</option>
                                        <option value="level2">Project-2</option>
                                        <option value="level3">Project-3</option>
                                    </select>
                                    @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div id="crnFields">
                                <div class="form-group row" id="crn-0-group">
                                    <label for="crn-0" class="col-sm-2 col-form-label">TEAM MEMBER CRN:</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control mb-2 crn-input" name="crns[]" id="crn-0" placeholder="CRN (e.g., 020319)" required>
                                        @error('crns.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('crns'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('crns') }}</strong>
                            </div>
                            @endif
                            <hr>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="button" class="btn btn-primary addCrnField">Add Another CRN</button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submitBtn" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-default float-right">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
    $(document).ready(function() {
        $('#submitBtn').click(function() {
            alert('Submitting form...'); // You can replace alert with any other method
        });

        var maxCrns = 3; // Maximum number of CRNs allowed
        var crnIndex = 1; // To ensure unique IDs for dynamically added fields

        // Function to add CRN field
        $('.addCrnField').click(function() {
            if (crnIndex < maxCrns) {
                var newField = '<div class="form-group row" id="crn-' + crnIndex + '-group">'+
                               '<label for="crn-' + crnIndex + '" class="col-sm-2 col-form-label">TEAM MEMBER CRN:</label>'+
                               '<div class="col-sm-10">'+
                               '<input type="number" class="form-control mb-2 crn-input" name="crns[]" id="crn-' + crnIndex + '" placeholder="CRN (e.g., 020319)" required>'+
                               '</div>'+
                               '</div>';

                $('#crnFields').append(newField);
                crnIndex++;
            } else {
                alert('You can only add up to ' + maxCrns + ' CRNs.');
            }
        });
    });
</script>
</body>
</html>
