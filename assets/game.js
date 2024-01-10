/**
 * Projet : Projet Serious Game - Hockey sur glace
 * Par : Groupe 5
 * @author: LKS
 * @version: 1.0
 */

// boolean qui est vrai si la souris est clicker non si elle ne l'ai pas
let mouseIsDown = false;

//setup du canvas
let canvas = document.getElementById("myCanvas"); // récupération du canvas
canvas.width = document.documentElement.clientWidth; // on adapte la taille du canvas à la taille de la page
canvas.height = document.documentElement.clientHeight;
let ctx = canvas.getContext("2d"); // récupération du contexte du canvas
// objet qui représente la balle
let ball = {
    x: Math.trunc(canvas.width/2), // position x de la balle
    y: Math.trunc(canvas.height/2), // position y de la balle
    r: 25, // rayon de la balle
    v: 20 // vitesse de la balle en pixel
};
//let lastX = ball.x; // position x de la balle avant interaction (drag & drop)
//let lastY = ball.y; // position y de la balle avant interaction (drag & drop)
let newX= ball.x; // nouvelle position x de la balle après interaction (drag & drop)
let newY= ball.y; // nouvelle position y de la balle après interaction (drag & drop)

/*
ANCIENNE VERSION <--------------------------------------
// objet qui représente les parties de la cage
let fond = {
    x: Math.trunc(canvas.width/2)-150, // position x du fond de la cage
    y: Math.trunc(canvas.height/2)-300, // position y du fond de la cage
    width: 300, // largeur du fond de la cage
    height: 20, // hauteur du fond de la cage
};
let poteauGauche = {
    x: fond.x,
    y: fond.y,
    width: fond.height,
    height: 150,
};
let poteauDroite = {
    x: fond.x+fond.width-poteauGauche.width,
    y: fond.y,
    width: poteauGauche.width,
    height: poteauGauche.height,
};
let interieurCage = {
    x: fond.x+fond.height,
    y: fond.y+fond.height,
    width: fond.width-poteauGauche.width*2 ,
    height: poteauGauche.height-fond.height,
    color: "red"
};
// objet qui représente la cage
let cage = {
    poteauGauche: poteauGauche,
    poteauDroite: poteauDroite,
    fond: fond,
    interieurCage: interieurCage,
};*/


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
let response = Math.floor(Math.random() * 3);

// les objets qui représente la cage
let cageLeft = new Cage(new Rectangle(0, Math.trunc(canvas.height/2)-300, 300, 20, "grey"));
let cageMid = new Cage(new Rectangle(Math.trunc(canvas.width/2)-150, Math.trunc(canvas.height/2)-300, 300, 20, "grey"));
let cageRight = new Cage(new Rectangle(canvas.width-300, Math.trunc(canvas.height/2)-300, 300, 20, "grey"));

/**
 * Permets de détecter le redimensionnement de la page
 * et d'adapter la taille du canvas
 * ainsi que de reset la position du ballon au millieu
 */
window.addEventListener("resize",() => {
    canvas.width = document.documentElement.clientWidth;
    canvas.height = document.documentElement.clientHeight;
    ball.x = Math.trunc(canvas.width/2);
    ball.y = Math.trunc(canvas.height/2);
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
function drawRectangle(rect,color){
    ctx.beginPath();
    ctx.rect(rect.x, rect.y, rect.width, rect.height);
    ctx.fillStyle = color;
    ctx.fill();
    ctx.closePath();
}

/**
 * Permet de dessiner la cage sur le canvas
 */
function drawCage(cage) {
    // poteau gauche
    drawRectangle(cage.poteauGauche, cage.poteauGauche.color);
    //poteau droit
    drawRectangle(cage.poteauDroite, cage.poteauDroite.color);
    // fonde la cage
    drawRectangle(cage.fond, cage.fond.color);
    // intérieur de la cage <-------------------------------------- A ENLEVER PLUS TARD!!!
    drawRectangle(cage.interieurCage, cage.interieurCage.color);
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
function drawText(txt, x, y, color){
    ctx.font = "30px Arial";
    ctx.fillStyle = color;
    ctx.textAlign = "center";
    ctx.fillText(txt,x,y);
}

function drawAnswer(){
    drawText("Réponse : "+response,canvas.width/2,canvas.height/2,"black");

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
        cageLeft.interieurCage.color = (response == 0)? "green": "orange";
        console.log("Score !");
    } else if(RectCircleColliding(ball,cageMid.interieurCage)) { // collision avec l'intérieur de la cage
        cageMid.interieurCage.color = (response == 1)? "green": "orange";
        console.log("Score !");
    } else if(RectCircleColliding(ball,cageRight.interieurCage)) { // collision avec l'intérieur de la cage
        cageRight.interieurCage.color = (response == 2)? "green": "orange";
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
 * @param {*} ac : actuel {x, y} représente la position actuel de l'objet
 * @param {*} ne : arrivé {x, y} représente la position où l'objet doit aller
 * @param {*} v : vitesse en pixel
 */
function moveObject(ac, ne, v){
    let   s = {x:1, y:1}        // sens
        , move = {x:1, y:1} // pixel de déplacement
        , delta = 0     // delta -> pythagore
        , dist = {}     // distance entre start et end
    ;

    // distance x/y
    dist.x = Math.abs(ac.x-ne.x);
    dist.y = Math.abs(ac.y-ne.y);

    // racine carré de A² + B² (pythagore) -> donne l'hypoténuse
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

    // rajoute à nos coordonnées actuel le déplacement dans le bon sens
    ac.x += move.x*s.x;
    ac.y += move.y*s.y;

    // retourne si l'objet est arrivé à son objectif -Vpx=marge d'erreur-
    return (dist.x <= v && dist.y <= v);
}

/**
 * Fonction principale qui permet de dessiner le canvas
 * et de faire fonctionner le jeu
 */
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawCage(cageLeft);
    drawCage(cageMid);
    drawCage(cageRight);
    //drawBall({x:newX, y:newY, r:ball.r},"orange");
    drawBall(ball,"#0095DD");
    if(mouseIsDown){
        ctx.strokeStyle="black";
        ctx.lineWidth=4;
        drawArrow(ball.x,ball.y,newX,newY);
        console.log("Arrow")
    } else {
        if((newX !== ball.x || newY !== ball.y) && !mouseIsDown){
            if(moveObject(ball, {x:newX, y:newY}, ball.v)){
                lastX = newX;
                lastY = newY;
            }
        }
    }

    collisionManager();
}

/**
 * Fonction qui va appeler la fonction draw() toutes les 10ms
 */
setInterval(draw, 10);