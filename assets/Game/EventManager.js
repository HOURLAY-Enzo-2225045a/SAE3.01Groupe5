export class EventManager {
    constructor(circle, canvas) {
        this.circle = circle;
        this.canvas = canvas;
        this.mouseIsDown = false;
    }

    getMouseIsDown(){
        return this.mouseIsDown;
    }

    handleMouseDown(e) {
        let pos = this.getMouseOrTouchPos(e);
        if (pos.x < this.circle.x + this.circle.radius && pos.x > this.circle.x - this.circle.radius &&
            pos.y < this.circle.y + this.circle.radius && pos.y > this.circle.y - this.circle.radius) {
            this.mouseIsDown = true;
        }
    }

    handleMouseUp(e) {
        if (this.mouseIsDown) {
            let pos = this.getMouseOrTouchPos(e);
            this.circle.newX = this.circle.x + ((this.circle.x - pos.x) * 5);
            this.circle.newY = this.circle.y - ((pos.y - this.circle.y) * 5);
        }
        this.mouseIsDown = false;
    }

    handleMouseMove(e) {
        if (this.mouseIsDown) {
            let pos = this.getMouseOrTouchPos(e);
            this.circle.newX = (this.circle.x + (this.circle.x - pos.x));
            this.circle.newY = (this.circle.y - (pos.y - this.circle.y));
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