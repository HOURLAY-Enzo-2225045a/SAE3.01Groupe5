// game.js
console.log("HELLO")

import { Cage } from '/Cage.js';
import { Palet } from '/Palet.js';
import { CanvasManager } from '/CanvasManager.js';
import { CollisionManager } from '/CollisionManager.js';
import { EventManager } from '/EventManager.js';
import { Rectangle } from "/Rectangle.js";

class Game {
    constructor(canvas, staticCanvas) {
        this.canvasManager = new CanvasManager(canvas,staticCanvas);
        this.collisionManager = new CollisionManager();
        this.eventManager = new EventManager();
        let tailleCage = Math.trunc(this.canvasManager.getCanvas().width*(2.5/10));
        var tmpCanvas = this.canvasManager.getCanvas();
        this.leftCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width*(2/10))-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.midCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width/2)-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.rightCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width*(8/10))-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.palet = new Palet(Math.trunc(tmpCanvas.width/2), Math.trunc(tmpCanvas.height*(5/10)), Math.trunc(this.midCage.getBack().width/8), 10);
    }

    start() {
        //resetStaticCanvas();
        setInterval(() => {
            this.canvasManager.clear();
            this.palet.draw();
        }, 10);
    }

    reset() {
        // ...
    }

    // ...
}

console.log("hello world")
// boolean qui est vrai si la souris est clicker non si elle ne l'ai pas
let mouseIsDown = false;
// score du joueur
let score = 0;
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