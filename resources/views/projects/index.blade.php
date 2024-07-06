<!-- resources/views/projects/index.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file named 'app.blade.php' -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Project Groups</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @forelse ($project_groups as $project_group)
                                <li class="list-group-item">
                                    <h4>{{ $project_group->title }}</h4>
                                    <p><strong>Description:</strong> {{ $project_group->description }}</p>
                                    <p><strong>Level:</strong> {{ $project_group->level }}</p>

                                    <h5>Students:</h5>
                                    <ul>
                                        @forelse ($project_group->students as $student)
                                            <li>{{ $student->name }} ({{ $student->id }})</li>
                                        @empty
                                            <li>No students assigned</li>
                                        @endforelse
                                    </ul>
                                </li>
                            @empty
                                <li class="list-group-item">No project groups found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
