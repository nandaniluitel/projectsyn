{{-- resources/views/uploadfiles/index.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Files</title>
</head>
<body>
    <h1>Uploaded Files</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($projects->count() > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Group ID</th>
                    <th>Report File</th>
                    <th>Slides File</th>
                    <th>Supervisor ID</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->groupId }}</td>
                        <td>
                            <a href="{{ Storage::url($project->report_file) }}" target="_blank">View Report</a>
                        </td>
                        <td>
                            @if ($project->slides_file)
                                <a href="{{ Storage::url($project->slides_file) }}" target="_blank">View Slides</a>
                            @else
                                No Slides
                            @endif
                        </td>
                        <td>{{ $project->supervisor_id }}</td>
                        <td>{{ $project->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No files uploaded yet.</p>
    @endif

    <a href="{{ route('uploadfiles.create') }}">Upload New Files</a>
</body>
</html>
