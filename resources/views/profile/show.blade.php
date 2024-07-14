<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>
<body style="background-color: #f4f6f9; font-family: 'Source Sans Pro', sans-serif;">


<!-- <div class="wrapper"> -->
    @include('nav.create')
    @if($isTeacher)
        @include('teachersidebar.create')
    @elseif($isStudent)
        @include('sidebar.create')
    @endif
    <div class="content-wrapper" style="margin: 20px auto; max-width: 800px; background: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <div class="content-header">
            <h1 class="text-center" style="font-weight: 700; margin-bottom: 20px;">User Profile</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="profile-info" style="border-top: 1px solid #ddd; padding-top: 20px;">
            <div class="text-center" style="margin-bottom: 20px; margin-top:20px;">
                @if($user->Photo)
                    <img src="{{ asset('images/' . $user->Photo) }}" alt="User Photo" style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover; border: 3px solid #007bff;">
                @else
                    <img src="{{ asset('images/images.png') }}" alt="Default Photo" style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover; border: 3px solid #007bff;">
                @endif
            </div>

            <p style="font-size: 18px; line-height: 1.6; padding-top:20px;"><strong>Name:</strong> {{ $user->name }}</p>
            <p style="font-size: 18px; line-height: 1.6;"><strong>Email:</strong> {{ $user->email }}</p>
            <p style="font-size: 18px; line-height: 1.6;"><strong>Phone Number:</strong> {{ $user->Phone_number }}</p>
           
        </div>

        <div class="text-center" style="margin-top: 20px;">
            <a href="{{ url('/') }}" class="btn btn-primary" style="padding: 10px 20px; font-size: 16px;">Home</a>
        </div>
    </div>
<!-- </div> -->

<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
