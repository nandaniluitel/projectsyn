@extends('layouts.app')

@section('content')


<style>
    .header-gradient {
        background: linear-gradient(135deg, #6f42c1, #a569bd);
        color: white;
        padding: 2rem;
        border-radius: 1rem 1rem 0 0;
        text-align: center;
    }

    .card-custom {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-label {
        font-weight: 600;
        color: #5a5a5a;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 0.6rem;
        padding: 0.75rem;
        font-size: 1rem;
    }

    .btn-purple {
        background-color: #8e44ad;
        color: white;
        font-weight: 600;
        border-radius: 0.6rem;
        padding: 0.6rem 1.5rem;
    }

    .btn-purple:hover {
        background-color:rgb(159, 85, 124);
    }

    .btn-secondary {
        border-radius: 0.6rem;
        padding: 0.6rem 1.5rem;
    }
</style>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-custom">
                <div class="header-gradient">
                    <h2><i class="bi bi-pencil-square me-2"></i>Edit Evaluation Status</h2>
                    <p class="mb-0">Update the current status of the selected evaluation</p>
                </div>
    <div class="card-body p-5"></div>
    <form action="{{ route('evaluations.update', $evaluation->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Select New Status</label>
            <select name="status" class="form-control" required>
                <option value="approved" {{ $evaluation->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="pending" {{ $evaluation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="rejected" {{ $evaluation->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update Status</button>
        <a href="{{ route('evaluations.index') }}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
@endsection
