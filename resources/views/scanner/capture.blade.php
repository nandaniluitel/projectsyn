<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .progress-bar { min-width: 60px; font-weight: bold; }
    </style>
</head>
<body style="background-color: #f4f6f9; font-family: 'Source Sans Pro', sans-serif;">

@extends('layouts.app')

@section('content')


@include('nav.create')


@include('teachersidebar.create')

<div class="container text-center">
    <h2>Scan Student ID</h2>
    <video id="webcam" width="480" autoplay></video>
    <br>
    <button class="btn btn-success mt-2" onclick="capture()">Capture</button>
    <canvas id="canvas" style="display:none;"></canvas>
</div>



<script>
    let video = document.getElementById('webcam');
    let canvas = document.getElementById('canvas');
    let context = canvas.getContext('2d');

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        });

    function capture() {
    if (video.videoWidth === 0 || video.videoHeight === 0) {
        alert("Please wait for the webcam to load.");
        return;
    }

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    let imageData = canvas.toDataURL('image/jpeg');

    fetch('http://127.0.0.1:5000/scan-roll', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ image: imageData })
    })
    .then(response => response.json())
    .then(data => {
        if (data.roll_no) {
            window.location.href = `/check-student/${data.roll_no}`;
        } else {
            alert('❌ Roll number not detected.');
        }
    })
    .catch(error => {
        console.error('❌ Error:', error);
        alert('Something went wrong while scanning. Please try again.');
    });
}

</script>
@endsection
