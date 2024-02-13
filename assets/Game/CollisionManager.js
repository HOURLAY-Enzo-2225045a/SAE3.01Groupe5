export class CollisionManager {
    constructor(palet, cages) {
        this.palet = palet;
        this.cages = cages;
    }

    checkCollisions() {
        for (let cage of this.cages) {
            if (cage.isInside(this.palet)) {
                return cage;
            }
        }
        return null;
    }

    RectCircleColliding(circle,rect){
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

    collisionManager(){
        bounceManager(cageLeft);
        bounceManager(cageMid);
        bounceManager(cageRight);
        if(RectCircleColliding(ball,cageLeft.interieurCage)) { // collision avec l'intérieur de la cage
            if(randCage === 0){
                score+=100;
                addScore();
                resetGame();
            } else {
                resetGame();
            }
        } else if(RectCircleColliding(ball,cageMid.interieurCage)) { // collision avec l'intérieur de la cage
            if(randCage === 1){
                score+=100;
                addScore();
                resetGame();
            } else {
                resetGame();
            }
        } else if(RectCircleColliding(ball,cageRight.interieurCage)) { // collision avec l'intérieur de la cage
            if(randCage === 2){
                score+=100;
                addScore();
                resetGame();
            } else {
                resetGame();
            }
        }
    }
}