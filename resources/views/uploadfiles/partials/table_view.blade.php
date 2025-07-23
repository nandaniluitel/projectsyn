<table class="table table-bordered table-striped">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Project Title</th>
            <th>Report Type</th>
            <th>Year</th>
            <th>Level</th>
            <th>Files</th>
            <th>Uploaded At</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->group->title ?? 'N/A' }}</td>
                <td>{{ ucfirst($project->report_type) }}</td>
                <td>{{ $project->group->year ?? 'N/A' }}</td>
                <td>{{ $project->group->level ?? 'N/A' }}</td>
                <td>
                    @if ($project->report_file)
                        <a href="{{ asset('storage/' . $project->report_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">View Report</a>
                    @endif
                    @if ($project->slides_file)
                        <a href="{{ asset('storage/' . $project->slides_file) }}" target="_blank" class="btn btn-outline-info btn-sm">View Slides</a>
                    @endif
                </td>
                <td>{{ $project->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No project files found matching your criteria.</td>
            </tr>
        @endforelse
    </tbody>
</table>
