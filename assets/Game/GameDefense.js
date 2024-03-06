import {CollisionManager} from "./CollisionManager.js";
import {EventManager} from "./EventManager.js";
import {Goal} from "./Goal.js";
import {Rectangle} from "./Rectangle.js";
import {Circle} from "./Circle.js";

class GameDefense{
    constructor(canvas) {
        this.canvas = canvas;
        let goalSize = Math.trunc(canvas.width*(2.5/10)); // taille de la cage en fonction de la taille du Canva.

        let goalBackX = Math.trunc(canvas.width / 2) - goalSize / 2
        let goalBackY = Math.trunc(canvas.height * (9 / 10)) - goalSize / 8
        let goalBackWidth = goalSize
        let goalBackHeight = Math.trunc(goalSize / 15)

        this.goal = new Goal(
            new Rectangle(goalBackX, goalBackY, goalBackWidth, goalBackHeight, "grey"),
            new Rectangle(
                goalBackX,
                goalBackY - Math.trunc(goalBackWidth/2),
                goalBackHeight,
                Math.trunc(goalBackWidth/2),
                "black"
            ),
            new Rectangle(
                goalBackX + goalBackWidth - goalBackHeight,
                goalBackY - Math.trunc(goalBackWidth/2),
                goalBackHeight,
                Math.trunc(goalBackWidth/2),
                "black"
            )
        );

        this.defender = new Circle(
            Math.trunc(this.canvas.width/2),
            Math.trunc(this.canvas.height*(7/10)),
            Math.trunc(this.goal.getBack().width/8),
            10,
            this.canvas
        );
        this.leftStriker = new Circle(
            Math.trunc(this.canvas.width / 2) - 120,
            Math.trunc(this.canvas.height * (1 / 10)),
            Math.trunc(this.goal.getBack().width/8),
            0.25,
            this.canvas
        );
        this.midleStriker = new Circle(
            Math.trunc(this.canvas.width / 2),
            Math.trunc(this.canvas.height * (1 / 10)),
            Math.trunc(this.goal.getBack().width/8),
            0.25,
            this.canvas
        );
        this.rightStriker = new Circle(
            Math.trunc(this.canvas.width / 2) + 120,
            Math.trunc(this.canvas.height * (1 / 10)),
            Math.trunc(this.goal.getBack().width/8),
            0.25,
            this.canvas
        );
        this.eventManager = new EventManager(this.defender, this.canvas);
        this.collisionManager = new CollisionManager(this, this.canvas);
        this.score = 0;
        this.responseStriker = 0;
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

    start(){
        this.getQuestion();
        sessionStorage.setItem("score", 0);
        // Récupération du score du joueur
        if(!isNaN(parseInt(sessionStorage.getItem("score")))){
            this.score = parseInt(sessionStorage.getItem("score"));
        }
        document.getElementById("score").innerText = this.score;


        // Les listener pour écouter chaque mouvement de la souris associé à leur méthodes
        window.addEventListener('mousedown', (e) => this.eventManager.handleMouseDown(e));
        window.addEventListener('mouseup', (e) => this.eventManager.handleMouseUp(e));
        window.addEventListener('mousemove', (e) => this.eventManager.handleMouseMove(e));

        setInterval(() => {
            this.canvas.getContext("2d").clearRect(0, 0, this.canvas.width, this.canvas.height);

            this.goal.draw(this.canvas.getContext("2d"));
            this.defender.draw(this.canvas.getContext("2d"));
            this.leftStriker.draw(this.canvas.getContext("2d"));
            this.midleStriker.draw(this.canvas.getContext("2d"));
            this.rightStriker.draw(this.canvas.getContext("2d"));

            if (this.eventManager.getMouseIsDown()) {
                this.drawArrow(this.defender.x, this.defender.y, this.defender.newX, this.defender.newY);// drawArrow(ball.x,ball.y,newX,newY);
            }

            if(this.defender.checkNewPos() && !this.eventManager.getMouseIsDown()){//getMouseIsDown?
                this.defender.resetPrevPos();
                if(this.defender.move()){
                    this.defender.resetNewPos();
                }
            }

            // Déplacer les attaquants vers le bas
            this.leftStriker.moveDown();
            this.midleStriker.moveDown();
            this.rightStriker.moveDown();

            this.collisionManager.handleCollisionsDefense(this.defender, this.goal, [this.leftStriker, this.midleStriker, this.rightStriker])
        }, 10);
    }



    /**
     * Récupère une question aléatoire et l'affiche dans le canvas
     * @note Vérifier si modification nécessaire / Ou QuestionManager ?
     */
    getQuestion() {
        this.responseStriker = Math.floor(Math.random() * 3);
        let randCage = this.responseStriker
        console.log(randCage, this.responseStriker)
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
        this.defender.resetPos();
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

canvas.width = (widthPercentage / 100) * window.innerWidth; // Calculer la nouvelle largeur en fonction de la largeur de la fenêtre
canvas.height = (heightPercentage / 100) * window.innerHeight;  // Calculer la nouvelle hauteur en fonction de la hauteur de la fenêtre
canvas.style.backgroundImage = "url('/assets/images/ice.webp')";    // Ajout d'un background au canvas

const gameDefense = new GameDefense(canvas);

gameDefense.start();