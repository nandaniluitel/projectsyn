<!-- resources/views/coordinator/assign_roles.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Assign Roles</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('coordinator.assignRoles') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="teacher_id">Select Teacher:</label>
            <select name="teacher_id" id="teacher_id" class="form-control">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="role">Select Role:</label>
            <select name="role" id="role" class="form-control">
                <option value="coordinator">Coordinator</option>
                <option value="evaluator">Evaluator</option>
                <option value="supervisor">Supervisor</option>
            </select>
        </div>

        <div class="form-group" id="groupIdField" style="display:none;">
            <label for="groupId">Select Project Group:</label>
            <select name="groupId" id="groupId" class="form-control">
                @foreach($projectGroups as $projectGroup)
                    <option value="{{ $projectGroup->id }}">{{ $projectGroup->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign Role</button>
    </form>
</div>

<script>
    document.getElementById('role').addEventListener('change', function() {
        var groupIdField = document.getElementById('groupIdField');
        if (this.value === 'supervisor') {
            groupIdField.style.display = 'block';
        } else {
            groupIdField.style.display = 'none';
        }
    });
</script>
@endsection
