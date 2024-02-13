

/**
 * Classe qui représente un palet
 *
 *
 */
export class Palet {
    constructor(x, y, r,v) {
        this.posX = x;
        this.posY = y;
        this.radius = r;
        this.velocity = v;
    }

    draw(context) {
        context.beginPath();
        context.arc(this.x, this.y, this.r, 0, Math.PI*2);
        context.fillStyle = "#0095DD";
        context.fill();
        context.closePath();
    }

    move(newX, newY) {
        this.posX = newX;
        this.posY = newY;
    }
}