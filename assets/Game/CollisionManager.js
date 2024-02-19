export class CollisionManager {
    constructor(canvas, palet) {
        this.canvas = canvas;
        this.palet = palet;
    }

    RectCircleColliding(circle,rect) {
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

    handleCollisions() {
        if(Math.abs(this.palet.x - 0) < this.palet.radius || Math.abs(this.palet.x - this.canvas.width) < this.palet.radius){ // collision avec les bords gauche et droite du canvas
            this.palet.bounceVertical();
            /*newX = this.palet.x - (newX- this.palet.x);
            newY = this.palet.y + (newY - this.palet.y);*/
        } else if(Math.abs(this.palet.y - 0) < this.palet.radius || Math.abs(this.palet.y - this.canvas.height) < this.palet.radius){ // collision avec les bords haut et bas du canvas
            this.palet.bounceHorizontal();
        }
    }

    bounceManager(cage) {
        if (cage.isInside(this.palet)) {
            console.log("Inside cage");
            this.palet.bounce();
        }
    }
}