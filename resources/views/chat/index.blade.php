<!-- Paste this entire code in your resources/views/profile/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Rooms</title>
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .progress-bar { min-width: 60px; font-weight: bold; }
    </style>
</head>
<body style="background-color: #f4f6f9; font-family: 'Source Sans Pro', sans-serif;">

@include('nav.create')


    @if(auth()->user()->role === 'teacher')
        @include('teachersidebar.create')
    @elseif(auth()->user()->role === 'student')
        @include('sidebar.create')
    @endif

@extends('layouts.app')

<div class="content-wrapper" style="margin: 20px auto; max-width: 900px; background: #fff; padding: 20px; border-radius: 10px;">
  </body>

<style>
  .chat-sidebar {
    width: 300px;
    height: calc(100vh - 100px);
    overflow-y: auto;
    border-right: 1px solid #ddd;
    background: #f8f9fa;
  }
  .chat-sidebar .list-group-item {
    border: none;
    border-bottom: 1px solid #e9ecef;
    padding: 15px;
    cursor: pointer;
    transition: background .2s;
  }
  .chat-sidebar .list-group-item:hover,
  .chat-sidebar .list-group-item.active {
    background: #e2e6ea;
  }
  .chat-empty {
    display: flex;
    align-items: center;
    justify-content: center;
    height: calc(100vh - 100px);
    color: #888;
  }
</style>


<div class="d-flex">
  {{-- Sidebar --}}
  <div class="chat-sidebar">
    <div class="p-3">
      <h1>Your Chat Rooms</h1>
    </div>
    <ul class="list-group list-group-flush">
      @forelse($chatRooms as $room)
        <li class="list-group-item {{ request()->route('id') == $room->id ? 'active' : '' }}">
          <a href="{{ route('chat.show',['id'=>$room->id]) }}" class="d-flex align-items-center text-dark">
            <i class="fas fa-comments fa-lg mr-2"></i>
            <div>
              <strong class="d-block">{{ $room->projectGroup->title }}</strong>
              <small class="text-muted"> {{ $room->projectGroup->level }}</small>
            </div>
          </a>
        </li>
      @empty
        <li class="list-group-item text-center text-muted">
          No chat rooms found.
        </li>
      @endforelse
    </ul>
  </div>

  {{-- Empty placeholder when no room selected --}}
  @if(!isset($room))
    <div class="chat-empty flex-grow-1">
      <div>
        <i class="fas fa-comments fa-3x mb-3"></i>
        <p>Select a room to start chatting</p>
      </div>
    </div>
  @endif
</div>

