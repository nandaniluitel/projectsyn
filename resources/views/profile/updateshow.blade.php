<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="Phone_number">Phone Number:</label>
            <input type="text" id="Phone_number" name="Phone_number" value="{{ $user->Phone_number }}">
        </div>
        <div>
            <label for="semester">Semester:</label>
            <input type="text" id="semester" name="semester" value="{{ $user->semester }}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div>
            <label for="Photo">Photo:</label>
            <input type="file" id="Photo" name="Photo">
            @if($user->Photo)
                <img src="{{ asset('images/' . $user->Photo) }}" alt="User Photo" width="100">
            @endif
        </div>
        <div>
            <button type="submit">Update Profile</button>
        </div>
    </form>
</body>
</html>
