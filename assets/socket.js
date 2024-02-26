const socket = new WebSocket('wss://spartiates-socket-server.glitch.me/');

socket.addEventListener('open', (event) => {
    console.log('Connexion WebSocket ouverte:', event);
});


$messageMapping = [
    "stop",
    "start",
];

socket.addEventListener('message', (event) => {
    const message = event.data;
    document.getElementById('socketMessage').innerHTML += `<p>${message}</p>`;
    console.log('Message reçu du serveur:', message);
    if(message in $messageMapping){
        $.ajax({
            type: "POST",
            url: "/controls/actionController.php",
            data: {
                action: message,
            },
        });
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