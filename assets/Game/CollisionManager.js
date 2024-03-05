export class CollisionManager {
    constructor(game, canvas) {
        this.game = game;
        this.canvas = canvas;
    }

    // Méthode pour savoir si deux cercles entre en collision
    areCirclesColliding(circle1, circle2) {
        const dx = circle1.x - circle2.x;
        const dy = circle1.y - circle2.y;
        const distance = Math.sqrt(dx * dx + dy * dy);

        return distance <= circle1.radius + circle2.radius;
    }

    // Méthode pour vérifier la collision entre un cercle et un rectangle
    /* isCircleCollidingWithRectangle(circle, rectangle) {
         const closestX = Math.max(rectangle.x, Math.min(circle.x, rectangle.x + rectangle.width));
         const closestY = Math.max(rectangle.y, Math.min(circle.y, rectangle.y + rectangle.height));

         const distanceX = circle.x - closestX;
         const distanceY = circle.y - closestY;

         const distanceSquared = distanceX * distanceX + distanceY * distanceY;

         return distanceSquared < circle.radius * circle.radius;
     }/*

     // méthode pour savoir si un cercle entre en collision avec les bords droite ou gauche du canva
     isCircleCollidingWithCanvaLeftOrRightEdges(circle){
         return Math.abs(circle.x - 0) < circle.radius || Math.abs(circle.x - this.canvas.width) < circle.radius;
     }

     // méthode pour savoir si un cercle entre en collision avec les bords haut et bas du canva
     isCircleCollidingWithCanvaUpOrDownEdges(circle){
         return Math.abs(circle.y - 0) < circle.radius || Math.abs(circle.y - this.canvas.height) < circle.radius;
     }

     gameDefenseHandleCollisions(defender, leftStiker, midleStriker, rightStriker, goal) {
         // gestion des collisions entre le defenseur et les attaquants
         if(this.areCirclesColliding(defender, leftStiker) === true) {
             if(defender.answer === leftStiker.answer) this.game.resetGame();
             else defender.bounce();
         }
         if(this.areCirclesColliding(defender, midleStriker) === true) {
             if(defender.answer === midleStriker.answer) this.game.resetGame();
             else defender.bounce();
         }
         if(this.areCirclesColliding(defender, rightStriker) === true) {
             if(defender.answer === rightStriker.answer) this.game.resetGame();
             else defender.bounce();
         }

         // gestion des collisions entre le defenseur et la cage

         if(this.isCircleCollidingWithRectangle(defender, goal.leftPost) === true) {
             defender.bounce();
         }
         if(this.isCircleCollidingWithRectangle(defender, goal.rightPost) === true) {
             defender.bounce();
         }
         if(this.isCircleCollidingWithRectangle(defender, goal.back) === true) {
             defender.bounce();
         }

         // gestion des collisions entre les attaquants et la cage
         if(this.isCircleCollidingWithRectangle(leftStiker, goal.inside) === true) this.game.resetGame();
         if(this.isCircleCollidingWithRectangle(midleStriker, goal.inside) === true) this.game.resetGame();
         if(this.isCircleCollidingWithRectangle(rightStriker, goal.inside) === true) this.game.resetGame();

         // gestion des collisions entre le defenseur et les bords du canvas
         if(this.isCircleCollidingWithCanvaUpOrDownEdges(defender)) defender.bounceHorizontal();
         if(this.isCircleCollidingWithCanvaLeftOrRightEdges(defender)) defender.bounceVertical();

         // gestion des collisions entre les attaquants et les bords du canvas
         if(this.isCircleCollidingWithCanvaUpOrDownEdges(leftStiker)) this.game.resetGame();
         if(this.isCircleCollidingWithCanvaUpOrDownEdges(midleStriker)) this.game.resetGame();
         if(this.isCircleCollidingWithCanvaUpOrDownEdges(rightStriker)) this.game.resetGame();
         if(this.isCircleCollidingWithCanvaLeftOrRightEdges(leftStiker)) this.game.resetGame();
         if(this.isCircleCollidingWithCanvaLeftOrRightEdges(midleStriker)) this.game.resetGame();
         if(this.isCircleCollidingWithCanvaLeftOrRightEdges(rightStriker)) this.game.resetGame();
     }

     gameStrikerHandleCollisions(striker, leftGoal, midleGoal, rightGoal) {
         // gestion des collisions entre l'attaquant et l'intérieur des cages
         if(this.isCircleCollidingWithRectangle(striker, leftGoal.inside) === true){
             if(striker.answer === leftGoal.answer) this.game.resetGame();
         }
         if(this.isCircleCollidingWithRectangle(striker, midleGoal.inside) === true){
             if(striker.answer === midleGoal.answer) this.game.resetGame();
         }
         if(this.isCircleCollidingWithRectangle(striker, rightGoal.inside) === true){
             if(striker.answer === rightGoal.answer) this.game.resetGame();
         }

         // gestion des collisions entre l'attaquant et les bords des cages
         if(this.isCircleCollidingWithRectangle(striker, leftGoal.leftPost) === true) {
             striker.bounce();
         }
         if(this.isCircleCollidingWithRectangle(striker, leftGoal.rightPost) === true) {
             striker.bounce();
         }
         if(this.isCircleCollidingWithRectangle(striker, leftGoal.back) === true) {
             striker.bounce();
         }

         if(this.isCircleCollidingWithRectangle(striker, midleGoal.leftPost) === true) {
             striker.bounce();
         }
         if(this.isCircleCollidingWithRectangle(striker, midleGoal.rightPost) === true) {
             striker.bounce();
         }
         if(this.isCircleCollidingWithRectangle(striker, midleGoal.back) === true) {
             striker.bounce();
         }

         if(this.isCircleCollidingWithRectangle(striker, rightGoal.leftPost) === true) {
             striker.bounce();
         }
         if(this.isCircleCollidingWithRectangle(striker, rightGoal.rightPost) === true) {
             striker.bounce();
         }
         if(this.isCircleCollidingWithRectangle(striker, rightGoal.back) === true) {
             striker.bounce();
         }

         // gestion des collisions entre l'attaquant et les bords du canvas
         if(this.isCircleCollidingWithCanvaUpOrDownEdges(striker)) striker.bounceHorizontal();
         if(this.isCircleCollidingWithCanvaLeftOrRightEdges(striker)) striker.bounceVertical();
     }

     /**
      * Vérifie si un cercle est en collision avec un rectangle
      * Vérifie également la trajectoire de la balle
      * @param circle
      * @param rect
      * @param prevCircle
      * @returns {boolean}
      * @constructor
      */
    isCircleCollidingWithRect(circle, rect, prevCircle) {
        // Vérifie si le palet est en collision avec le rectangle
        let collision = this.isCircleCollidingWithRectBasic(circle, rect);
        if (collision) {
            return true;
        }

        // Si aucune collision n'est détectée, vérifie la trajectoire de la balle
        let distX = Math.abs(prevCircle.x - circle.x);
        let distY = Math.abs(prevCircle.y - circle.y);
        let steps = Math.max(distX, distY);

        let stepX = (circle.x - prevCircle.x) / steps;
        let stepY = (circle.y - prevCircle.y) / steps;

        let testCircle = {x: prevCircle.x, y: prevCircle.y, radius: circle.radius};

        for (let i = 0; i < steps; i++) {
            testCircle.x += stepX;
            testCircle.y += stepY;

            collision = this.isCircleCollidingWithRectBasic(testCircle, rect);
            if (collision) {
                return true;
            }
        }

        return false;
    }

    /**
     * Vérifie si un cercle est en collision avec un rectangle
     * @param circle
     * @param rect
     * @returns {boolean}
     * @constructor
     */
    isCircleCollidingWithRectBasic(circle, rect) {
        let distX = Math.abs(circle.x - rect.x - rect.width/2);
        let distY = Math.abs(circle.y - rect.y-rect.height/2);

        if (distX > (rect.width/2 + circle.radius)) { return false; }
        if (distY > (rect.height/2 + circle.radius)) { return false; }

        if (distX <= (rect.width/2)) { return true; }
        if (distY <= (rect.height/2)) { return true; }

        let dx=distX-rect.width/2;
        let dy=distY-rect.height/2;
        return (dx*dx+dy*dy<=(circle.radius*circle.radius));
    }

    handleCollisionsAttack(circle, cages) {
        for (let cage of cages) {
            for (let rect of cage.getRects()) {
                if (this.isCircleCollidingWithRect(circle, rect, circle.prevPos)) {
                    this.bounceManager(rect,circle);
                }
            }
            if(this.isCircleCollidingWithRect(circle, cage.getInside(), circle.prevPos)){
                this.game.addScore();
            }
        }
        if(Math.abs(circle.x - 0) < circle.radius) { // collision avec le bord gauche du canvas
            circle.bounce("vertical");
            circle.x = circle.radius; // assure que la balle reste à l'intérieur du canvas
            circle.resetStartPos();
        } else if(Math.abs(circle.x - this.canvas.width) < circle.radius) { // collision avec le bord droit du canvas
            circle.bounce("vertical");
            circle.x = this.canvas.width - circle.radius; // assure que la balle reste à l'intérieur du canvas
            circle.resetStartPos();
        } else if(Math.abs(circle.y - 0) < circle.radius) { // collision avec le bord haut du canvas
            circle.bounce("horizontal");
            circle.y = circle.radius; // assure que la balle reste à l'intérieur du canvas
            circle.resetStartPos();
        } else if(Math.abs(circle.y - this.canvas.height) < circle.radius) { // collision avec le bord bas du canvas
            circle.bounce("horizontal");
            circle.y = this.canvas.height - circle.radius; // assure que la balle reste à l'intérieur du canvas
            circle.resetStartPos();
        }
    }

    bounceManager(rect, circle) {
        let distX, distY;
        if (circle.x < rect.x) { // à gauche du rectangle
            distX = rect.x - circle.x;
        } else if (circle.x > rect.x + rect.width) { // à droite du rectangle
            distX = circle.x - (rect.x + rect.width);
        } else { // au-dessus ou en-dessous du rectangle
            distX = 0;
        }

        if (circle.y < rect.y) { // au-dessus du rectangle
            distY = rect.y - circle.y;
        } else if (circle.y > rect.y + rect.height) { // en-dessous du rectangle
            distY = circle.y - (rect.y + rect.height);
        } else { // à gauche ou à droite du rectangle
            distY = 0;
        }

        if (distX > distY) {
            // Collision avec le côté gauche ou droit de la cage
            circle.bounce("vertical");
            // Ajout d'un décalage pour éviter que la balle ne reste coincée
            circle.x += (circle.x > rect.x) ? circle.radius-distX : -(circle.radius-distX);
        } else {
            // Collision avec le haut ou le bas de la cage
            circle.bounce("horizontal");
            // Ajout d'un décalage pour éviter que la balle ne reste coincée
            circle.y += (circle.y > rect.y) ? circle.radius-distY : -(circle.radius-distY);
        }
    }
}