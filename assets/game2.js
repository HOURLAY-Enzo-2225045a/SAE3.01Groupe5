// Boolean indiquant si la souris est cliquée
let mouseIsDown = false;
// Score du joueur
let score = 0;

// Récupération du canvas
let canvas = document.getElementById("myCanvas");
canvas.width = document.documentElement.clientWidth;
canvas.height = document.documentElement.clientHeight;
let ctx = canvas.getContext("2d");

// Création d'un canvas hors écran pour les éléments statiques
let staticCanvas = document.createElement('canvas');
staticCanvas.width = canvas.width;
staticCanvas.height = canvas.height;
let staticContext = staticCanvas.getContext('2d');

// Objet représentant la balle
let ball = {
    x: Math.trunc(canvas.width / 2),
    y: Math.trunc(canvas.height * (7 / 10)),
    r: 25,
    v: 10
};

// Nouvelles positions après interaction (drag & drop)
let newX = ball.x;
let newY = ball.y;

// Classe représentant un rectangle
class Rectangle {
    constructor(x, y, width, height, color) {
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.color = color;
    }
}

// Classe représentant une cage
class Cage {
    constructor(fond) {
        this.fond = fond;
        this.poteauGauche = new Rectangle(fond.x, fond.y, fond.height, Math.trunc(fond.width / 2), "black");
        this.poteauDroite = new Rectangle(fond.x + fond.width - fond.height, fond.y, fond.height, Math.trunc(fond.width / 2), "black");
        this.interieurCage = new Rectangle(fond.x + fond.height, fond.y + fond.height, fond.width - fond.height * 2, Math.trunc(fond.width / 2) - fond.height, "red");
    }
}

// Choix aléatoire d'une réponse
let response = Math.floor(Math.random() * 3);

// Création des objets représentant les cages
let cageLeft = new Cage(new Rectangle(Math.trunc(canvas.width * (2.5 / 10)) - 150, Math.trunc(canvas.height / 2) - 300, 300, 20, "grey"));
let cageMid = new Cage(new Rectangle(Math.trunc(canvas.width / 2) - 150, Math.trunc(canvas.height / 2) - 300, 300, 20, "grey"));
let cageRight = new Cage(new Rectangle(Math.trunc(canvas.width * (7.5 / 10)) - 150, Math.trunc(canvas.height / 2) - 300, 300, 20, "grey"));

// Gestion du redimensionnement de la page
window.addEventListener("resize", () => {
    canvas.width = document.documentElement.clientWidth;
    canvas.height = document.documentElement.clientHeight;
    resetGame();  // Ajoutez cette ligne pour réinitialiser la position de la balle lors du redimensionnement
});

// Fonction pour gérer le mouvement de la souris
function handleMouseMove(e) {
    if (mouseIsDown) {
        newX = ball.x + (ball.x - e.pageX);
        newY = ball.y - (e.pageY - ball.y);
    }
}

// Fonction pour gérer le clic de la souris
function handleMouseDown(e) {
    e.preventDefault();
    if (e.pageX < ball.x + 50 && e.pageX > ball.x - 50 &&
        e.pageY < ball.y + 50 && e.pageY > ball.y - 50) {
        mouseIsDown = true;
    }
}

// Fonction pour gérer le relâchement de la souris
function handleMouseUp(e) {
    if (mouseIsDown) {
        newX = ball.x + (ball.x - e.pageX) * 5;
        newY = ball.y - (e.pageY - ball.y) * 5;
    }
    mouseIsDown = false;
}

// Fonction pour gérer le déplacement tactile
function handleTouchMove(e) {
    if (mouseIsDown) {
        const touch = e.touches[0];
        newX = ball.x + (ball.x - touch.pageX);
        newY = ball.y - (touch.pageY - ball.y);
    }
}

// Fonction pour gérer le début du toucher
function handleTouchStart(e) {
    const touch = e.touches[0];
    if (
        touch.pageX < ball.x + 50 && touch.pageX > ball.x - 50 &&
        touch.pageY < ball.y + 50 && touch.pageY > ball.y - 50
    ) {
        mouseIsDown = true;
    }
}

// Fonction pour gérer la fin du toucher
function handleTouchEnd(e) {
    if (mouseIsDown) {
        const touch = e.changedTouches[0];
        newX = ball.x + (ball.x - touch.pageX) * 5;
        newY = ball.y - (touch.pageY - ball.y) * 5;
    }
    mouseIsDown = false;
}

// Ajout des écouteurs d'événements pour la souris
canvas.addEventListener("mousemove", handleMouseMove);
canvas.addEventListener("mousedown", handleMouseDown);
canvas.addEventListener("mouseup", handleMouseUp);

// Ajout des écouteurs d'événements pour l'écran tactile
canvas.addEventListener("touchmove", handleTouchMove);
canvas.addEventListener("touchstart", handleTouchStart);
canvas.addEventListener("touchend", handleTouchEnd);

// Fonction pour vérifier si un point est à l'intérieur d'un cercle
function isInsideBall(circle, pos) {
    let dx = Math.abs(circle.x - pos.x);
    let dy = Math.abs(circle.y - pos.y);
    return (dx < circle.r && dy < circle.r);
}

function drawBall(circle, color) {
    ctx.beginPath();
    ctx.fillStyle = color;

    // Utilisation de arc pour dessiner un cercle
    ctx.arc(circle.x, circle.y, circle.r, 0, Math.PI * 2);
    ctx.fill();

    ctx.closePath();
}

// Fonction pour dessiner un rectangle
function drawRectangle(rect, color, context) {
    context.beginPath();
    context.rect(rect.x, rect.y, rect.width, rect.height);
    context.fillStyle = color;
    context.fill();
    context.closePath();
}

// Fonction pour dessiner une cage
function drawCage(cage, context) {
    drawRectangle(cage.poteauGauche, cage.poteauGauche.color, context);
    drawRectangle(cage.poteauDroite, cage.poteauDroite.color, context);
    drawRectangle(cage.fond, cage.fond.color, context);
    drawRectangle(cage.interieurCage, cage.interieurCage.color, context);
}

// Fonction pour calculer la norme entre deux points
function Norm(xA, yA, xB, yB) {
    return Math.sqrt(Math.pow(xB - xA, 2) + Math.pow(yB - yA, 2));
}

// Fonction pour dessiner une flèche
function drawArrow(xA, yA, xB, yB, ArrowLength, ArrowWidth) {
    if (ArrowLength === undefined) ArrowLength = 10;
    if (ArrowWidth === undefined) ArrowWidth = 8;
    ctx.lineCap = "round";
    AB = Norm(xA, yA, xB, yB);
    xC = xB + ArrowLength * (xA - xB) / AB;
    yC = yB + ArrowLength * (yA - yB) / AB;
    xD = xC + ArrowWidth * (-(yB - yA)) / AB;
    yD = yC + ArrowWidth * ((xB - xA)) / AB;
    xE = xC - ArrowWidth * (-(yB - yA)) / AB;
    yE = yC - ArrowWidth * ((xB - xA)) / AB;
    ctx.beginPath();
    ctx.moveTo(xA, yA);
    ctx.lineTo(xB, yB);
    ctx.moveTo(xD, yD);
    ctx.lineTo(xB, yB);
    ctx.lineTo(xE, yE);
    ctx.closePath();
    ctx.stroke();
}

// Fonction pour dessiner le texte sur le canvas
function drawText(txt, x, y, color, context) {
    context.font = "30px Arial";
    context.fillStyle = color;
    context.textAlign = "center";
    context.fillText(txt, x, y);
}

// Fonction pour dessiner les réponses
function drawAnswer(a, b, c, context) {
    drawText("A : " + a, cageLeft.fond.x + cageLeft.fond.width / 2, cageLeft.fond.y - 10, "black", context);
    drawText("B : " + b, cageMid.fond.x + cageMid.fond.width / 2, cageMid.fond.y - 10, "black", context);
    drawText("C : " + c, cageRight.fond.x + cageRight.fond.width / 2, cageRight.fond.y - 10, "black", context);
    drawText("Score : " + score.toString(), canvas.width * (9.5 / 10), 70, "black", context);
    drawText("REPONSE:" + response.toString(), canvas.width * (1.5 / 10), 70, "black", context);
}

// Fonction pour détecter la collision entre un cercle et un rectangle
function RectCircleColliding(circle, rect) {
    let distX = Math.abs(circle.x - rect.x - rect.width / 2);
    let distY = Math.abs(circle.y - rect.y - rect.height / 2);

    if (distX > (rect.width / 2 + circle.r)) return false;
    if (distY > (rect.height / 2 + circle.r)) return false;

    if (distX <= (rect.width / 2)) return true;
    if (distY <= (rect.height / 2)) return true;

    let dx = distX - rect.width / 2;
    let dy = distY - rect.height / 2;
    return (dx * dx + dy * dy <= (circle.r * circle.r));
}

// Gestion des collisions du jeu
function collisionManager() {
    bounceManager(cageLeft);
    bounceManager(cageMid);
    bounceManager(cageRight);

    if (RectCircleColliding(ball, cageLeft.interieurCage)) {
        cageLeft.interieurCage.color = (response === 0) ? "green" : "orange";
        if (response === 0) {
            ++score;
            resetGame();
        }
        console.log("Score !");
    } else if (RectCircleColliding(ball, cageMid.interieurCage)) {
        cageMid.interieurCage.color = (response === 1) ? "green" : "orange";
        if (response === 1) {
            ++score;
            resetGame();
        }
        console.log("Score !");
    } else if (RectCircleColliding(ball, cageRight.interieurCage)) {
        cageRight.interieurCage.color = (response === 2) ? "green" : "orange";
        if (response === 2) {
            ++score;
            resetGame();
        }
        console.log("Score !");
    }
}

// Gestion des rebonds de la balle
function bounceManager(cage) {
    if (RectCircleColliding(ball, cage.fond)) {
        newX = ball.x + (newX - ball.x);
        newY = ball.y - (newY - ball.y);
        console.log("BOUNCE !");
    }
    if (RectCircleColliding(ball, cage.poteauGauche) || RectCircleColliding(ball, cage.poteauDroite)) {
        if (ball.y > cage.poteauGauche.y + cage.poteauGauche.height) {
            newX = ball.x + (newX - ball.x);
            newY = ball.y - (newY - ball.y);
        } else {
            newX = ball.x - (newX - ball.x);
            newY = ball.y + (newY - ball.y);
        }
        console.log("BOUNCE !");
    }
    if (ball.x < 0 || ball.x > canvas.width) {
        newX = ball.x - (newX - ball.x);
        newY = ball.y + (newY - ball.y);
        console.log("BOUNCE !");
    } else if (ball.y < 0 || ball.y > canvas.height) {
        newX = ball.x + (newX - ball.x);
        newY = ball.y - (newY - ball.y);
        console.log("BOUNCE !");
    }
}

// Fonction pour faire bouger un objet vers une position donnée
function moveObject(ac, ne, v) {
    let s = { x: 1, y: 1 };
    let move = { x: 1, y: 1 };
    let delta;
    let dist = {};

    dist.x = Math.abs(ac.x - ne.x);
    dist.y = Math.abs(ac.y - ne.y);
    delta = Math.sqrt((dist.x * dist.x) + (dist.y * dist.y));

    let tempV = v;
    v *= delta / 1000;

    move.x = (dist.x * v) / delta;
    move.y = (dist.y * v) / delta;

    v = tempV;

    s.x = (ac.x > ne.x) ? -1 : 1;
    s.y = (ac.y > ne.y) ? -1 : 1;

    ac.x += move.x * s.x;
    ac.y += move.y * s.y;

    return (dist.x <= v && dist.y <= v);
}

// Fonction pour réinitialiser le canvas hors écran
function resetStaticCanvas() {
    staticContext.clearRect(0, 0, canvas.width, canvas.height);
    drawCage(cageLeft, staticContext);
    drawCage(cageMid, staticContext);
    drawCage(cageRight, staticContext);
    getQuestion();
}

// Fonction pour réinitialiser le jeu
function resetGame() {
    ball.x = Math.trunc(canvas.width / 2);
    ball.y = Math.trunc(canvas.height * (7 / 10));
    newX = ball.x;
    newY = ball.y;
    response = Math.floor(Math.random() * 3);
    resetStaticCanvas();
    cageLeft.interieurCage.color = "red";
    cageMid.interieurCage.color = "red";
    cageRight.interieurCage.color = "red";
}

// Fonction pour récupérer une question aléatoire
function getQuestion() {
    $.ajax({
        type: "POST",
        url: "/controls/actionController.php",
        data: {
            action: "getRandomQuestion",
        },
        dataType: 'json',
        success: function (response) {
            drawAnswer(response.vrai, response.faux1, response.faux2, staticContext);
        }
    });
}

// Fonction principale pour dessiner le canvas et faire fonctionner le jeu
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Mettez à jour la taille du canvas hors écran
    staticCanvas.width = canvas.width;
    staticCanvas.height = canvas.height;

    ctx.drawImage(staticCanvas, 0, 0);
    drawBall(ball, "#0095DD");

    if (mouseIsDown) {
        ctx.strokeStyle = "black";
        ctx.lineWidth = 4;
        drawArrow(ball.x, ball.y, newX, newY);
    } else {
        if ((newX !== ball.x || newY !== ball.y) && !mouseIsDown) {
            if (moveObject(ball, { x: newX, y: newY }, ball.v)) {
                newX = ball.x;
                newY = ball.y;
            }
        }
    }

    collisionManager();
}

// Réinitialise le canvas hors écran et appelle la fonction draw toutes les 10ms
resetStaticCanvas();
setInterval(draw, 10);


