import {Game} from "./game/Game.js";

// pourcentage de la taille du canvas par rapport à la taille de la fenêtre
let widthPercentage = 100;
let heightPercentage = 80;
// cage de la bonne réponse
let randCage;

let canvas = document.getElementById("myCanvas"); // récupération du canvas
// Calculer la nouvelle largeur en fonction de la largeur de la fenêtre
canvas.width = (widthPercentage / 100) * window.innerWidth;
// Calculer la nouvelle hauteur en fonction de la hauteur de la fenêtre
canvas.height = (heightPercentage / 100) * window.innerHeight;

// Créer un canvas hors écran pour dessiner les éléments statiques une fois
let staticCanvas = document.createElement('canvas');
staticCanvas.width = canvas.width;
staticCanvas.height = canvas.height;

const game = new Game(canvas,staticCanvas);

game.start();

//fonction appelée par le websocket pour changer le statut de la session
function sessionStatus(status) {
    switch (status) {
        case 'start':
            game.eventManager.gameActive = true;
            $("#endGame").hide();
            break;
        case 'stop':
            game.eventManager.gameActive= false;
            $("#endGame").show();
            Game.endGame("socket");
            break;
        case 'reset':
            game.eventManager.gameActive = false;
            window.location.href = "/home";
            break;
        default :
            alert("Erreur de statuts de session");
            break
    }
}

window.sessionStatus = sessionStatus;