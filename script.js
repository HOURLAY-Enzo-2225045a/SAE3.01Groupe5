// boolean qui est vrai si la souris est clicker non si elle ne l'ai pas
let mouseIsDown = false;

//setup du canvas
let canvas = document.getElementById("myCanvas");
canvas.width = document.documentElement.clientWidth;
canvas.height = document.documentElement.clientHeight;
let ctx = canvas.getContext("2d");
// objet qui représente la balle
let ball = {
    x: Math.trunc(canvas.width/2),
    y: Math.trunc(canvas.height/2),
    r: 25
};
let lastX = ball.x;
let lastY = ball.y;
let newX = lastX;
let newY = lastY;

// objet qui représente les partie de la cage
let poteauGauche = {
    x: Math.trunc(canvas.width/2)-150,
    y: 20,
    width: 20,
    height: 150,
}
let poteauDroite = {
    x: Math.trunc(canvas.width/2)+130,
    y: 20,
    width: 20,
    height: 150,
}
let fond = {
    x: Math.trunc(canvas.width/2)-150,
    y: 20,
    width: 300,
    height: 20,
}
// objet qui représente la cage
let cage = {
    poteauGauche: poteauGauche,
    poteauDroite: poteauDroite,
    fond: fond
};


window.addEventListener("resize",(e) => {
    /**
     * A chaque de taille de la page
     * on adapte la taille du canva
     * ainsiq qu'on reset la position du ballon au millieu
     */
    canvas.width = document.documentElement.clientWidth;
    canvas.height = document.documentElement.clientHeight;
    ball.x = Math.trunc(canvas.width/2);
    ball.y = Math.trunc(canvas.height/2);
});

window.addEventListener("mousemove", (e) => {
    if(mouseIsDown){
        ball.x = e.pageX;
        ball.y = e.pageY;
    }
});

window.addEventListener("mousedown", (e) => {
    if(e.pageX < ball.x + 50 && e.pageX > ball.x - 50 &&
        e.pageY < ball.y + 50 && e.pageY > ball.y - 50){
        mouseIsDown = true;
    }
});

window.addEventListener("mouseup", (e) => {
    // METTRE A JOUR LES COMMENTAIRE
    if(e.pageX < ball.x + 50 && e.pageX > ball.x - 50 &&
        e.pageY < ball.y + 50 && e.pageY > ball.y - 50){
        newX = (lastX+(lastX-e.pageX));
        newY = lastY-(e.pageY-lastY);
        // calcul de x du point  d'arriver de la balle
        /*if(lastX<e.pageX){ // si la position x de la souris(pageX) est à droite de l'emplacement initial du ballon
            newX = (lastX+(lastX-e.pageX)); // il faut soustraire la différence pour obtenir le nouveau x
        } else{ // sinon la position de la souris(pageX) est à gauche
            newX = (lastX+(lastX-e.pageX)); // alors il faut ajouter la différence pour obtenir le nouveau x
        }

        // calcul de y du point  d'arriver de la balle
        if(lastY>e.pageY){ // si la position y de la souris(pageY) est plus bas que l'emplacement initial du ballon
            newY = lastY-(e.pageY-lastY); // il faut soustraire la différence pour obtenir le nouveau y
        } else{ // sinon la position y de la souris(pageY) est au dessus
            newY = lastY-(e.pageY-lastY); // alors il faut ajouter la différence pour obtenir le nouveau y
        } // *2 pour donner de la puissance au tire */
    }

    mouseIsDown = false;
});


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

function drawCage() {
    // poteau gauche
    drawRectangle(cage.poteauGauche, "black");
    //poteau droit
    drawRectangle(cage.poteauDroite, "black");
    // fonde la cage
    drawRectangle(cage.fond, "grey");
}

function RectCircleColliding(circle,rect){
    var distX = Math.abs(circle.x - rect.x-rect.width/2);
    var distY = Math.abs(circle.y - rect.y-rect.height/2);

    if (distX > (rect.width/2 + circle.r)) { return false; }
    if (distY > (rect.height/2 + circle.r)) { return false; }

    if (distX <= (rect.width/2)) { return true; }
    if (distY <= (rect.height/2)) { return true; }0// <-------------------probleme--------------------------------------------

    var dx=distX-rect.width/2;
    var dy=distY-rect.height/2;
    return (dx*dx+dy*dy<=(circle.r*circle.r));
}

function collisionManager(){
    if(RectCircleColliding(ball,cage.fond) ||
        RectCircleColliding(ball,cage.poteauGauche) ||
        RectCircleColliding(ball,cage.poteauDroite)){
        console.log("BOUNCE !");
        let distX = Math.abs(ball.x-newX);
        let distY = Math.abs(ball.y-newY);
        console.log("newX : "+newX+" newY : "+newY);
        console.log("distX : "+distX+" distY : "+distY);
        if(newY < ball.y){
            newY += (ball.y-newY)*2;
        } else {
            newY -= ball.y-newY;
        }
        // if(ball.x > newX){
        //     newX += distX;
        // } else {
        //     newX -= distX;
        // }
        // newX = lastX;
        // newY = lastY;
        // lastX = ball.x;
        // lastY = ball.y;
    }
}

// a: actuel {x, y}; n: arrivé {x, y}; v vitesse pixel
function moveObject(ac, ne, v){
    var   s = {x:1, y:1}        // sens
        , move = {x:1, y:1} // pixel de déplacement
        , delta = 0     // delta -> pythagore
        , dist = {}     // distance entre start et end
    ;

    // distance x/y
    dist.x = Math.abs(ac.x-ne.x);
    dist.y = Math.abs(ac.y-ne.y);

    // racine carré de A² + B² (pythagore) -> donne l'hypoténuse
    delta = Math.sqrt((dist.x*dist.x)+(dist.y*dist.y));

    // règle des tiers afin d'avoir le déplacement par rapport à V et Delta
    move.x = (dist.x*v)/delta;
    move.y = (dist.y*v)/delta;

    // déplacement vers la gauche -1, droite 1, haut -1, bas 1
    s.x = (ac.x > ne.x)? -1: 1;
    s.y = (ac.y > ne.y)? -1: 1;

    // rajoute à nos coordonnées actuel le déplacement dans le bon sens
    ac.x += move.x*s.x;
    ac.y += move.y*s.y;

    // retourne si l'objet est arrivé à son objectif -Vpx=marge d'erreur-
    return (dist.x <= v && dist.y <= v)? true: false;
};

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawCage();
    drawBall({x:newX, y:newY, r:ball.r},"orange");
    drawBall(ball,"#0095DD");
    if(newX != lastX || newY != lastY){
        if(moveObject(ball, {x:newX, y:newY}, 10)){
            lastX = newX;
            lastY = newY;
        }
    }
    collisionManager();
};

setInterval(draw, 10);