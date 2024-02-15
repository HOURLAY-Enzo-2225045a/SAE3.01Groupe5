// game.js
import { Cage } from "/assets/Game/Cage.js";
import { Palet } from "/assets/Game/Palet.js";
import { CanvasManager } from "/assets/Game/CanvasManager.js";
import { CollisionManager } from "/assets/Game/CollisionManager.js";
import { EventManager } from "/assets/Game/EventManager.js";
import { Rectangle } from "/assets/Game/Rectangle.js";

class Game {
    constructor(canvas, staticCanvas) {
        this.canvasManager = new CanvasManager(canvas,staticCanvas);
        let tailleCage = Math.trunc(this.canvasManager.getCanvas().width*(2.5/10));
        var tmpCanvas = this.canvasManager.getCanvas();
        this.leftCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width*(2/10))-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.midCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width/2)-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.rightCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width*(8/10))-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.palet = new Palet(Math.trunc(tmpCanvas.width/2), Math.trunc(tmpCanvas.height*(5/10)), Math.trunc(this.midCage.getBack().width/8), 10);
        this.collisionManager = new CollisionManager(this.canvasManager.getCanvas(), this.palet, [this.leftCage, this.midCage, this.rightCage]);
        this.eventManager = new EventManager(this.palet, this.canvasManager.getCanvas());

        //this.arrow = new Image();
    }

    start() {
        window.addEventListener('mousedown', (e) => this.eventManager.handleMouseDown(e));
        window.addEventListener('mouseup', (e) => this.eventManager.handleMouseUp(e));
        window.addEventListener('mousemove', (e) => this.eventManager.handleMouseMove(e));
        //window.addEventListener('resize', (e) => this.eventManager.handleResize(e));
        console.log(this.palet)
        setInterval(() => {
            this.canvasManager.clear(); // ctx.clearRect(0, 0, canvas.width, canvas.height);
            this.palet.draw(this.canvasManager.getCtx()); //drawBall(ball,"#0095DD");
            this.leftCage.draw(this.canvasManager.getCtx());
            this.midCage.draw(this.canvasManager.getCtx());
            this.rightCage.draw(this.canvasManager.getCtx());// ctx.drawImage(staticCanvas, 0, 0);
            // Gestion du déplacement du palet
            if(this.palet.checkNewPos() && !this.eventManager.getMouseIsDown()){//getMouseIsDown?
                console.log("move");
                if(this.palet.move()){
                    this.palet.resetNewPos();
                }
            }
            this.collisionManager.handleCollisions(); //collisionManager();
            /*if(mouseIsDown){
                ctx.strokeStyle="black";
                ctx.lineWidth=4;
                drawArrow(ball.x,ball.y,newX,newY);
                console.log("Arrow")
            } else {
                if((newX !== ball.x || newY !== ball.y) && !mouseIsDown){
                    if(moveObject(ball, {x:newX, y:newY}, ball.v)){
                        resetGame(false);
                        newX = ball.x;
                        newY = ball.y
                    }
                }
            }
            collisionManager();*/
        }, 10);
    }

    reset() {
        // ...
    }

    addScore() {
        // ...
    }
}

console.log("hello world");
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