import "Rectangle.js"

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
        this.interieurCage = new Rectangle(fond.x+fond.height, fond.y+fond.height, fond.width-fond.height*2 , Math.trunc(fond.width/8), "red");
    }
}