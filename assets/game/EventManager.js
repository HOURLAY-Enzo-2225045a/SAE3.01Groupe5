export class EventManager {
    constructor(palet, canvas) {
        this.palet = palet;
        this.canvas = canvas;
        this.mouseIsDown = false;
        this.gameActive = true;
    }

    getNewPos() {
        return {x: this.newX, y: this.newY};
    }

    setNewPos(x, y) {
        this.newX = x;
        this.newY = y;
    }

    getMouseIsDown(){
        return this.mouseIsDown;
    }

    handleMouseDown(e) {
        if (this.gameActive) {
            let pos = this.getMouseOrTouchPos(e);
            if (pos.x < this.palet.x + this.palet.radius && pos.x > this.palet.x - this.palet.radius &&
                pos.y < this.palet.y + this.palet.radius && pos.y > this.palet.y - this.palet.radius) {
                this.mouseIsDown = true;
            }
        }
    }

    handleMouseUp(e) {
        if (this.mouseIsDown) {
            let pos = this.getMouseOrTouchPos(e);
            this.palet.newX = this.palet.x + ((this.palet.x - pos.x) * 5);
            this.palet.newY = this.palet.y - ((pos.y - this.palet.y) * 5);
        }
        this.mouseIsDown = false;
    }

    handleMouseMove(e) {
        if (this.mouseIsDown) {
            let pos = this.getMouseOrTouchPos(e);
            this.palet.newX = (this.palet.x + (this.palet.x - pos.x));
            this.palet.newY = (this.palet.y - (pos.y - this.palet.y));
            this.palet.resetStartPos();
        }
    }

    getMouseOrTouchPos(e) {
        let rect = this.canvas.getBoundingClientRect();
        if (e.touches && e.touches.length > 0) {
            return {
                x: e.touches[0].clientX - rect.left,
                y: e.touches[0].clientY - rect.top
            };
        } else {
            return {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top
            };
        }
    }
}