/**
 * DataMaq Chatbot - Vanilla JS Engine
 */

document.addEventListener('DOMContentLoaded', () => {
    // --- Chat Elements ---
    const chatToggle = document.getElementById('dm-chat-toggle');
    const chatContainer = document.getElementById('dm-chat-container');
    const chatForm = document.getElementById('dm-chat-form');
    const chatInput = document.getElementById('dm-chat-input');
    const chatMessages = document.getElementById('dm-chat-messages');

    if (!chatToggle || !chatContainer) return;

    // --- Chat Logic ---
    chatToggle.addEventListener('click', (e) => {
        e.preventDefault();
        chatContainer.classList.toggle('tw:hidden');
        if (!chatContainer.classList.contains('tw:hidden')) {
            chatInput.focus();
        }
    });

    // Permitir disparar el chat desde cualquier enlace con href="#chat"
    document.querySelectorAll('a[href="#chat"]').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            chatContainer.classList.remove('tw:hidden');
            chatInput.focus();
        });
    });

    // Handle Sending Messages
    if (chatForm) {
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = chatInput.value.trim();
            if (!message) return;

            // Render User Message
            appendMessage('user', message);
            chatInput.value = '';

            try {
                const response = await fetch('/index.php?rest_route=/datamaq/v1/chat', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ 'driver': 'web', 'message': message })
                });

                const data = await response.json();
                
                if (data.messages) {
                    data.messages.forEach(msg => appendMessage('bot', msg.text));
                } else if (data.text) {
                    appendMessage('bot', data.text);
                }
            } catch (error) {
                console.error('DataMaq Chat Error:', error);
                appendMessage('bot', 'Lo siento, hubo un error de conexión.');
            }
        });
    }

    function appendMessage(sender, text) {
        if (!chatMessages) return;
        const msgDiv = document.createElement('div');
        msgDiv.className = `tw:mb-3 tw:p-3 tw:rounded-lg tw:max-w-[80%] ${
            sender === 'user' 
            ? 'tw:bg-dm-primary tw:text-white tw:ml-auto tw:rounded-br-none' 
            : 'tw:bg-dm-surface-200 tw:text-dm-text-900 tw:mr-auto tw:rounded-bl-none'
        }`;
        msgDiv.textContent = text;
        chatMessages.appendChild(msgDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
});
