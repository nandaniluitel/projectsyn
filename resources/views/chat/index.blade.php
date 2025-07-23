<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chat Rooms</title>

  <!-- AdminLTE & FontAwesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">

  <style>
    .chat-sidebar {
      width: 280px;
      height: calc(100vh - 100px);
      overflow-y: auto;
      border-right: 1px solid #dee2e6;
      background: #f8f9fa;
    }
    .chat-sidebar .list-group-item {
      border: none;
      border-bottom: 1px solid #e9ecef;
      padding: 12px 16px;
      transition: background .2s;
    }
    .chat-sidebar .list-group-item.active,
    .chat-sidebar .list-group-item:hover {
      background: #e2e6ea;
    }

    .chat-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      height: calc(100vh - 100px);
    }
    .chat-header {
      padding: 16px;
      border-bottom: 1px solid #dee2e6;
      background: #ffffff;
    }
    .chat-header h2 {
      margin: 0;
      font-size: 1.5rem;
      text-align: center;
      font-weight: 600;
    }
    .chat-body {
      flex-grow: 1;
      padding: 16px;
      overflow-y: auto;
      background: #fffffff;
    }
    .chat-empty {
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #888;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    {{-- Navbar --}}
    @include('nav.create')

    {{-- Sidebar --}}
    @if(!empty($isTeacher) && $isTeacher)
      @include('teachersidebar.create')
    @elseif(!empty($isStudent) && $isStudent)
      @include('sidebar.create')
    @endif

    {{-- Page content --}}
    <div class="content-wrapper">
      <div class="container-fluid p-0 d-flex">
        
        {{-- Chat Sidebar --}}
        <div class="chat-sidebar">
          <div class="p-3 border-bottom">
            <h4 class="mb-0">Your Chat Rooms</h4>
          </div>
          <ul class="list-group list-group-flush">
            @forelse($chatRooms as $room)
              <li class="list-group-item {{ (isset($currentRoom) && $currentRoom->id === $room->id) ? 'active' : '' }}">
                <a href="{{ route('chat.show',['id'=>$room->id]) }}" class="d-flex align-items-center text-dark">
                  <i class="fas fa-comments fa-lg mr-2"></i>
                  <div>
                    <strong class="d-block">{{ $room->projectGroup->title }}</strong>
                    <small class="text-muted">{{ $room->projectGroup->level }}</small>
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

        {{-- Chat Content --}}
        <div class="chat-content">
          @if(isset($currentRoom))
            {{-- Header with centered room name --}}
            <div class="chat-header">
              <h2>{{ $currentRoom->projectGroup->title }} <small class="text-muted">({{ $currentRoom->projectGroup->level }})</small></h2>
            </div>

            {{-- Messages area --}}
            <div class="chat-body">
              {{-- Your message-listing markup here --}}
              @include('chat.partials.messages', ['room' => $currentRoom])
            </div>

            {{-- Message input form (fixed at bottom) --}}
            <div class="border-top p-3 bg-white">
              <form action="{{ route('chat.send', ['id' => $currentRoom->id]) }}" method="POST" class="d-flex">
                @csrf
                <input type="text" name="message" class="form-control mr-2" placeholder="Type a message…" required>
                <button class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
              </form>
            </div>
          @else
            <div class="chat-empty">
              <div class="text-center">
                <i class="fas fa-comments fa-3x mb-3"></i>
                <p>Select a room to start chatting</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
  <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
