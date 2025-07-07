@extends('layouts.app')

@section('content')
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
@endsection
