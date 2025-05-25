{{-- resources/views/chat.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #d0eaff, #f0faff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            width: 100%;
            max-width: 600px;
            height: 90vh;
            background: #fff;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .chat-header {
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
        }

        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: linear-gradient(to bottom, #e6f2ff, #ffffff);
        }

        .message {
            max-width: 70%;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 10px;
            position: relative;
            word-wrap: break-word;
        }

        .you {
            background-color: #d0ebff;
            align-self: flex-end;
            margin-left: auto;
        }

        .them {
            background-color: #f1f1f1;
            align-self: flex-start;
            margin-right: auto;
        }

        .timestamp {
            display: block;
            font-size: 12px;
            color: #555;
            margin-top: 5px;
            text-align: right;
        }

        .chat-footer {
            padding: 10px;
            border-top: 1px solid #ccc;
            display: flex;
        }

        .chat-footer input[type="text"] {
            flex: 1;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-right: 10px;
        }

        .chat-footer button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 16px;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
        }

        .action-buttons {
            margin-top: 5px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .action-buttons button {
            font-size: 12px;
            padding: 3px 8px;
            border: none;
            background-color: #f0f0f0;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-buttons button:hover {
            background-color: #ddd;
        }

        @media (max-width: 768px) {
            .chat-container {
                height: 100vh;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-header">
            Chat with {{ $receiver->name }}
        </div>
        <div id="chat-box" class="chat-body">
            <!-- Messages will be loaded here -->
        </div>
        <div id="edit-preview" style="display: none; padding: 8px 15px; background: #ffeeba; font-size: 14px;">
            Editing: <span id="editing-message-text"></span>
            <button onclick="cancelEdit()" style="float: right; background: none; border: none; color: red; cursor: pointer;">Cancel</button>
        </div>
        <div class="chat-footer">
            <input type="text" id="message" placeholder="Type a message..." autocomplete="off" />
            <button id="send-btn">Send</button>
        </div>
    </div>

    <script>
        const receiverId = {{ $receiver->id }};
        const currentUserId = {{ auth()->id() }};
        const chatBox = document.getElementById('chat-box');
        const messageInput = document.getElementById('message');
        const sendBtn = document.getElementById('send-btn');

        const editPreview = document.getElementById('edit-preview');
        const editingMessageText = document.getElementById('editing-message-text');
        let editingMessageId = null;

        function formatTime(timestamp) {
            const date = new Date(timestamp);
            return date.toLocaleTimeString('en-GB', {
                hour: '2-digit',
                minute: '2-digit',
                // timeZone: 'UTC',
                hour12: false
            });
        }

        async function fetchMessages() {
            try {
                const res = await fetch(`/fetch-messages?receiver_id=${receiverId}`);
                const messages = await res.json();
                console.log(messages);

                chatBox.innerHTML = '';

                messages.forEach(msg => {
                    const div = document.createElement('div');
                    div.classList.add('message');
                    div.classList.add(msg.sender_id === currentUserId ? 'you' : 'them');

                    let content = `<div>${msg.body}</div>`;
                    let editedLabel = new Date(msg.updated_at) > new Date(msg.created_at) ? ' (edited)' : '';
                    content += `<span class="timestamp">${formatTime(msg.updated_at)}${editedLabel}</span>`;

                    if (msg.sender_id === currentUserId) {
                        content += `
                            <div class="action-buttons">
                                <button onclick="editMessage(${msg.id}, \`${msg.body.replace(/`/g, "\\`")}\`)">Edit</button>
                                
                            </div>
                        `;
                        //<button onclick="deleteMessage(${msg.id})">Delete</button>
                    }

                    div.innerHTML = content;
                    chatBox.appendChild(div);
                });

                chatBox.scrollTop = chatBox.scrollHeight;
            } catch (err) {
                console.error('Error fetching messages:', err);
            }
        }

        async function sendMessage() {
            const text = messageInput.value.trim();
            if (!text) return;

            if (editingMessageId) {
                // Update existing message
                try {
                    const res = await fetch(`/update-message/${editingMessageId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({message: text })
                    });
                    console.log(editingMessageId);

                    if (res.ok) {
                        cancelEdit();
                        fetchMessages();
                    }
                } catch (err) {
                    console.error('Error updating message:', err);
                }
            } else {
                // Send new message
                try {
                    const res = await fetch('/send-message', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            receiver_id: receiverId,
                            message: text
                        })
                    });

                    if (res.ok) {
                        messageInput.value = '';
                        fetchMessages();
                    }
                } catch (err) {
                    console.error('Error sending message:', err);
                }
            }
        }

        async function deleteMessage(id) {
            if (!confirm('Delete this message?')) return;

            try {
                const res = await fetch(`/delete-message/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (res.ok) {
                    fetchMessages();
                }
            } catch (err) {
                console.error('Error deleting message:', err);
            }
        }

        async function editMessage(id, body) {
            editingMessageId = id;
            messageInput.value = body;
            editingMessageText.textContent = body;
            editPreview.style.display = 'block';
            messageInput.focus();
        }

        function cancelEdit() {
            editingMessageId = null;
            messageInput.value = '';
            editPreview.style.display = 'none';
        }

        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage();
        });

        setInterval(fetchMessages, 2000);
        fetchMessages();
    </script>
</body>

</html>
