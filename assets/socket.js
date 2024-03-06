let socket = new WebSocket('wss://spartiates-socket-server.glitch.me/');

socket.addEventListener('open', (event) => {
    console.log('Connexion WebSocket ouverte:', event);

    $.ajax({
        type: "POST",
        url: "/controls/actionController.php",
        data: {
            action: "connexionWS",
        },
    }).done(function (response) {
        socket.send(response);
    });

});

let messageMapping = [
    "stop",
    "start",
    "reset",
];

socket.addEventListener('message', (event) => {
    console.log('Message reçu:', event.data);
    const message = event.data;
    if (messageMapping.includes(message)) {
        if(typeof window.sessionStatus === 'function')
            window.sessionStatus(message);
        else {
            $.ajax({
                type: "POST",
                url: "/controls/actionController.php",
                data: {
                    action: message,
                },
            }).done(function (response) {
                console.log("modif de code socvket")
                $('#code').html(response);
            });
        }
    }
});

socket.addEventListener('close', (event) => {
    console.log('Connexion WebSocket fermée:', event);
});

function sendMessage(message) {
    socket.send(message);
}

// //TODO : a deplacer au bon endroit
// /**
//  * Fonction qui permet de verifier
//  * si le joueur est toujours dans la session
//  */
// function sessionStatus(status) {
//     switch (status) {
//         case 'start':
//             gameActive = true;
//             $("#endGame").hide();
//             break;
//         case 'stop':
//             gameActive = false;
//             $("#endGame").show();
//             endGame();
//             break;
//         case 'reset':
//             gameActive = false;
//             window.location.href = "/home";
//             break;
//         default :
//             alert("Erreur de statuts de session");
//             break
//     }
// }