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
  .chat-container { display: flex; flex-direction: column; height: calc(100vh - 80px); border: 1px solid #ddd; border-radius: 5px; overflow: hidden; }
  .chat-header    { padding: 15px; background: #f7f7f7; border-bottom: 1px solid #ddd; }
  .chat-header h2 { margin: 0; font-size: 2rem; font-weight: 600; }
  .chat-header .level { font-size: 1rem; color: #666; margin-left: .5rem; }

  .chat-messages  { flex: 1; padding: 15px; overflow-y: auto; background: #e5ddd5; position: relative; }
  .message        { position: relative; max-width: 70%; margin-bottom: 10px; padding: 10px 15px; border-radius: 20px; line-height: 1.4; word-wrap: break-word; }
  .message.sent   { background: #dcf8c6; margin-left: auto; border-bottom-right-radius: 0; }
  .message.received { background: #fff; margin-right: auto; border-bottom-left-radius: 0; }
  .message .sender  { font-weight: bold; margin-bottom: 5px; }
  .message .delete-btn {
    position: absolute;
    top: 5px; right: 8px;
    cursor: pointer;
    font-size: 1rem;
    color: #888;
  }
  .message.sent .delete-btn:hover { color: #c00; }
  .message img { max-width: 200px; margin-top: 8px; display: block; }

  .chat-input { padding: 10px 15px; background: #f7f7f7; border-top: 1px solid #ddd; }
  .chat-input .input-group { display: flex; align-items: center; }
  .chat-input .form-control {
    flex: 1; font-size: 1.2rem; padding: 1rem;
    border-radius: 30px 0 0 30px; border: 1px solid #ccc; border-right: none;
  }
  .chat-input input[type="file"] {
    margin: 0 0.5rem;
  }
  .chat-input .btn-primary {
    background-color: #007bff; border: 1px solid #007bff; color: #fff;
    font-size: 1.2rem; padding: 0 1.5rem; border-radius: 0 30px 30px 0;
    transition: background-color .2s;
  }
  .chat-input .btn-primary:hover {
    background-color: #0056b3; border-color: #0056b3;
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

<div class="chat-container">



  <div class="chat-header">


    <h2>
      <i class="fas fa-comments mr-2"></i>
      {{ $room->projectGroup->title }}
      <span class="level">({{ $room->projectGroup->level }})</span>
    </h2>
  </div>

  <div id="chat-box" class="chat-messages"></div>

  <div class="chat-input">
    <div class="input-group">
      <input
        type="text"
        id="message-input"
        class="form-control"
        placeholder="Type your message…"
        autocomplete="off"
      >
      <input
        type="file"
        id="attachment-input"
        accept="image/*,application/pdf"
      >
      <button type="button" id="send-btn" class="btn btn-primary">
        Send
      </button>
    </div>
  </div>
</div>
</div>
</div>


<script>
  const roomId = {{ $room->id }};
  const csrf   = '{{ csrf_token() }}';

  // Fetch and render messages
  function fetchMessages(){
    fetch(`/chat/${roomId}/messages`)
      .then(r => r.json())
      .then(msgs => {
        const box = document.getElementById('chat-box');
        box.innerHTML = '';
        msgs.forEach(m => {
          const isMine = m.sender.id === {{ auth()->id() }};
          const div = document.createElement('div');
          div.className = `message ${isMine ? 'sent' : 'received'}`;

          // Sender name
          div.innerHTML = `<div class="sender">${m.sender.name}</div>`;

          // Text body, if any
          if (m.message) {
            div.innerHTML += `<div class="text">${m.message}</div>`;
          }

          // Attachment, if any
          if (m.attachment) {
            const ext = m.attachment.split('.').pop().toLowerCase();
            if (['jpg','jpeg','png','gif'].includes(ext)) {
              div.innerHTML += `<img src="${m.attachment}" alt="attachment">`;
            } else {
              div.innerHTML += `<a href="${m.attachment}" target="_blank">Download file</a>`;
            }
          }

          // Delete button for own messages
          if (isMine) {
            div.innerHTML += `<span class="delete-btn" data-id="${m.id}">&times;</span>`;
          }

          box.appendChild(div);
        });
        box.scrollTop = box.scrollHeight;
      });
  }

  // Send a message + optional file
  document.getElementById('send-btn').addEventListener('click', () => {
    const textInput = document.getElementById('message-input');
    const fileInput = document.getElementById('attachment-input');
    const text  = textInput.value.trim();
    const file  = fileInput.files[0];

    console.log('sending…', { text, file });

    // don’t send empty payload
    if (!text && !file) return;

    const formData = new FormData();

    // only append the message if there's text
    if (text) {
      formData.append('message', text);
    }

    // only append the attachment if a file was selected
    if (file) {
      formData.append('attachment', file);
    }

    fetch(`/chat/${roomId}/send`, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrf },
      body: formData
    })
    .then(res => {
      if (res.ok) {
        // clear inputs
        textInput.value = '';
        fileInput.value = '';
        // reload messages
        fetchMessages();
      }
    });
  });

  // Delete handler
  document.getElementById('chat-box').addEventListener('click', e => {
    if (!e.target.classList.contains('delete-btn')) return;
    const messageId = e.target.dataset.id;
    fetch(`/chat/${roomId}/message/${messageId}`, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': csrf }
    }).then(res => {
      if (res.ok) e.target.closest('.message').remove();
    });
  });

  // Initial load + polling every 3s
  document.addEventListener('DOMContentLoaded', () => {
    fetchMessages();
    setInterval(fetchMessages, 3000);
  });
</script>

  <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
  <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/adminlte/dist/js/adminlte.min.js"></script>

</body>

