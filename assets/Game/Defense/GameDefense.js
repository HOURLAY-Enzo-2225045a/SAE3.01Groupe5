import {Cage} from "../Cage";
import {Rectangle} from "../Rectangle";
import {Striker} from "./Striker";
import {Defender} from "./Defender";
import {CollisionManager} from "../CollisionManager";
import {CanvasManager} from "../CanvasManager";
import {EventManager} from "../EventManager";

class GameDefense{
    constructor(canvas, staticCanvas) {
        // Gestion du plateau de jeu
        this.canvasManager = new CanvasManager(canvas,staticCanvas);
        let tmpCanvas = this.canvasManager.getCanvas(); // définition d'un canva pour le plateau

        // 3 personnages, les 3 joueurs se dirigeront vers la même direction, celle du joueur
        this.leftStriker = new Striker();
        this.midleStriker = new Striker();
        this.rightStriker = new Striker();

        // 1 joueur, le joueur aura le même comportement que le palet
        this.defender = new Defender();

        // Il faut gérer le drag and drop du joueur
        this.eventManager = new EventManager(this.defender, this.canvasManager.getCanvas());

        // Il faut gérer les collisions avec les personnages, bords, cage.
            // Gestion des collision entre le joueur et les bords du canvas.
            this.collisionManager = new CollisionManager(this.canvasManager.getCanvas(), this.defender);

        // Il faut une cage
        let cageSize = Math.trunc(tmpCanvas.width*(2.5/10)); // taille de la cage en fonction de la taille du Canva.
        this.cage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width/2)-cageSize/2, Math.trunc(tmpCanvas.height*(1/10)), cageSize, Math.trunc(cageSize/15), "grey"));
    }

    start(){
        // Les listener pour écouter chaque mouvement de la souris associé à leur méthodes
        window.addEventListener('mousedown', (e) => this.eventManager.handleMouseDown(e));
        window.addEventListener('mouseup', (e) => this.eventManager.handleMouseUp(e));
        window.addEventListener('mousemove', (e) => this.eventManager.handleMouseMove(e));

        // Le jeu, toutes les 10 millisecondes, ce code sera exécuté.
        setInterval(() => {
            this.canvasManager.clear(); // On nettoie le canva au lancement du jeu

            // On affiche les différents éléments
            this.defender.draw(this.canvasManager.getCtx());
            this.leftStriker.draw(this.canvasManager.getCtx());
            this.midleStriker.draw(this.canvasManager.getCtx());
            this.rightStriker.draw(this.canvasManager.getCtx());

            // Gestion du déplacement du palet
            if(this.defender.checkNewPos() && !this.eventManager.getMouseIsDown()){
                if(this.defender.move()){
                    this.defender.resetNewPos();
                }
            }
            this.collisionManager.handleCollisions(); // Gérer la collision avec les bords du canva
        }, 10);
    }
}


// pourcentage de la taille du canvas par rapport à la taille de la fenêtre
let widthPercentage = 100;
let heightPercentage = 80;

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