export class Circle{
    constructor(x,y, radius, velocity){
        this.x = x;
        this.y = y;
        this.radius = radius;
        this.velocity = velocity;
        this.newX = x;
        this.newY = y;
        this.initialX = x;
        this.initialY = y;
        this.answer = null;
    }

    checkNewPos() {
        return (this.newX !== this.x || this.newY !== this.y);
    }

    // rétabli la position du cercle à sa position de base
    resetNewPos() {
        this.newX = this.x;
        this.newY = this.y;
    }

    // ajoute le cercle à l'écran
    draw(context) {
        context.beginPath();
        context.arc(this.x, this.y, this.radius, 0, Math.PI*2);
        context.fillStyle = "#0095DD";
        context.fill();
        context.closePath();
    }

    move() {
        let s = {x:1, y:1},         // sens
            move = {x:1, y:1},         // pixel de déplacement
            delta,                                        // delta -> pythagore
            dist = {};                               // distance entre start et end

        // distance x/y
        dist.x = Math.abs(this.x - this.newX);
        dist.y = Math.abs(this.y - this.newY);

        // racine carrée de A² + B² (pythagore) → donne l'hypoténuse
        delta = Math.sqrt((dist.x*dist.x)+(dist.y*dist.y));

        // ralentissement en fonction de la distance restante
        let tempV = this.velocity
        this.velocity *= delta / 1000;

        // règle des tiers afin d'avoir le déplacement par rapport à V et Delta
        move.x = (dist.x*this.velocity)/delta;
        move.y = (dist.y*this.velocity)/delta;

        this.velocity=tempV;

        // déplacement vers la gauche -1, droite 1, haut -1, bas 1
        s.x = (this.x > this.newX)? -1: 1;
        s.y = (this.y > this.newY)? -1: 1;

        // rajoute à nos coordonnées actuelles le déplacement dans le bon sens
        this.x += move.x*s.x;
        this.y += move.y*s.y;

        // retourne si l'objet est arrivé à son objectif -Vpx=marge d'erreur-
        return (dist.x <= this.velocity && dist.y <= this.velocity);
    }

    moveDown() {
        this.y += this.velocity;
    }

    bounce() {
        this.bounceVertical();
        this.bounceHorizontal();
    }

    bounceVertical(){
        this.newX = this.x - (this.newX - this.x);
    }

    bounceHorizontal(){
        this.newY = this.y - (this.newY - this.y);
    }

    resetPosition() {
        this.x = this.initialX;
        this.y = this.initialY;
        this.newX = this.initialX;
        this.newY = this.initialY;
    }
}