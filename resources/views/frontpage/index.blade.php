<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontpage</title>
    <link rel="stylesheet" href="frontpage.css">
</head>
<style>
    
    .container3 {
    background-image: url('/images/Logo.png');
    height: 100vh;
    background-repeat: no-repeat;
    width: 100%;
    background-size: cover;
    background-position: center;
    display: flex;
    position: relative;
    align-items: flex-end;
    justify-content: flex-end;
}

.overlay-btn {
    position: absolute;
    margin: 5px 0px 5px 5px;
    transform: translate(-50%, -50%);
    padding: 10px 20px;
    background-color: white;
    color: #3d5d8d;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 30px;
    animation: bounce 0.5s ease infinite alternate;
}

@keyframes bounce {
    from {
        transform: translate(-50%, -50%) scale(1);
    }
    to {
        transform: translate(-50%, -50%) scale(1.1);
    }
}

</style>
<body>
    <div class="container3">
        <button onclick="handleLoginButton()" class="overlay-btn">Login →</button>
    </div>

    <script>
        function handleLoginButton() {
            window.location.href = "{{ url('/login') }}";
        }
    </script>
</body>
</html>
