// game.js
import { Cage } from './Cage.js';
import { Palet } from './Palet.js';
import { CanvasManager } from './CanvasManager.js';
import { CollisionManager } from './CollisionManager.js';
import { EventManager } from './EventManager.js';

class Game {
    constructor() {
        this.canvasManager = new CanvasManager();
        this.collisionManager = new CollisionManager();
        this.eventManager = new EventManager();
        // ...
    }

    start() {
        // ...
    }

    reset() {
        // ...
    }

    // ...
}

const game = new Game();
game.start();