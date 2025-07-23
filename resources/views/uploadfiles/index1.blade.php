@extends('layouts.master')

@section('title', 'Project Synergy | Uploaded Files')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Uploaded Files</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Uploaded Files</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
                    Show/Hide Filters
                </button>
            </div>
            <div class="col-md-6 text-right">
                <form method="GET" action="{{ route('uploadfiles.index1') }}" class="d-inline">
                    <input type="hidden" name="year" value="{{ request('year') }}">
                    <input type="hidden" name="level" value="{{ request('level') }}">
                    <input type="hidden" name="view_mode" value="{{ request('view_mode') == 'accordion' ? 'table' : 'accordion' }}">
                    <button type="submit" class="btn btn-secondary">Switch View</button>
                </form>
            </div>
        </div>

        {{-- Collapsible Filter Form --}}
        <div class="collapse" id="filterForm">
            <div class="card card-body mb-3">
                <form method="GET" action="{{ route('uploadfiles.index1') }}" class="form-inline">
                    <div class="form-group mx-2 mb-2">
                        <label for="year" class="mr-2">Year</label>
                        <select name="year" id="year" class="form-control">
                            <option value="">All Years</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mx-2 mb-2">
                        <label for="level" class="mr-2">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="">All Levels</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="view_mode" value="{{ request('view_mode', 'table') }}">
                    <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    <a href="{{ route('uploadfiles.index1') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
                </form>
            </div>
        </div>

        @if (request('view_mode', 'table') == 'table')
            @include('uploadfiles.partials.table_view', ['projects' => $projects])
        @else
            @include('uploadfiles.partials.accordion_view', ['projects' => $projects])
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .accordion-header a {
        color: #000;
        text-decoration: none;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#filterForm').on('show.bs.collapse', function () {
        $('button[data-target="#filterForm"]').text('Hide Filters');
    });
    $('#filterForm').on('hide.bs.collapse', function () {
        $('button[data-target="#filterForm"]').text('Show Filters');
    });

    // Ensure the filter state is maintained after page load
    if ($('#filterForm').hasClass('show')) {
        $('button[data-target="#filterForm"]').text('Hide Filters');
    }
});
</script>
@endpush
