<div class="accordion" id="projectsAccordion">
    @forelse ($projects as $project)
        <div class="card">
            <div class="card-header accordion-header" id="heading{{ $project->id }}">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $project->id }}" aria-expanded="true" aria-controls="collapse{{ $project->id }}">
                        {{ $project->group->title ?? 'N/A' }} ({{ $project->group->year ?? 'N/A' }} - Level {{ $project->group->level ?? 'N/A' }})
                    </button>
                </h2>
            </div>

            <div id="collapse{{ $project->id }}" class="collapse" aria-labelledby="heading{{ $project->id }}" data-parent="#projectsAccordion">
                <div class="card-body">
                    <p><strong>Report Type:</strong> {{ ucfirst($project->report_type) }}</p>
                    <p><strong>Uploaded At:</strong> {{ $project->created_at->format('Y-m-d H:i') }}</p>
                    <p>
                        @if ($project->report_file)
                            <a href="{{ asset('storage/' . $project->report_file) }}" target="_blank" class="btn btn-primary btn-sm">View Report</a>
                        @endif
                        @if ($project->slides_file)
                            <a href="{{ asset('storage/' . $project->slides_file) }}" target="_blank" class="btn btn-info btn-sm">View Slides</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">No project files found matching your criteria.</div>
    @endforelse
</div>
