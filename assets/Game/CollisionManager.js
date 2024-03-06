export class CollisionManager {
    constructor(game, canvas) {
        this.game = game;
        this.canvas = canvas;
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

    areCirclesColliding(circle1, circle2, prevCircle1) {
        let collision = this.areCirclesCollidingBasic(circle1, circle2);
        if (collision) {
            return true;
        }

        // Si aucune collision n'est détectée, vérifie la trajectoire de la balle
        let distX = Math.abs(prevCircle1.x - circle1.x);
        let distY = Math.abs(prevCircle1.y - circle1.y);
        let steps = Math.max(distX, distY);

        let stepX = (circle1.x - prevCircle1.x) / steps;
        let stepY = (circle1.y - prevCircle1.y) / steps;

        let testCircle = {x: prevCircle1.x, y: prevCircle1.y, radius: circle1.radius};

        for (let i = 0; i < steps; i++) {
            testCircle.x += stepX;
            testCircle.y += stepY;

            collision = this.areCirclesCollidingBasic(testCircle, circle1);
            if (collision) {
                return true;
            }
        }

        return false;
    }

    areCirclesCollidingBasic(circle1, circle2){
        let distX = Math.abs(circle1.x - circle2.x - circle2.radius/2);
        let distY = Math.abs(circle1.y - circle2.y - circle2.radius/2);

        if (distX > (circle2.radius/2 + circle1.radius)) { return false; }
        if (distY > (circle2.radius/2 + circle1.radius)) { return false; }

        if (distX <= (circle2.radius/2)) { return true; }
        if (distY <= (circle2.radius/2)) { return true; }

        let dx=distX-circle2.radius/2;
        let dy=distY-circle2.radius/2;
        return (dx*dx+dy*dy<=(circle1.radius * circle1.radius));
    }






    handleCollisionsAttack(circle, cages) {
        let i = 0;
        for (let cage of cages) {
            for (let rect of cage.getRects()) {
                if (this.isCircleCollidingWithRect(circle, rect, circle.prevPos)) {
                    this.bounceManager(rect,circle);
                }
            }
            if(this.isCircleCollidingWithRect(circle, cage.getInside(), circle.prevPos)&& this.game.responseGoal === i){
                this.game.addScore();
                this.game.getQuestion();
            }
            ++i;
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

    handleCollisionsDefense(defender, cage, strikers) {
        let i = 0;

        // Gestion des attaquants avec la cage
        for (let striker of strikers) {
            if (this.isCircleCollidingWithRect(striker, cage.inside, striker.prevPos)) {
                for (let striker of strikers) {
                    striker.resetPosition();
                }
            }
        }

        // Gestion du defenseur avec la cage
        for (let rect of cage.getRects()) {
            if (this.isCircleCollidingWithRect(defender, rect, defender.prevPos)) {
                this.bounceManager(rect,defender);
            }
        }

        // Gestion du defenseur avec les attaquants
        for (let striker of strikers) {
            if (this.areCirclesColliding(defender, striker, defender) && this.game.responseStriker === i) {
                this.game.addScore();
                this.game.getQuestion();
            }
            else if(this.areCirclesColliding(defender, striker, defender)){
                this.bounceManagerDefense(striker,defender);
            }
            ++i;
        }

        // Gestion du defenseur avec le canvas
        if(Math.abs(defender.x - 0) < defender.radius) { // collision avec le bord gauche du canvas
            defender.bounce("vertical");
            defender.x = defender.radius; // assure que la balle reste à l'intérieur du canvas
            defender.resetStartPos();
        }
        else if(Math.abs(defender.x - this.canvas.width) < defender.radius) { // collision avec le bord droit du canvas
            defender.bounce("vertical");
            defender.x = this.canvas.width - defender.radius; // assure que la balle reste à l'intérieur du canvas
            defender.resetStartPos();
        }
        else if(Math.abs(defender.y - 0) < defender.radius) { // collision avec le bord haut du canvas
            defender.bounce("horizontal");
            defender.y = defender.radius; // assure que la balle reste à l'intérieur du canvas
            defender.resetStartPos();
        }
        else if(Math.abs(defender.y - this.canvas.height) < defender.radius) { // collision avec le bord bas du canvas
            defender.bounce("horizontal");
            defender.y = this.canvas.height - defender.radius; // assure que la balle reste à l'intérieur du canvas
            defender.resetStartPos();
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

    bounceManagerDefense(circle2, circle1) {
        let distX, distY;
        if (circle1.x < circle2.x) { // à gauche du circle2angle
            distX = circle2.x - circle1.x;
        } else if (circle1.x > circle2.x + circle2.radius) { // à droite du rectangle
            distX = circle1.x - (circle2.x + circle2.radius);
        } else { // au-dessus ou en-dessous du rectangle
            distX = 0;
        }

        if (circle1.y < circle2.y) { // au-dessus du rectangle
            distY = circle2.y - circle1.y;
        } else if (circle1.y > circle2.y + circle2.radius) { // en-dessous du rectangle
            distY = circle1.y - (circle2.y + circle2.radius);
        } else { // à gauche ou à droite du rectangle
            distY = 0;
        }

        if (distX > distY) {
            // Collision avec le côté gauche ou droit de la cage
            circle1.bounce("vertical");
            // Ajout d'un décalage pour éviter que la balle ne reste coincée
            circle1.x += (circle1.x > rect.x) ? circle1.radius-distX : -(circle1.radius-distX);
        } else {
            // Collision avec le haut ou le bas de la cage
            circle1.bounce("horizontal");
            // Ajout d'un décalage pour éviter que la balle ne reste coincée
            circle1.y += (circle1.y > circle2.y) ? circle1.radius-distY : -(circle1.radius-distY);
        }
    }

}