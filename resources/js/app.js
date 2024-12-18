require('./bootstrap');
import io from 'socket.io-client';
const socket = io('http://localhost:3000');

// Lấy tin nhắn từ API
fetch('/api/messages')
    .then(response => response.json())
    .then(messages => {
        const chatMessages = document.getElementById('chat-messages');
        messages.reverse().forEach(message => {
            const div = document.createElement('div');
            div.textContent = `${message.username}: ${message.message}`;
            chatMessages.appendChild(div);
        });
    });

// Lắng nghe sự kiện gửi tin nhắn
const chatForm = document.getElementById('chat-form');
chatForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const message = document.getElementById('message').value;
    const username = document.getElementById('username').value;

    // Gửi tin nhắn qua API
    fetch('/api/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, message }),
    });

    document.getElementById('message').value = '';
});

// Lắng nghe sự kiện từ Socket.IO
socket.on('receiveMessage', function (data) {
    const chatMessages = document.getElementById('chat-messages');
    const div = document.createElement('div');
    div.textContent = `${data.username}: ${data.message}`;
    chatMessages.appendChild(div);
});
