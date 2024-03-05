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
            10
        );
        this.eventManager = new EventManager(this.palet, this.canvas);
        this.collisionManager = new CollisionManager(this, this.canvas);

        // Ajout de la question et des réponses
        this.questionZone = document.getElementById("question");
        this.answer1Zone = document.getElementById("rep1");
        this.answer2Zone = document.getElementById("rep2");
        this.answer3Zone = document.getElementById("rep3");

        this.question = "Quel joueur est le gardien de but ?";
        this.answer1 = "Le défenseur";
        this.answer2 = "Le milieu de terrain";
        this.answer3 = "Le gardien de but";
        this.goodAnswer = this.answer3;

        this.shuffledAnswers = this.shuffleAnswers(this.answer1, this.answer2, this.answer3);
    }

    start() {
        window.addEventListener('mousedown', (e) => this.eventManager.handleMouseDown(e));
        window.addEventListener('mouseup', (e) => this.eventManager.handleMouseUp(e));
        window.addEventListener('mousemove', (e) => this.eventManager.handleMouseMove(e));
        setInterval(() => {
            this.canvas.getContext("2d").clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.leftGoal.draw(this.canvas.getContext("2d"));
            this.midGoal.draw(this.canvas.getContext("2d"));
            this.rightGoal.draw(this.canvas.getContext("2d"));
            this.palet.draw(this.canvas.getContext("2d"));

            // Gestion du déplacement du palet
            if(this.palet.checkNewPos() && !this.eventManager.getMouseIsDown()){//getMouseIsDown?
                console.log("move");
                if(this.palet.move()){
                    this.palet.resetNewPos();
                }
            }
            this.collisionManager.gameStrikerHandleCollisions(this.palet, this.leftGoal, this.midGoal, this.rightGoal);
        }, 10);
    }

    resetGame() {
        this.palet.resetPosition();

        this.shuffledAnswers = this.shuffleAnswers(this.answer1, this.answer2, this.answer3);
        this.questionZone.textContent = this.question;
        this.answer1Zone.textContent = this.shuffledAnswers[0];
        this.leftGoal.answer = this.shuffledAnswers[0];
        this.answer2Zone.textContent = this.shuffledAnswers[1];
        this.midGoal.answer = this.shuffledAnswers[1];
        this.answer3Zone.textContent = this.shuffledAnswers[2];
        this.rightGoal.answer = this.shuffledAnswers[2];

        this.palet.answer = this.goodAnswer;
    }

    // Permet de mélanger les réponses
    shuffleAnswers(answer1, answer2, answer3) {
        const answers = [answer1, answer2, answer3];
        for (let i = answers.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [answers[i], answers[j]] = [answers[j], answers[i]];
        }
        return answers;
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
// Ajout d'un background au canvas
canvas.style.backgroundImage = "url('/assets/images/ice.webp')";

const gameStriker = new GameStriker(canvas);

gameStriker.questionZone.textContent = gameStriker.question;
gameStriker.answer1Zone.textContent = gameStriker.shuffledAnswers[0];
gameStriker.leftGoal.answer = gameStriker.shuffledAnswers[0];
gameStriker.answer2Zone.textContent = gameStriker.shuffledAnswers[1];
gameStriker.midGoal.answer = gameStriker.shuffledAnswers[1];
gameStriker.answer3Zone.textContent = gameStriker.shuffledAnswers[2];
gameStriker.rightGoal.answer = gameStriker.shuffledAnswers[2];

gameStriker.palet.answer = gameStriker.goodAnswer;

gameStriker.start();