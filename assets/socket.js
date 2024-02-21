const socket = new WebSocket('wss://spartiates-socket-server.glitch.me/');

socket.addEventListener('open', (event) => {
    console.log('Connexion WebSocket ouverte:', event);
});

socket.addEventListener('message', (event) => {
    const messagesDiv = document.getElementById('messages');
    const message = document.createElement('div');
    message.textContent = `Réponse: ${event.data}`;
    messagesDiv.appendChild(message);
});

socket.addEventListener('close', (event) => {
    console.log('Connexion WebSocket fermée:', event);
});

function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value;
    socket.send(message);

    // Effacer le champ de saisie après l'envoi
    messageInput.value = '';
}