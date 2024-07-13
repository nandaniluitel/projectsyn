<!-- assignsupervisor.profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Source Sans Pro', sans-serif;
            margin: 0;
            padding: 0;
        }
        .content-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .alert {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
        }
        .profile-info {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center; /* Center-aligning profile info */
        }
        .profile-info img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #007bff;
            margin: 0 auto 15px;
            display: block;
        }
        .profile-info p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

@include('nav.create')
@include('sidebar.create')

<div class="content-wrapper" style="margin: 20px auto; max-width: 800px; background: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
    <div class="content-header">
        <h1 class="text-center" style="font-weight: 700; margin-bottom: 20px;">Supervisors</h1>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        @foreach ($supervisors as $projectTitle => $projectSupervisors)
            <h2>Project: {{ $projectTitle }}</h2>
            @if ($projectSupervisors->isEmpty())
                <p>No supervisors found for this project group.</p>
            @else
                @foreach ($projectSupervisors as $supervisor)
                    <div class="profile-info">
                        <div>
                            @if($supervisor->Photo)
                                <img src="{{ asset('images/' . $supervisor->Photo) }}" alt="User Photo">
                            @else
                                <img src="{{ asset('images/images.png') }}" alt="Default Photo">
                            @endif
                        </div>
                        <p><strong>Name:</strong> {{ $supervisor->name }}</p>
                        <p><strong>Email:</strong> {{ $supervisor->email }}</p>
                        <p><strong>Phone Number:</strong> {{ $supervisor->Phone_number }}</p>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>

<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
