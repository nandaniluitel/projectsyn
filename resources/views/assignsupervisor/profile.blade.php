@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-center">Assigned Supervisors</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @forelse ($supervisors as $projectTitle => $projectSupervisors)
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Project: {{ $projectTitle }}</h3>
                    </div>
                    <div class="card-body">
                        @if ($projectSupervisors->isEmpty())
                            <p class="text-muted">No supervisors found for this project group.</p>
                        @else
                            <div class="row">
                                @foreach ($projectSupervisors as $supervisor)
                                    <div class="col-md-6 col-lg-4">
                                        <!-- Widget: user widget style 1 -->
                                        <div class="card card-widget widget-user shadow-sm">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header bg-light-indigo text-white" style="background: #6610f2; color: #fff;">
                                                <h3 class="widget-user-username text-center">{{ $supervisor->name }}</h3>
                                                <h5 class="widget-user-desc text-center">{{ $supervisor->email }}</h5>
                                            </div>
                                            <div class="widget-user-image">
                                                @if($supervisor->Photo)
                                                    <img class="img-circle elevation-2" src="{{ asset('images/' . $supervisor->Photo) }}" alt="User Photo">
                                                @else
                                                    <img class="img-circle elevation-2" src="{{ asset('images/images.png') }}" alt="Default Photo">
                                                @endif
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Phone</h5>
                                                            <span>{{ $supervisor->Phone_number ?? 'Not Available' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="card">
                    <div class="card-body text-center">
                        <p class="text-muted">No projects with assigned supervisors found.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <!-- /.content -->
</div>
@endsection

