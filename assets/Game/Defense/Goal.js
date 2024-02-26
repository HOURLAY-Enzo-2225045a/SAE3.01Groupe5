import { Rectangle } from "./Rectangle.js"

export class Goal {
    constructor(tmpCanvas, goalSize) {
        this.back = new Rectangle(
            Math.trunc(tmpCanvas.width / 2) - goalSize / 2,
            Math.trunc(tmpCanvas.height * (9 / 10)) - goalSize / 15,
            goalSize,
            Math.trunc(goalSize / 15),
            "grey"
        );

        this.leftPole = new Rectangle(
            this.back.x,
            this.back.y - Math.trunc(this.back.width/2),
            this.back.height,
            Math.trunc(this.back.width/2),
            "black"
        );

        this.rightPole = new Rectangle(
            this.back.x+this.back.width-this.back.height,
            this.back.y - Math.trunc(this.back.width/2),
            this.back.height,
            Math.trunc(this.back.width/2),
            "black"
        );

        this.inside = new Rectangle(
            this.back.x+this.back.height,
            this.leftPole.y,
            this.back.width-this.back.height*2 ,
            Math.trunc(this.back.width/2),
            "red"
        );
    }

    draw(context) {
        this.leftPole.draw(context);
        this.rightPole.draw(context);
        this.back.draw(context);
        this.inside.draw(context);
    }

    isInside(object) {
        return this.inside.isInside(object);
    }

    getBack(){
        return this.back;
    }
}

