{{-- resources/views/report-format.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Report-Format</title>

  <!-- AdminLTE & FontAwesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">

  <style>
    .chat-sidebar {
      width: 280px;
      height: calc(100vh - 100px);
      overflow-y: auto;
      border-right: 1px solid #dee2e6;
      background: #f8f9fa;
    }
    .chat-sidebar .list-group-item {
      border: none;
      border-bottom: 1px solid #e9ecef;
      padding: 12px 16px;
      transition: background .2s;
    }
    .chat-sidebar .list-group-item.active,
    .chat-sidebar .list-group-item:hover {
      background: #e2e6ea;
    }

    .chat-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      height: calc(100vh - 100px);
    }
    .chat-header {
      padding: 16px;
      border-bottom: 1px solid #dee2e6;
      background: #ffffff;
    }
    .chat-header h2 {
      margin: 0;
      font-size: 1.5rem;
      text-align: center;
      font-weight: 600;
    }
    .chat-body {
      flex-grow: 1;
      padding: 16px;
      overflow-y: auto;
      background: #fffffff;
    }
    .chat-empty {
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #888;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    {{-- Navbar --}}
    @include('nav.create')

    {{-- Sidebar --}}
    @if(!empty($isTeacher) && $isTeacher)
      @include('teachersidebar.create')
    @elseif(!empty($isStudent) && $isStudent)
      @include('sidebar.create')
    @endif

    {{-- Page content --}}
    <div class="content-wrapper">
      <div class="container-fluid p-0 d-flex">
        >



@extends('layouts.app')

@section('content')


    @php
        use Illuminate\Support\Facades\File;
        $files = File::files(public_path('storage/report-formats'));
    @endphp

    <div class="container mt-5">
        <h2>📄 Report Format Templates</h2>

        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover align-middle">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col">Format Name</th>
                        <th scope="col" style="width: 15%;">Type</th>
                        <th scope="col" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $index => $file)
                        @php
                            $fileName   = $file->getFilename(); // e.g. "Proposal-Format.docx"
                            $base       = pathinfo($fileName, PATHINFO_FILENAME);
                            $prettyName = ucwords(str_replace(['-', '_'], ' ', $base));
                            $ext        = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                            // icon & styling
                            $icon    = $ext === 'pdf' ? 'file-pdf' : 'file-word';
                            $color   = $ext === 'pdf' ? 'text-danger' : 'text-primary';
                            $btnType = $ext === 'pdf' ? 'outline-danger' : 'outline-primary';
                            $isPdf   = $ext === 'pdf';
                        @endphp
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $prettyName }}.{{ strtoupper($ext) }}</td>
                            <td>
                                <i class="fas fa-{{ $icon }} {{ $color }}"></i>
                                <span class="ms-1">{{ strtoupper($ext) }}</span>
                            </td>
                            <td>
                                <a href="{{ asset('storage/report-formats/' . $fileName) }}"
                                   class="btn btn-{{ $btnType }} btn-sm"
                                   @if($isPdf) target="_blank" @else download @endif>
                                    {{ $isPdf ? '📄 View' : '📥 Download' }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No format files available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
