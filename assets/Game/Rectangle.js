/**
 * Classe qui représente un rectangle
 * @param {Number} x : position x du rectangle
 * @param {Number} y : position y du rectangle
 * @param {Number} width : largeur du rectangle
 * @param {Number} height : hauteur du rectangle
 * @param {String} color : couleur du rectangle
 */
export class Rectangle{
    constructor(x, y, width, height, color) {
        this.posX = x;
        this.posY = y;
        this.width = width;
        this.height = height;
        this.color = color;
    }

    draw(context){
        context.beginPath();
        context.rect(this.posX, this.posY, this.width, this.height);
        context.fillStyle = this.color;
        context.fill();
        context.closePath();
    }
}