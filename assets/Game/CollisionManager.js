export class CollisionManager {
    constructor(canvas, palet, cages) {
        this.canvas = canvas;
        this.palet = palet;
        this.cages = cages;
    }

    RectCircleColliding(circle, rect, prevCircle) {
        // Check for collision using the current position of the ball
        let collision = this.RectCircleCollidingBasic(circle, rect);
        if (collision) {
            return true;
        }

        // If no collision is detected, check the trajectory of the ball
        let distX = Math.abs(prevCircle.x - circle.x);
        let distY = Math.abs(prevCircle.y - circle.y);
        let steps = Math.max(distX, distY);

        let stepX = (circle.x - prevCircle.x) / steps;
        let stepY = (circle.y - prevCircle.y) / steps;

        let testCircle = {x: prevCircle.x, y: prevCircle.y, radius: circle.radius};

        for (let i = 0; i < steps; i++) {
            testCircle.x += stepX;
            testCircle.y += stepY;

            collision = this.RectCircleCollidingBasic(testCircle, rect);
            if (collision) {
                return true;
            }
        }

        return false;
    }

    RectCircleCollidingBasic(circle, rect) {
        let distX = Math.abs(circle.x - rect.x-rect.width/2);
        let distY = Math.abs(circle.y - rect.y-rect.height/2);

        if (distX > (rect.width/2 + circle.radius)) { return false; }
        if (distY > (rect.height/2 + circle.radius)) { return false; }

        if (distX <= (rect.width/2)) { return true; }
        if (distY <= (rect.height/2)) { return true; }

        let dx=distX-rect.width/2;
        let dy=distY-rect.height/2;
        return (dx*dx+dy*dy<=(circle.radius*circle.radius));
    }

    handleCollisions() {
        for (let cage of this.cages) {
            for (let rect of cage.getRects()) {
                if (this.RectCircleColliding(this.palet, rect)) {
                    console.log("Collision with cage");
                    this.bounceManager(rect);
                }
            }
        }
        if(Math.abs(this.palet.x - 0) < this.palet.radius) { // collision avec le bord gauche du canvas
            this.palet.bounce("vertical");
            this.palet.x = this.palet.radius; // assure que la balle reste à l'intérieur du canvas
            this.palet.resetStartPos();
        } else if(Math.abs(this.palet.x - this.canvas.width) < this.palet.radius) { // collision avec le bord droit du canvas
            this.palet.bounce("vertical");
            this.palet.x = this.canvas.width - this.palet.radius; // assure que la balle reste à l'intérieur du canvas
            this.palet.resetStartPos();
        } else if(Math.abs(this.palet.y - 0) < this.palet.radius) { // collision avec le bord haut du canvas
            this.palet.bounce("horizontal");
            this.palet.y = this.palet.radius; // assure que la balle reste à l'intérieur du canvas
            this.palet.resetStartPos();
        } else if(Math.abs(this.palet.y - this.canvas.height) < this.palet.radius) { // collision avec le bord bas du canvas
            this.palet.bounce("horizontal");
            this.palet.y = this.canvas.height - this.palet.radius; // assure que la balle reste à l'intérieur du canvas
            this.palet.resetStartPos();
        }
    }

    bounceManager(rect) {
        let distX = this.palet.x - (rect.x + rect.width / 2);
        let distY = this.palet.y - (rect.y + rect.height / 2);

        if (Math.abs(distX) > Math.abs(distY)) {
            // Collision avec le côté gauche ou droit de la cage
            this.palet.bounce("vertical");
        } else {
            // Collision avec le haut ou le bas de la cage
            this.palet.bounce("horizontal");
        }
    }
}