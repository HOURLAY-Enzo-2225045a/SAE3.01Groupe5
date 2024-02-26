import {Goal} from "./Goal.js";
import {Striker} from "./Striker.js";
import {Defender} from "./Defender.js";
import {CollisionManager} from "./CollisionManager.js";
import {EventManager} from "./EventManager.js";

class GameDefense{
    constructor(canvas) {
        this.canvas = canvas;
        let goalSize = Math.trunc(this.canvas.width*(2.5/10)); // taille de la cage en fonction de la taille du Canva.
        this.goal = new Goal(this.canvas, goalSize);
        this.defender = new Defender(
            Math.trunc(this.canvas.width/2),
            Math.trunc(this.canvas.height*(7/10)),
            Math.trunc(this.goal.getBack().width/8),
            10
        );
        this.leftStriker = new Striker(
            Math.trunc(this.canvas.width / 2) - 120,
            Math.trunc(this.canvas.height * (1 / 10)),
            Math.trunc(this.goal.getBack().width/8),
            0.5
        );
        this.midleStriker = new Striker(
            Math.trunc(this.canvas.width / 2),
            Math.trunc(this.canvas.height * (1 / 10)),
            Math.trunc(this.goal.getBack().width/8),
            0.5
        );
        this.rightStriker = new Striker(
            Math.trunc(this.canvas.width / 2) + 120,
            Math.trunc(this.canvas.height * (1 / 10)),
            Math.trunc(this.goal.getBack().width/8),
            0.5
        );

        this.eventManager = new EventManager(this.defender, this.canvas);
        this.collisionManager = new CollisionManager();

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

    start(){
        // Les listener pour écouter chaque mouvement de la souris associé à leur méthodes
        window.addEventListener('mousedown', (e) => this.eventManager.handleMouseDown(e));
        window.addEventListener('mouseup', (e) => this.eventManager.handleMouseUp(e));
        window.addEventListener('mousemove', (e) => this.eventManager.handleMouseMove(e));

        // Le jeu, toutes les 10 millisecondes, ce code sera exécuté.
        setInterval(() => {
            // On nettoie le canva au lancement du jeu
            this.canvas.getContext("2d").clearRect(0, 0, this.canvas.width, this.canvas.height);

            // On affiche les différents éléments
            this.goal.draw(this.canvas.getContext("2d"));
            this.defender.draw(this.canvas.getContext("2d"));
            this.leftStriker.draw(this.canvas.getContext("2d"));
            this.midleStriker.draw(this.canvas.getContext("2d"));
            this.rightStriker.draw(this.canvas.getContext("2d"));

            // Gestion du déplacement du palet
            if(this.defender.checkNewPos() && !this.eventManager.getMouseIsDown()){
                if(this.defender.move()){
                    this.defender.resetNewPos();
                }
            }

            // Déplacez les attaquants vers le haut
            this.leftStriker.moveDown();
            this.midleStriker.moveDown();
            this.rightStriker.moveDown();


            // Gérer les collisions
            this.collisionManager.handleCollisions(this.defender, this.leftStriker, this.midleStriker, this.rightStriker, this.goal, canvas, this);
        }, 10);
    }

    resetGame() {
        this.defender.resetPosition();
        this.leftStriker.resetPosition();
        this.midleStriker.resetPosition();
        this.rightStriker.resetPosition();

        this.shuffledAnswers = this.shuffleAnswers(this.answer1, this.answer2, this.answer3);

        this.questionZone.textContent = this.question;
        this.answer1Zone.textContent = this.shuffledAnswers[0];
        this.leftStriker.answer = this.shuffledAnswers[0];
        this.answer2Zone.textContent = this.shuffledAnswers[1];
        this.midleStriker.answer = this.shuffledAnswers[1];
        this.answer3Zone.textContent = this.shuffledAnswers[2];
        this.rightStriker.answer = this.shuffledAnswers[2];

        this.defender.answer = this.goodAnswer;
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
let heightPercentage = 100;

let canvas = document.getElementById("myCanvas"); // récupération du canvas

// Calculer la nouvelle largeur en fonction de la largeur de la fenêtre
canvas.width = (widthPercentage / 100) * window.innerWidth;
// Calculer la nouvelle hauteur en fonction de la hauteur de la fenêtre
canvas.height = (heightPercentage / 100) * window.innerHeight;

const gameDefense = new GameDefense(canvas);

gameDefense.questionZone.textContent = gameDefense.question;
gameDefense.answer1Zone.textContent = gameDefense.shuffledAnswers[0];
gameDefense.leftStriker.answer = gameDefense.shuffledAnswers[0];
gameDefense.answer2Zone.textContent = gameDefense.shuffledAnswers[1];
gameDefense.midleStriker.answer = gameDefense.shuffledAnswers[1];
gameDefense.answer3Zone.textContent = gameDefense.shuffledAnswers[2];
gameDefense.rightStriker.answer = gameDefense.shuffledAnswers[2];

gameDefense.defender.answer = gameDefense.goodAnswer;

gameDefense.start();