import { Rectangle } from "/assets/Game/Rectangle.js"

/**
 * Classe qui représente une cage
 * @param {Rectangle} back : rectangle qui représente le fond de la cage
 * @param {Rectangle} poteauGauche : rectangle qui représente le poteau gauche de la cage
 * @param {Rectangle} poteauDroite : rectangle qui représente le poteau droit de la cage
 * @param {Rectangle} interieurCage : rectangle qui représente l'intérieur de la cage
 */
export class Cage {
    constructor(back) {
        this.back = back;
        this.leftPole = new Rectangle(back.posX, back.posY, back.height, Math.trunc(back.width/2), "black");
        this.rightPole = new Rectangle(back.posX+back.width-back.height, back.posY, back.height, Math.trunc(back.width/2), "black");
        this.inside = new Rectangle(back.posX+back.height, back.posY+back.height, back.width-back.height*2 , Math.trunc(back.width/8), "red");
    }

    draw(context) {
        // poteau gauche
        this.leftPole.draw(context);
        //poteau droit
        this.rightPole.draw(context);
        // fond de la cage
        this.back.draw(context);
    }

    isInside(palet) {
        return this.inside.isInside(palet);
    }

    getBack(){
        return this.back;
    }
}

