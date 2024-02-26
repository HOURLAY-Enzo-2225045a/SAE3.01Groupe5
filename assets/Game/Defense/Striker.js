export class Striker{

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

    draw(context) {
        context.beginPath();
        context.arc(this.x, this.y, this.radius, 0, Math.PI*2);
        context.fillStyle = "#0095DD";
        context.fill();
        context.closePath();
    }

    resetPosition() {
        this.x = this.initialX;
        this.y = this.initialY;
        this.newX = this.initialX;
        this.newY = this.initialY;
    }

    moveDown() {
        this.y += this.velocity;
    }

}