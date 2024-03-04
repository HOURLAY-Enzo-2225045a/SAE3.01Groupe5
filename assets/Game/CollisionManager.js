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
    isCircleCollidingWithRectangle(circle, rectangle) {
        const closestX = Math.max(rectangle.x, Math.min(circle.x, rectangle.x + rectangle.width));
        const closestY = Math.max(rectangle.y, Math.min(circle.y, rectangle.y + rectangle.height));

        const distanceX = circle.x - closestX;
        const distanceY = circle.y - closestY;

        const distanceSquared = distanceX * distanceX + distanceY * distanceY;

        return distanceSquared < circle.radius * circle.radius;
    }

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
}