
/**
 * Projet : Projet Serious Game - Hockey sur glace
 * Par : Groupe 5
 * @author: LKS
 * @version: 1.0
 */

// boolean qui est vrai si la souris est clicker non si elle ne l'ai pas
let mouseIsDown = false;
let score = 0;
let widthPercentage = 100;
let heightPercentage = 80;

//setup du canvas
let canvas = document.getElementById("myCanvas"); // récupération du canvas
canvas.width = window.innerWidth; // on adapte la taille du canvas à la taille de la page
canvas.height = window.innerHeight;
let ctx = canvas.getContext("2d"); // récupération du contexte du canvas

// Créer un canvas hors écran pour dessiner les éléments statiques une fois
let staticCanvas = document.createElement('canvas');
// Calculer la nouvelle largeur en fonction de la largeur de la fenêtre
canvas.width = (widthPercentage / 100) * window.innerWidth;
// Calculer la nouvelle hauteur en fonction de la hauteur de la fenêtre
canvas.height = (heightPercentage / 100) * window.innerHeight;
$("#question").text(canvas.width+" "+canvas.height);
var staticContext = staticCanvas.getContext('2d');



// objet qui représente la balle
let ball = {
    x: Math.trunc(canvas.width/2), // position x de la balle
    y: Math.trunc(canvas.height*(7/10)), // position y de la balle
    r: 25, // rayon de la balle
    v: 10 // vitesse de la balle en pixel
};

let newX= ball.x; // nouvelle position x de la balle après interaction (drag & drop)
let newY= ball.y; // nouvelle position y de la balle après interaction (drag & drop)

/**
 * Classe qui représente un rectangle
 * @param {Number} x : position x du rectangle
 * @param {Number} y : position y du rectangle
 * @param {Number} width : largeur du rectangle
 * @param {Number} height : hauteur du rectangle
 * @param {String} color : couleur du rectangle
 */
class Rectangle{
    constructor(x, y, width, height, color) {
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.color = color;
    }
}

/**
 * Classe qui représente une cage
 * @param {Rectangle} fond : rectangle qui représente le fond de la cage
 * @param {Rectangle} poteauGauche : rectangle qui représente le poteau gauche de la cage
 * @param {Rectangle} poteauDroite : rectangle qui représente le poteau droit de la cage
 * @param {Rectangle} interieurCage : rectangle qui représente l'intérieur de la cage
 */
class Cage {
    constructor(fond) {
        this.fond = fond;
        this.poteauGauche = new Rectangle(fond.x, fond.y, fond.height, Math.trunc(fond.width/2), "black");
        this.poteauDroite = new Rectangle(fond.x+fond.width-fond.height, fond.y, fond.height, Math.trunc(fond.width/2), "black");
        this.interieurCage = new Rectangle(fond.x+fond.height, fond.y+fond.height, fond.width-fond.height*2 , Math.trunc(fond.width/2)-fond.height, "red");
    }
}

//initialisation de la réponse
let randCage = Math.floor(Math.random() * 3);

// les objets qui représente la cage
let cageLeft = new Cage(new Rectangle(Math.trunc(canvas.width*(2.5/10))-150, Math.trunc(canvas.height/2)-300, 300, 20, "grey"));
let cageMid = new Cage(new Rectangle(Math.trunc(canvas.width/2)-150, Math.trunc(canvas.height/2)-300, 300, 20, "grey"));
let cageRight = new Cage(new Rectangle(Math.trunc(canvas.width*(7.5/10))-150, Math.trunc(canvas.height/2)-300, 300, 20, "grey"));

/**
 * Permets de détecter le redimensionnement de la page
 * et d'adapter la taille du canvas
 * ainsi que de reset la position du ballon au millieu
 */
function resizeCanvas() {
    // Calculer la nouvelle largeur en fonction de la largeur de la fenêtre
    canvas.width = (widthPercentage / 100) * window.innerWidth;
    // Calculer la nouvelle hauteur en fonction de la hauteur de la fenêtre
    canvas.height = (heightPercentage / 100) * window.innerHeight;

    staticCanvas.width = canvas.width;
    staticCanvas.height = canvas.height;

}
// Gestion du redimensionnement de la fenêtre
window.addEventListener("resize", resizeCanvas);

// Gestion du changement d'orientation sur les appareils mobiles
window.addEventListener("orientationchange", function () {
    // Attendez quelques millisecondes pour permettre au navigateur de mettre à jour les dimensions
    setTimeout(resizeCanvas, 200);
});

/**
 * Permets de détecter les mouvements de la souris
 * et de faire que le ballon suit la souris si la souris est clicker
 * @param {*} e
 * @deprecated remplacer la balle qui suit la souris par une flèche qui indique la direction de la balle
 */
window.addEventListener("mousemove", (e) => {
    if(mouseIsDown){
        newX = (ball.x+((ball.x-e.pageX)));
        newY = (ball.y-((e.pageY-ball.y)));
    }
});
window.addEventListener("touchmove", (e) => {
    console.log("touchmove : ",e);
    if(mouseIsDown){
        newX = (ball.x+((ball.x-e.targetTouches[0].pageX)));
        newY = (ball.y-((e.targetTouches[0].pageY-ball.y)));
    }
});

/**
 * Permets de détecter le click de la souris
 * l'action n'est pris en compte que si la souris est sur le ballon
 */
window.addEventListener("mousedown", (e) => {
    if(e.pageX < ball.x + 50 && e.pageX > ball.x - 50 &&
        e.pageY < ball.y + 50 && e.pageY > ball.y - 50){
        mouseIsDown = true;
    }
});
window.addEventListener("touchstart", (e) => {
    console.log("touchstart : ",e);
    if(e.targetTouches[0].pageX < ball.x + 50 && e.targetTouches[0].pageX > ball.x - 50 &&
        e.targetTouches[0].pageY < ball.y + 50 && e.targetTouches[0].pageY > ball.y - 50){
        mouseIsDown = true;
    }
});

/**
 * A METTRE A JOUR !!! <--------------------------------------
 *
 * Permets de détecter le relachement de la souris
 * l'action n'est pris en compte que si la souris est sur le ballon
 * au relachement de la souris on calcule la nouvelle position de la balle
 * pour qu'elle parte dans la direction opposé de la où la souris est relaché
 */
window.addEventListener("mouseup", (e) => {
    if(mouseIsDown){
        newX = ball.x+((ball.x-e.pageX)*5);
        newY = ball.y-((e.pageY-ball.y)*5);
    }
    mouseIsDown = false;
});
window.addEventListener("touchend", (e) => {
    console.log("touchend : ",e);
    if(mouseIsDown){
        newX = ball.x+((ball.x-e.changedTouches[0].pageX)*5);
        newY = ball.y-((e.changedTouches[0].pageY-ball.y)*5);
    }
    mouseIsDown = false;
});


/**
 * <----------------------------UTILISE LE !-------------------------->
 * Permets de détecter si une position donnée est dans un cercle donné
 * @param {*} circle : circle est un objet de type : {x:Number, y:Number, r:Number}
 * @param {*} pos : pos est un objet de type : {x:Number, y:Number}
 */
function isInsideBall(circle, pos) {
    let dx = Math.abs(circle.x - pos.x);
    let dy = Math.abs(circle.y - pos.y);
    return (dx < circle.r && dy < circle.r);
}

/**
 * Permets de dessiner un cercle sur le canvas
 * @param {*} circle prend en paramètre un objet de type : {x:Number, y:Number, r:Number}
 * @param {*} color prend un string de la couleur
 */
function drawBall(circle,color) {
    ctx.beginPath();
    ctx.arc(circle.x, circle.y, circle.r, 0, Math.PI*2);
    ctx.fillStyle = color;
    ctx.fill();
    ctx.closePath();
}

/**
 * Permet de dessiner un rectangle sur le canvas
 * @param {object} rect prend en paramètre un objet de type : {x:Number, y:Number, width:Number, height:Number}
 * @param {string} color prend un string de la couleur
 */
function drawRectangle(rect,color,context){
    context.beginPath();
    context.rect(rect.x, rect.y, rect.width, rect.height);
    context.fillStyle = color;
    context.fill();
    context.closePath();
}

/**
 * Permet de dessiner la cage sur le canvas
 */
function drawCage(cage,context) {
    // poteau gauche
    drawRectangle(cage.poteauGauche, cage.poteauGauche.color,context);
    //poteau droit
    drawRectangle(cage.poteauDroite, cage.poteauDroite.color,context);
    // fonde la cage
    drawRectangle(cage.fond, cage.fond.color,context);
    // intérieur de la cage <-------------------------------------- A ENLEVER PLUS TARD!!!
    drawRectangle(cage.interieurCage, cage.interieurCage.color,context);
}

/**
 * Permet de calculer la norme d'un vecteur
 * @param xA
 * @param yA
 * @param xB
 * @param yB
 * @returns {number}
 */
function Norm(xA,yA,xB,yB) {
    return Math.sqrt(Math.pow(xB-xA,2)+Math.pow(yB-yA,2));
}

/**
 * Permet de dessiner une flèche sur le canvas
 * @param xA
 * @param yA
 * @param xB
 * @param yB
 * @param ArrowLength
 * @param ArrowWidth
 */
function drawArrow (xA,yA,xB,yB,ArrowLength,ArrowWidth) {
    if (ArrowLength === undefined) {ArrowLength=10;}
    if (ArrowWidth === undefined) {ArrowWidth=8;}
    ctx.lineCap="round";
    // Calculs des coordonnées des points C, D et E
    AB=Norm(xA,yA,xB,yB);
    xC=xB+ArrowLength*(xA-xB)/AB;yC=yB+ArrowLength*(yA-yB)/AB;
    xD=xC+ArrowWidth*(-(yB-yA))/AB;yD=yC+ArrowWidth*((xB-xA))/AB;
    xE=xC-ArrowWidth*(-(yB-yA))/AB;yE=yC-ArrowWidth*((xB-xA))/AB;
    // et on trace le segment [AB], et sa flèche :
    ctx.beginPath();
    ctx.moveTo(xA,yA);ctx.lineTo(xB,yB);
    ctx.moveTo(xD,yD);ctx.lineTo(xB,yB);ctx.lineTo(xE,yE);
    ctx.stroke();
}

/**
 * Permet de dessiner le texte de la réponse sur le canvas
 * @param {string} txt : texte à afficher
 * @param {number} x : position x du texte
 * @param {number} y : position y du texte
 * @param {string} color : couleur du texte
 */
function drawText(txt, x, y, color,context){
    context.font = "30px Arial";
    context.fillStyle = color;
    context.textAlign = "center";
    context.fillText(txt,x,y);
}

function drawAnswer(a,b,c,context){
    repA = (randCage === 0)? a : b;
    repB = (randCage === 1)? a : b;
    repC = (randCage === 2)? a : b;
    drawText("A : "+repA,cageLeft.fond.x+cageLeft.fond.width/2,cageLeft.fond.y-10,"black",context);
    drawText("B : "+repB,cageMid.fond.x+cageMid.fond.width/2,cageMid.fond.y-10,"black",context);
    drawText("C : "+repC,cageRight.fond.x+cageRight.fond.width/2,cageRight.fond.y-10,"black",context);
}

/**
 * Permet de détecter si un cercle et un rectangle donné en paramètre sont en collision
 * @param {*} circle
 * @param {*} rect
 */
function RectCircleColliding(circle,rect){
    let distX = Math.abs(circle.x - rect.x-rect.width/2);
    let distY = Math.abs(circle.y - rect.y-rect.height/2);

    if (distX > (rect.width/2 + circle.r)) { return false; }
    if (distY > (rect.height/2 + circle.r)) { return false; }

    if (distX <= (rect.width/2)) { return true; }
    if (distY <= (rect.height/2)) { return true; }

    let dx=distX-rect.width/2;
    let dy=distY-rect.height/2;
    return (dx*dx+dy*dy<=(circle.r*circle.r));
}

/**
 * Permet de gérer les collisions du jeu
 */
function collisionManager(){
    bounceManager(cageLeft);
    bounceManager(cageMid);
    bounceManager(cageRight);
    if(RectCircleColliding(ball,cageLeft.interieurCage)) { // collision avec l'intérieur de la cage
        cageLeft.interieurCage.color = (randCage === 0)? "green": "orange";
        if(randCage === 0){
            score+=100;
            addScore();
            resetGame();
        }
        console.log("Score !");
    } else if(RectCircleColliding(ball,cageMid.interieurCage)) { // collision avec l'intérieur de la cage
        cageMid.interieurCage.color = (randCage === 1)? "green": "orange";
        if(randCage === 1){
            score+=100;
            addScore();
            resetGame();
        }
        console.log("Score !");
    } else if(RectCircleColliding(ball,cageRight.interieurCage)) { // collision avec l'intérieur de la cage
        cageRight.interieurCage.color = (randCage === 2)? "green": "orange";
        if(randCage === 2){
            score+=100;
            addScore();
            resetGame();
        }
        console.log("Score !");
    }
}

/**
 * Permet de gérer les rebonds de la balle
 * vérifie si la balle est en collision avec un des éléments de la cage
 * si oui alors, on inverse la direction de la balle
 * en calculant la nouvelle position de la balle
 */
function bounceManager(cage){
    if(RectCircleColliding(ball,cage.fond)) { // collision avec le fond de la cage
        newX = ball.x + (newX- ball.x);
        newY = ball.y - (newY - ball.y);
        console.log("BOUNCE !");
    }
    if(RectCircleColliding(ball,cage.poteauGauche) || RectCircleColliding(ball,cage.poteauDroite)) { // collision avec un des poteaux de la cage
        if(ball.y > cage.poteauGauche.y+cage.poteauGauche.height){
            newX = ball.x + (newX- ball.x);
            newY = ball.y - (newY - ball.y);
        } else{
            newX = ball.x - (newX- ball.x);
            newY = ball.y + (newY - ball.y);
        }
        console.log("BOUNCE !");
    }
    if(ball.x < 0 || ball.x > canvas.width){ // collision avec les bords gauche et droite du canvas
        newX = ball.x - (newX- ball.x);
        newY = ball.y + (newY - ball.y);
        console.log("BOUNCE !");
    } else if(ball.y < 0 || ball.y > canvas.height){ // collision avec les bords haut et bas du canvas
        newX = ball.x + (newX- ball.x);
        newY = ball.y - (newY - ball.y);
        console.log("BOUNCE !");
    }
}

// a: actuel {x, y}; n: arrivé {x, y}; v vitesse pixel
/**
 * Permet de faire bouger un objet vers une position donnée
 * @param {*} ac : actuel {x, y} représente la position actuelle de l'objet
 * @param {*} ne : arrivé {x, y} représente la position où l'objet doit aller
 * @param {*} v : vitesse en pixel
 */
function moveObject(ac, ne, v){
    let   s = {x:1, y:1}        // sens
        , move = {x:1, y:1} // pixel de déplacement
        , delta// delta -> pythagore
        , dist = {}     // distance entre start et end
    ;

    // distance x/y
    dist.x = Math.abs(ac.x-ne.x);
    dist.y = Math.abs(ac.y-ne.y);

    // racine carrée de A² + B² (pythagore) → donne l'hypoténuse
    delta = Math.sqrt((dist.x*dist.x)+(dist.y*dist.y));

    // ralentissement en fonction de la distance restante
    let tempV = v
    v *= delta / 1000;

    // règle des tiers afin d'avoir le déplacement par rapport à V et Delta
    move.x = (dist.x*v)/delta;
    move.y = (dist.y*v)/delta;

    v=tempV;

    // déplacement vers la gauche -1, droite 1, haut -1, bas 1
    s.x = (ac.x > ne.x)? -1: 1;
    s.y = (ac.y > ne.y)? -1: 1;

    // rajoute à nos coordonnées actuelles le déplacement dans le bon sens
    ac.x += move.x*s.x;
    ac.y += move.y*s.y;

    // retourne si l'objet est arrivé à son objectif -Vpx=marge d'erreur-
    return (dist.x <= v && dist.y <= v);
}

function resetStaticCanvas(){
    staticContext.clearRect(0, 0, canvas.width, canvas.height);
    drawCage(cageLeft,staticContext);
    drawCage(cageMid,staticContext);
    drawCage(cageRight,staticContext);
    randCage = Math.floor(Math.random() * 3);
    console.log(randCage);
    getQuestion();// récupère une question aléatoire et la dessine sur le canvas hors écran
}

function resetGame(){
    //reset ball
    ball.x = Math.trunc(canvas.width/2);
    ball.y = Math.trunc(canvas.height*(7/10));
    newX = ball.x;
    newY = ball.y;
    resetStaticCanvas(); // reset cage and get new question
    cageLeft.interieurCage.color = "red";
    cageMid.interieurCage.color = "red";
    cageRight.interieurCage.color = "red";
}

/**
 * Fonction qui permet de récupérer une question aléatoire
 * et de la dessiner sur le canvas hors écran
 */
function getQuestion() {
    $.ajax({
        type: "POST",
        url: "/controls/actionController.php",
        data: {
            action: "getRandomQuestion",
        },
        dataType : 'json',
        success: function (response) {
            drawAnswer(response.vrai,response.faux1,response.faux2,staticContext);
            // $("#question").text(response.intitule);
        }
    });
}

function addScore(){
    $.ajax({
        type: "POST",
        url: "/controls/actionController.php",
        data: {
            action: "addScore",
            score: 100,
        },
        dataType : 'json',
    });
}

/**
 * Fonction principale qui permet de dessiner le canvas
 * et de faire fonctionner le jeu
 */
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(staticCanvas, 0, 0);
    drawBall(ball,"#0095DD");
    if(mouseIsDown){
        ctx.strokeStyle="black";
        ctx.lineWidth=4;
        drawArrow(ball.x,ball.y,newX,newY);
        console.log("Arrow")
    } else {
        if((newX !== ball.x || newY !== ball.y) && !mouseIsDown){
            if(moveObject(ball, {x:newX, y:newY}, ball.v)){
                // getQuestion();
                newX = ball.x;
                newY = ball.y
            }
        }
    }
    collisionManager();
}

/**
 * resetStaticCanvas() initialise le canvas hors écran et
 * setInterval va appeler la fonction draw() toutes les 10ms
 */
resetStaticCanvas();
setInterval(draw, 10);