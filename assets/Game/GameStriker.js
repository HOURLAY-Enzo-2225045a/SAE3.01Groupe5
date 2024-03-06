import {CollisionManager} from "./CollisionManager.js";
import {EventManager} from "./EventManager.js";
import {Goal} from "./Goal.js";
import {Rectangle} from "./Rectangle.js";
import {Circle} from "./Circle.js";

class GameStriker {
    constructor(canvas) {
        this.canvas = canvas;
        let goalSize = Math.trunc(canvas.width*(2.5/10)); // taille de la cage en fonction de la taille du Canva.

        let leftGoalBackX = Math.trunc(canvas.width * (2/10)) - goalSize / 2
        let midGoalBackX = Math.trunc(canvas.width / 2) - goalSize / 2
        let rightGoalBackX = Math.trunc(canvas.width * (8/10)) - goalSize / 2

        let goalBackY = Math.trunc(canvas.height*(1/10))
        let goalBackHeight = Math.trunc(goalSize/15)

        this.leftGoal = new Goal(
            new Rectangle(leftGoalBackX, goalBackY, goalSize, goalBackHeight, "grey"),
            new Rectangle(leftGoalBackX, goalBackY, goalBackHeight, Math.trunc(goalSize/2), "black"),
            new Rectangle(
                leftGoalBackX + goalSize - goalBackHeight,
                goalBackY,
                goalBackHeight,
                Math.trunc(goalSize/2),
                "black"
            )
        );

        this.midGoal = new Goal(
            new Rectangle(midGoalBackX, goalBackY, goalSize, goalBackHeight, "grey"),
            new Rectangle(midGoalBackX, goalBackY, goalBackHeight, Math.trunc(goalSize/2), "black"),
            new Rectangle(
                midGoalBackX + goalSize - goalBackHeight,
                goalBackY,
                goalBackHeight,
                Math.trunc(goalSize/2),
                "black"
            )
        );

        this.rightGoal = new Goal(
            new Rectangle(rightGoalBackX, goalBackY, goalSize, goalBackHeight, "grey"),
            new Rectangle(rightGoalBackX, goalBackY, goalBackHeight, Math.trunc(goalSize/2), "black"),
            new Rectangle(
                rightGoalBackX + goalSize - goalBackHeight,
                goalBackY,
                goalBackHeight,
                Math.trunc(goalSize/2),
                "black"
            )
        );

        this.palet = new Circle(
            Math.trunc(canvas.width/2),
            Math.trunc(canvas.height*(5/10)),
            Math.trunc(this.midGoal.getBack().width/8),
            10,
            this.canvas
        );
        this.eventManager = new EventManager(this.palet, this.canvas);
        this.collisionManager = new CollisionManager(this, this.canvas);

        this.score = 0;
        this.responseGoal = 0;
    }

    drawArrow(fromX, fromY, toX, toY){
        let headlen = 10;   // length of head in pixels
        let angle = Math.atan2(toY-fromY,toX-fromX);
        const ctx = this.canvas.getContext("2d");
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

    start() {
        this.getQuestion();
        sessionStorage.setItem("score", 0);
        // Récupération du score du joueur
        if(!isNaN(parseInt(sessionStorage.getItem("score")))){
            this.score = parseInt(sessionStorage.getItem("score"));
        }
        document.getElementById("score").innerText = this.score;

        window.addEventListener('mousedown', (e) => this.eventManager.handleMouseDown(e));
        window.addEventListener('mouseup', (e) => this.eventManager.handleMouseUp(e));
        window.addEventListener('mousemove', (e) => this.eventManager.handleMouseMove(e));
        setInterval(() => {
            this.canvas.getContext("2d").clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.leftGoal.draw(this.canvas.getContext("2d"));
            this.midGoal.draw(this.canvas.getContext("2d"));
            this.rightGoal.draw(this.canvas.getContext("2d"));
            this.palet.draw(this.canvas.getContext("2d"));

            if (this.eventManager.getMouseIsDown()) {
                this.drawArrow(this.palet.x, this.palet.y, this.palet.newX, this.palet.newY);// drawArrow(ball.x,ball.y,newX,newY);
            }

            // Gestion du déplacement du palet
            if(this.palet.checkNewPos() && !this.eventManager.getMouseIsDown()){//getMouseIsDown?
                this.palet.resetPrevPos();
                if(this.palet.move()){
                    this.palet.resetNewPos();
                }
            }
            this.collisionManager.handleCollisionsAttack(this.palet,[this.leftGoal, this.midGoal, this.rightGoal]);
        }, 10);
    }

    /**
    * Récupère une question aléatoire et l'affiche dans le canvas
    * @note Vérifier si modification nécessaire / Ou QuestionManager ?
    */
    getQuestion() {
        this.responseGoal = Math.floor(Math.random() * 3);
        let randCage = this.responseGoal
        console.log(randCage, this.responseGoal)
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
        this.getQuestion();
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

}
// pourcentage de la taille du canvas par rapport à la taille de la fenêtre
let widthPercentage = 100;
let heightPercentage = 80;

let canvas = document.getElementById("myCanvas"); // récupération du canvas

// Calculer la nouvelle largeur en fonction de la largeur de la fenêtre
canvas.width = (widthPercentage / 100) * window.innerWidth;
// Calculer la nouvelle hauteur en fonction de la hauteur de la fenêtre
canvas.height = (heightPercentage / 100) * window.innerHeight;

const gameStriker = new GameStriker(canvas);

gameStriker.start();