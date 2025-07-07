<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Synergy | Notifications</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('nav.create')
  @include('teachersidebar.create')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Notification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Notifications</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Create Notification</h3>
              </div>
              <div class="card-body">

                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('notification.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required>{{ old('message') }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="file">File (Optional):</label>
                    <input type="file" class="form-control-file" id="file" name="file">
                  </div>

                  <div class="form-group">
                    <label for="target_audience">Target Audience:</label>
                    <select name="target_audience" id="target_audience" class="form-control">
                      <option value="both" {{ old('target_audience') === 'both' ? 'selected' : '' }}>All (Teachers & Students)</option>
                      <option value="students" {{ old('target_audience') === 'students' ? 'selected' : '' }}>Students Only</option>
                      <option value="teachers" {{ old('target_audience') === 'teachers' ? 'selected' : '' }}>Teachers Only</option>
                    </select>
                  </div>

                  <div class="form-group" id="studentYearField">
                    <label for="student_year">Student Batch Year (if applicable):</label>
                    <select name="student_year" id="student_year" class="form-control">
                      <option value="">All Batches</option>
                      @foreach ($years as $year)
                        <option value="{{ $year }}" {{ old('student_year') == $year ? 'selected' : '' }}>
                          {{ $year }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>
                      <input type="checkbox" name="is_important" id="is_important" value="1" {{ old('is_important') ? 'checked' : '' }}>
                      Mark as Important
                    </label>
                  </div>

                  <div class="form-group" id="expiresAtField" style="display: none;">
                    <label for="expires_at">Visible Until (for important notices)</label>
                    <input type="datetime-local" class="form-control" name="expires_at" value="{{ old('expires_at') }}">
                  </div>

                  <button type="submit" class="btn btn-primary">Publish</button>
                </form>

                <div class="mt-3">
                  <a href="{{ route('notification.index') }}" class="btn btn-secondary">View Published Notifications</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const targetSelect = document.getElementById('target_audience');
    const yearField = document.getElementById('studentYearField');
    const isImportant = document.getElementById('is_important');
    const expiresAtField = document.getElementById('expiresAtField');

    function toggleYearField() {
      yearField.style.display = (targetSelect.value === 'students' || targetSelect.value === 'both') ? 'block' : 'none';
    }

    function toggleExpiresField() {
      expiresAtField.style.display = isImportant.checked ? 'block' : 'none';
    }

    targetSelect.addEventListener('change', toggleYearField);
    isImportant.addEventListener('change', toggleExpiresField);

    toggleYearField();   // Initial on load
    toggleExpiresField();
  });
</script>
</body>
</html>
