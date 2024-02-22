const socket = new WebSocket('wss://spartiates-socket-server.glitch.me/');

socket.addEventListener('open', (event) => {
    console.log('Connexion WebSocket ouverte:', event);
});

socket.addEventListener('message', (event) => {
    const message = event.data;
    console.log('Message reçu du serveur:', message);
    if(message === "stop"){
        window.location.href = "/controls/actionController.php?action=deconnect";
    }
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

function sendAdminMessage() {
    socket.send("Stop Session");
}