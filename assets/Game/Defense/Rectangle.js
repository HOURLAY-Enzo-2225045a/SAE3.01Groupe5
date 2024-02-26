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
        this.x = x; // position horizontal du centre
        this.y = y; // position vertical du centre
        this.width = width; // largeur
        this.height = height; // hauteur
        this.color = color; // couleur
    }

    draw(context){
        context.beginPath();
        context.rect(this.x, this.y, this.width, this.height);
        context.fillStyle = this.color;
        context.fill();
        context.closePath();
    }
}