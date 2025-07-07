@extends('layouts.app')

@section('content')
<style>
  .chat-container { display: flex; flex-direction: column; height: calc(100vh - 80px); border: 1px solid #ddd; border-radius: 5px; overflow: hidden; }
  .chat-header    { padding: 15px; background: #f7f7f7; border-bottom: 1px solid #ddd; }
  .chat-header h2 { margin: 0; font-size: 2rem; font-weight: 600; }
  .chat-header .level { font-size: 1rem; color: #666; margin-left: .5rem; }

  .chat-messages  { flex: 1; padding: 15px; overflow-y: auto; background: #e5ddd5; position: relative; }
  .message        { position: relative; max-width: 70%; margin-bottom: 10px; padding: 10px 15px; border-radius: 20px; line-height: 1.4; }
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

  .chat-input { padding: 10px 15px; background: #f7f7f7; border-top: 1px solid #ddd; }
  .chat-input .input-group { display: flex; }
  .chat-input .form-control {
    flex: 1; font-size: 1.2rem; padding: 1rem;
    border-radius: 30px 0 0 30px; border: 1px solid #ccc; border-right: none;
  }
  .chat-input .input-group-append .btn-primary {
    background-color: #007bff; border: 1px solid #007bff; color: #fff;
    font-size: 1.2rem; padding: 0 1.5rem; border-radius: 0 30px 30px 0;
    transition: background-color .2s;
  }
  .chat-input .input-group-append .btn-primary:hover {
    background-color: #0056b3; border-color: #0056b3;
  }
</style>

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
      <div class="input-group-append">
        <button id="send-btn" class="btn btn-primary">
          Send
        </button>
      </div>
    </div>
  </div>
</div>

<script>
const roomId = {{ $room->id }};
const csrf   = '{{ csrf_token() }}';

function fetchMessages(){
  fetch(`/chat/${roomId}/messages`)
    .then(r => r.json())
    .then(msgs => {
      const box = document.getElementById('chat-box');
      box.innerHTML = '';
      msgs.forEach(m => {
        // build the bubble
        const div = document.createElement('div');
        const isMine = (m.sender.id === {{ auth()->id() }});
        div.className = `message ${isMine ? 'sent' : 'received'}`;
        div.innerHTML = `
          <div class="sender">${m.sender.name}</div>
          <div class="text">${m.message}</div>
          ${isMine 
            ? `<span class="delete-btn" data-id="${m.id}">&times;</span>` 
            : ''}
        `;
        box.appendChild(div);
      });
      box.scrollTop = box.scrollHeight;
    });
}

// send new
document.getElementById('send-btn').addEventListener('click', () => {
  const input = document.getElementById('message-input');
  const text  = input.value.trim();
  if (!text) return;
  fetch(`/chat/${roomId}/send`, {
    method: 'POST',
    headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf },
    body: JSON.stringify({ message: text })
  }).then(() => {
    input.value = '';
    fetchMessages();
  });
});

// delete handler (event delegation)
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

// initial + polling
document.addEventListener('DOMContentLoaded', () => {
  fetchMessages();
  setInterval(fetchMessages, 3000);
});
</script>
@endsection
