export class CollisionManager {
    constructor() {
    }

    // Méthode pour vérifier la collision entre deux cercles
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

    // méthode pour vérifier la collision entre un cercle et les bords droite ou gauche du canva
    isCircleCollidingWithCanvaLeftOrRightEdges(circle, canvas){
        return Math.abs(circle.x - 0) < circle.radius || Math.abs(circle.x - canvas.width) < circle.radius;
    }

    // méthode pour vérifier la collision entre un cercle et les bords haut et bas du canva
    isCircleCollidingWithCanvaUpOrDownEdges(circle, canvas){
        return Math.abs(circle.y - 0) < circle.radius || Math.abs(circle.y - canvas.height) < circle.radius;
    }

    handleCollisions(defender, leftStiker, midleStriker, rightStriker, goal, canvas, game) {
        // gestion des collisions entre le defenseur et les attaquants
        if(this.areCirclesColliding(defender, leftStiker) === true) {
            if(defender.answer === leftStiker.answer) game.resetGame();
            else defender.bounce();
        }
        if(this.areCirclesColliding(defender, midleStriker) === true) {
            if(defender.answer === midleStriker.answer) game.resetGame();
            else defender.bounce();
        }
        if(this.areCirclesColliding(defender, rightStriker) === true) {
            if(defender.answer === rightStriker.answer) game.resetGame();
            else defender.bounce();
        }

        // gestion des collisions entre le defenseur et la cage
        if(this.isCircleCollidingWithRectangle(defender, goal.leftPole) === true) {
            defender.bounce();
        }
        if(this.isCircleCollidingWithRectangle(defender, goal.rightPole) === true) {
            defender.bounce();
        }
        if(this.isCircleCollidingWithRectangle(defender, goal.back) === true) {
            defender.bounce();
        }

        // gestion des collisions entre les attaquants et la cage
        if(this.isCircleCollidingWithRectangle(leftStiker, goal.inside) === true) game.resetGame();
        if(this.isCircleCollidingWithRectangle(midleStriker, goal.inside) === true) game.resetGame();
        if(this.isCircleCollidingWithRectangle(rightStriker, goal.inside) === true) game.resetGame();

        // gestion des collisions entre le defenseur et les bords du canvas
        if(this.isCircleCollidingWithCanvaUpOrDownEdges(defender, canvas)) defender.bounceHorizontal();
        if(this.isCircleCollidingWithCanvaLeftOrRightEdges(defender, canvas)) defender.bounceVertical();

        // gestion des collisions entre les attaquants et les bords du canvas
        if(this.isCircleCollidingWithCanvaUpOrDownEdges(leftStiker, canvas)) game.resetGame();
        if(this.isCircleCollidingWithCanvaUpOrDownEdges(midleStriker, canvas)) game.resetGame();
        if(this.isCircleCollidingWithCanvaUpOrDownEdges(rightStriker, canvas)) game.resetGame();
        if(this.isCircleCollidingWithCanvaLeftOrRightEdges(leftStiker, canvas)) game.resetGame();
        if(this.isCircleCollidingWithCanvaLeftOrRightEdges(midleStriker, canvas)) game.resetGame();
        if(this.isCircleCollidingWithCanvaLeftOrRightEdges(rightStriker, canvas)) game.resetGame();
    }
}