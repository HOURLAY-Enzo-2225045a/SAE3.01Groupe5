import { Cage } from "./Cage.js";
import { Palet } from "./Palet.js";
import { CanvasManager } from "./CanvasManager.js";
import { CollisionManager } from "./CollisionManager.js";
import { EventManager } from "./EventManager.js";
import { Rectangle } from "./Rectangle.js";

export class Game {
    constructor(canvas, staticCanvas) {
        this.canvasManager = new CanvasManager(canvas,staticCanvas);
        let tailleCage = Math.trunc(this.canvasManager.getCanvas().width*(2.5/10));
        var tmpCanvas = this.canvasManager.getCanvas();
        this.leftCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width*(2/10))-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.midCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width/2)-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.rightCage = new Cage(new Rectangle(Math.trunc(tmpCanvas.width*(8/10))-tailleCage/2, Math.trunc(tmpCanvas.height*(1/10)), tailleCage, Math.trunc(tailleCage/15), "grey"));
        this.palet = new Palet(Math.trunc(tmpCanvas.width/2), Math.trunc(tmpCanvas.height*(5/10)), Math.trunc(this.midCage.getBack().width/8), 10, tmpCanvas);
        this.collisionManager = new CollisionManager(this.canvasManager.getCanvas(), this.palet, [this.leftCage, this.midCage, this.rightCage], this);
        this.eventManager = new EventManager(this.palet, this.canvasManager.getCanvas(), this);
        this.score = 0;
        this.responseCage = 0;
        this.gameActive = true
    }

    /**
     * Dessine une flèche entre deux points
     * @param fromX
     * @param fromY
     * @param toX
     * @param toY
     */
    drawArrow(fromX, fromY, toX, toY){
        var headlen = 10;   // length of head in pixels
        var angle = Math.atan2(toY-fromY,toX-fromX);
        const ctx = this.canvasManager.getCtx();
        ctx.strokeStyle = "black";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(fromX, fromY);
        ctx.lineTo(toX, toY);
        ctx.lineTo(toX-headlen*Math.cos(angle-Math.PI/6),toY-headlen*Math.sin(angle-Math.PI/6));
        ctx.moveTo(toX, toY);
        ctx.lineTo(toX-headlen*Math.cos(angle+Math.PI/6),toY-headlen*Math.sin(angle+Math.PI/6));
        ctx.stroke();
    }

    /**
     * Démarre le jeu
     */
    start() {
        this.isInActiveSession();
        console.log("start");
        this.getQuestion();
        // Récupération du score du joueur
        if(!isNaN(parseInt(sessionStorage.getItem("score")))){
            this.score = parseInt(sessionStorage.getItem("score"));
        }
        document.getElementById("score").innerText = this.score;

        // Gestion des événements
        window.addEventListener('mousedown', (e) => this.eventManager.handleMouseDown(e));
        window.addEventListener('mouseup', (e) => this.eventManager.handleMouseUp(e));
        window.addEventListener('mousemove', (e) => this.eventManager.handleMouseMove(e));
        //window.addEventListener('resize', (e) => this.eventManager.handleResize(e));

        // Boucle de jeu
        setInterval(() => {
            this.canvasManager.clear(); // ctx.clearRect(0, 0, canvas.width, canvas.height);
            this.palet.draw(this.canvasManager.getCtx()); //drawBall(ball,"#0095DD");
            this.leftCage.draw(this.canvasManager.getCtx());
            this.midCage.draw(this.canvasManager.getCtx());
            this.rightCage.draw(this.canvasManager.getCtx());// ctx.drawImage(staticCanvas, 0, 0);
            // Gestion du déplacement du palet
            if (this.eventManager.getMouseIsDown()) {
                this.drawArrow(this.palet.x, this.palet.y, this.palet.newX, this.palet.newY);// drawArrow(ball.x,ball.y,newX,newY);
            }
            if(this.palet.checkNewPos() && !this.eventManager.getMouseIsDown()){//getMouseIsDown?
                console.log("move");
                this.palet.resetPrevPos();
                if(this.palet.move()){
                    this.palet.resetNewPos();
                }
            }
            this.collisionManager.handleCollisions(); //collisionManager();
                /*if((newX !== ball.x || newY !== ball.y) && !mouseIsDown){
                    if(moveObject(ball, {x:newX, y:newY}, ball.v)){
                        resetGame(false);
                        newX = ball.x;
                        newY = ball.y
                    }
                }
            }*/
        }, 10);
    }

    /**
     * Récupère une question aléatoire et l'affiche dans le canvas
     * @note Vérifier si modification nécessaire / Ou QuestionManager ?
     */
    getQuestion() {
        this.responseCage = Math.floor(Math.random() * 3);
        let randCage = this.responseCage
        $.ajax({
            type: "POST",
            url: "/controls/actionController.php",
            data: {
                action: "getRandomQuestion",
            },
            dataType : 'json',
            success: function (response) {
                let repA = (randCage === 0)? response.vrai : response.faux1;
                let repB = (randCage === 1)? response.vrai : (randCage === 2) ? response.faux2 : response.faux1;
                let repC = (randCage === 2)? response.vrai : response.faux2;
                $("#question").text(response.text);
                $("#rep1").text(repA);
                $("#rep2").text(repB);
                $("#rep3").text(repC);
            }
        });
    }

    addScore(){
        this.score += 100;
        sessionStorage.setItem("score", this.score);
        $("#score").text(this.score);
        this.palet.resetPos();
        // this.getQuestion();
    }

    /**
     * Ajoute 100 points au score du joueur
     * @deprecated Vérifier si modification nécessaire
     */
    addScoreAjax(){
        $.ajax({
            type: "POST",
            url: "/controls/actionController.php",
            data: {
                action: "addScore",
                score: 100,
            },
            dataType : 'json',
            success: function (response) {
                this.score = response.toString();
                $("#score").text(score);
            }
        });
    }

    /**
     * Ajoute 100 points au score du joueur
     * @deprecated Vérifier si modification nécessaire
     */
    updateScore(){
        $.ajax({
            type: "POST",
            url: "/controls/actionController.php",
            data: {
                action: "updateScore",
                score: this.score,
            },
            dataType : 'json'/*,
            success: function (response) {
                score = response.toString();
                $("#score").text(score);
            }*/
        });
        this.score = 0;
        sessionStorage.setItem("score", this.score);
    }

    /**
     * Fonction qui permet de verifier
     * si le joueur est toujours dans la session
     */
    isInActiveSession() {
        $.ajax({
            type: "POST",
            url: "/controls/actionController.php",
            data: {
                action: "isInActiveSession",
            },
            success: function (response) {
                if (response === 'notActive') {
                    $("#endGame").show();
                    Game.endGame("reload");
                } else if (response === 'false') {
                    window.location.href = "/home";
                } else if (response === 'true') {
                    $("#endGame").hide();
                }
            }
        });
    }

    static endGame(){
        $.ajax({
            type: "POST",
            url: "/controls/actionController.php",
            data: {
                action: "showEndGame",
                score : parseInt(sessionStorage.getItem("score")),
            },
            dataType: 'json',
            success: function (response) {
                $("#pseudo").text(response.pseudo);
                $("#scoreEnd").text(response.score.toString());
                $("#rank").text(response.rank.toString());
                sessionStorage.setItem("score", 0);
            }
        });
    }

}


